<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationReceipt;
use Illuminate\Support\Facades\Http; // Kekalkan ini, walaupun tak guna untuk create bill, berguna untuk debugging
use Illuminate\Support\Facades\Config; // Untuk ambil data dari .env

class DonationController extends Controller
{
    // ADMIN LIST VIEW
    public function index()
    {
        $donations = Donation::latest()->get();
        return view('admin.donations.index', compact('donations'));
    }
    
    // PUBLIC CREATE FORM
    public function create()
    {
        return view('donations.create');
    }

    // HANDLE FORM SUBMISSION & REDIRECT TO BILLPLZ
    public function store(Request $request)
    {
        // 1. Validation (Wajib ada field phone untuk Billplz/PayEx)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string|max:20',
        ]);

        // 2. Tentukan data backend & Amaun dalam sen
        $user_id = Auth::check() ? Auth::id() : null;
        $amountInCents = $validated['amount'] * 100; 

        // 3. Simpan rekod PENDING dalam database sebelum redirect
        // Kita gunakan ID kita sendiri sebagai rujukan utama untuk Billplz
        $donation = Donation::create([
            'donor_name' => $validated['name'],
            'donor_email' => $validated['email'],
            'amount' => $validated['amount'], 
            'transaction_status' => 'pending', 
            'user_id' => $user_id,
            'payment_method' => 'billplz',
            // 'transaction_id' dibiarkan NULL buat sementara, akan diisi oleh callback
        ]);

        // 4. --- LOGIC BILLPLZ: Redirect untuk Create Bill ---
        // Gantikan 'COLLECTION_ID_AWAK' dengan ID dari Billplz Staging
        $collectionId = env('BILLPLZ_COLLECTION_ID', 'COLLECTION_ID_AWAK');

        $billplzData = [
            'collection_id' => $collectionId,
            'description' => 'Derma Masjid Al-Amin - ' . $donation->id,
            'email' => $validated['email'],
            'mobile' => $validated['phone'],
            'name' => $validated['name'],
            'amount' => $amountInCents, // Wajib dalam sen
            'callback_url' => route('donation.callback'), // URL untuk webhook/signal
            'redirect_url' => route('donation.success'), // URL untuk user patah balik
            'reference_1_label' => 'Donation ID',
            'reference_1' => $donation->id, // ID kita sendiri sebagai rujukan
            'currency' => 'MYR',
        ];
        
        // 5. Build URL Billplz
        // Billplz menggunakan URL 'https://www.billplz.com/payments/new' untuk initiate bill
        $queryString = http_build_query($billplzData);
        $paymentUrl = 'https://www.billplz.com/payments/new?' . $queryString;

        // 6. Redirect user ke page pembayaran Billplz
        return redirect()->away($paymentUrl);
    }

    /**
     * Page 'Terima Kasih' (redirect_url dari Billplz).
     */
    public function paymentSuccess(Request $request)
    {
        // Billplz akan hantar status, tapi kita tak boleh percaya status di sini untuk security.
        // Kita hanya tunjuk terima kasih dan semak DB untuk status sebenar.
        return view('donations.success'); 
    }

    /**
     * Webhook (Billplz hantar signal - Callback URL).
     */
    public function callback(Request $request)
    {
        // Ini adalah 'signal' rahsia dari Billplz
        
        // 1. Ambil data dari Billplz (gunakan key 'billplz[...]' untuk webhook)
        $billplzId = $request->input('billplz_id');
        $billplzPaid = $request->input('billplz_paid'); // 'true' atau 'false'
        $ourDonationId = $request->input('billplz_reference_1'); // ID Donasi kita sendiri
        
        // 2. Cari rekod derma kita
        $donation = Donation::find($ourDonationId);

        // 3. Semak jika bayaran berjaya (paid='true') dan status masih pending
        if ($donation && $billplzPaid === 'true' && $donation->transaction_status === 'pending') {
            
            // 4. Update status & rekod Billplz ID
            $donation->transaction_status = 'completed';
            $donation->transaction_id = $billplzId; // Simpan Billplz ID/Ref
            $donation->receipt_number = 'MSJ-BP-' . $donation->id; // Guna prefix BP untuk Billplz
            $donation->save();

            // 5. Hantar emel resit
            Mail::to($donation->donor_email)->send(new DonationReceipt($donation)); 
        }
        
        // Billplz perlukan response 200 OK untuk mengesahkan penerimaan webhook
        return response('Billplz OK', 200); 
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }
}