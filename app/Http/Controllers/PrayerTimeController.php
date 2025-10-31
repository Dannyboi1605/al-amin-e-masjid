<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // 1. Import "posmen" Http
use Carbon\Carbon; // <-- added import for timezone-aware date

class PrayerTimeController extends Controller
{
    /**
     * Tunjuk page waktu solat.
     */
    public function index()
    {
        // 2. Telefon API dan simpan response
        $response = Http::get('https://api.waktusolat.app/v2/solat/SBH07');

        // 3. Tukar response (JSON) tu jadi array PHP
        $data = $response->json();

        // 4. Dapatkan nombor hari ni (cth: "31") IN MALAYSIA TIME (GMT+8)
        $dayNumber = Carbon::now('Asia/Kuala_Lumpur')->format('d-m-Y'); 

        // 5. Kira indeks array (cth: 31 - 1 = 30)
        // Kita guna (int) untuk pastikan $dayNumber jadi nombor
        $index = (int)explode('-', $dayNumber)[0] - 1; 

        // 6. Ambil data solat untuk hari ni SAHAJA
        //    Guna key 'prayers' dan indeks yang kita kira
        $todayPrayerData = $data['prayers'][$index];

        // 7. Hantar data HARI INI SAHAJA ke view
        return view('prayertimes.index', [
            // 'prayerData' sekarang cuma ada data 1 hari
            'prayerData' => $todayPrayerData, 
            
            // 'currentDate' ni tak wajib, tapi boleh guna 
            // untuk paparkan tarikh
            'currentDate' => $dayNumber, 
        ]);
    }
}