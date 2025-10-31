<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;    // <-- Import Auth
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;    // <-- Import Mail
use App\Mail\DonationReceipt;            // <-- Import Mailable

class DonationController extends Controller
{
    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string|max:20',
        ]);



        // dd('Validation Berjaya!');

        $toyyibpayData = [
            'userSecretKey' => '2o5eozy1-xou1-4dvb-gd7e-x2uxh9u8hqin', // <-- GANTI NI
            'categoryCode' => '1gz5fnuw',                        // <-- Kod Kategori awak
            'billName' => 'Derma Masjid (FYP)',
            'billDescription' => 'Derma ikhlas dari ' . $validated['name'],
            'billPriceSetting' => 1, // 1 = Amaun tetap
            'billPayorInfo' => 1,    // 1 = Wajibkan info user
            'billAmount' => $validated['amount'] * 100, // <-- TUKAR KE SEN (RM50 = 5000)
            'billTo' => $validated['name'],
            'billEmail' => $validated['email'],
            'billPaymentChannel' => '2', // 2 = FPX dan Kad Kredit
            'billPhone' => $validated['phone'],
            
            // URL yang kita cipta dalam routes/web.php tadi
            'billReturnUrl' => route('donation.success'),
            'billCallbackUrl' => route('donation.callback'),
        ];

        // 3. Hantar data ke ToyyibPay guna 'posmen' Http
        // Guna 'asForm()' sebab ToyyibPay terima data borang (bukan JSON)
        $response = Http::asForm()->post('https://dev.toyyibpay.com/index.php/api/createBill', $toyyibpayData);

// dd($response->body());

        // 4. Dapat response dari ToyyibPay
        $billData = $response->json(); // cth: [{"BillCode":"xoxox"}]

        // 5. Semak jika ada error
        if (isset($billData['BillCode'])) {
            $billCode = $billData[0]['BillCode']; // <-- Ini BillCode kita

            // 6. Simpan rekod derma dalam database kita
            Donation::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'amount' => $validated['amount'], // Simpan amaun RM
                'transaction_status' => 'pending', // Set 'pending' dulu
                'user_id' => Auth::check() ? Auth::id() : null, // Simpan ID user kalau dia login
                'payment_method' => 'toyyibpay',
                'transaction_id' => $billCode, // Simpan BillCode sebagai rujukan
            ]);

            // 7. Redirect user ke page bayaran ToyyibPay
            $paymentUrl = 'https://dev.toyyibpay.com/' . $billCode;
            return redirect()->away($paymentUrl); // 'away()' untuk redirect ke URL luaran

        } else {
            // Kalau ToyyibPay bagi error
            return redirect()->back()->with('error', 'Gagal mencipta bil. Sila cuba lagi.');
        }
    }

    /**
     * Page 'Terima Kasih' (bila user patah balik)
     */
    public function paymentSuccess(Request $request)
    {
        // Kat sini kita cuma tunjuk 'Terima kasih'
        // 'status_id' (3) bermaksud 'pending'. Kita tak boleh sahkan kat sini
        return view('donations.success'); // Kena cipta fail view ni
    }

    /**
     * Webhook (bila server ToyyibPay hantar signal)
     */
    public function callback(Request $request)
    {
        $secretKey = '2o5eozy1-xou1-4dvb-gd7e-x2uxh9u8hqin';
        // Ini adalah 'signal' rahsia dari ToyyibPay
        $billCode = $request->input('billcode');
        $status = $request->input('status'); // 1 = Berjaya, 2 = Pending, 3 = Gagal

        // 1. Cari derma dalam database kita guna billCode
        $donation = Donation::where('transaction_id', $billCode)->first();

        if ($donation) {
            // 2. Semak jika bayaran berjaya
            if ($status == '1' && $donation->transaction_status == 'pending') {
                
                // 3. Update status ke 'completed'
                $donation->transaction_status = 'completed';
                $donation->receipt_number = 'MSJ-FYP-' . $donation->id; // Auto-generate resit
                $donation->save();

                // 4. TODO: Hantar emel resit kepada $donation->donor_email
                // (Ini kita boleh buat kemudian)
                Mail::to($donation->donor_email)->send(new DonationReceipt($donation));
            }
        }
        
        // ToyyibPay perlukan response "OK"
        return response('OK'); 
    }
}


    


