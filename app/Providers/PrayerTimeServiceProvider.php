<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PrayerTimeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // View Composer ini akan run SEBELUM layouts/app.blade.php di-render
        View::composer(['layouts.app', 'prayertimes.index'], function ($view) {
            
            // LOGIC API CALL ANDA DI SINI
            try {
                $dayFullDate = Carbon::now('Asia/Kuala_Lumpur')->format('d-m-Y'); 
                $dayNumber = (int)explode('-', $dayFullDate)[0];
                $index = $dayNumber - 1; 

                $response = Http::timeout(5)->get('https://api.waktusolat.app/v2/solat/SBH07');
                $data = $response->json();
                
                if (isset($data['prayers']) && count($data['prayers']) > $index) {
                    $todayPrayerData = $data['prayers'][$index]; 
                    $prayerTimesList = [ 
                        'Subuh' => $todayPrayerData['fajr'],
                        'Zohor' => $todayPrayerData['dhuhr'],
                        'Asar' => $todayPrayerData['asr'],
                        'Maghrib' => $todayPrayerData['maghrib'],
                        'Isyak' => $todayPrayerData['isha'],
                    ];
                } else {
                    // Fallback jika API gagal (Dummy data)
                    throw new \Exception('API Waktu Solat Gagal.');
                }
            } catch (\Exception $e) {
                // Dummy data jika ada sebarang exception (termasuk timeout)
                $prayerTimesList = [ 
                    'Subuh' => time() + 500, 'Zohor' => time() + 3600, 
                    'Asar' => time() + 7200, 'Maghrib' => time() + 10800, 'Isyak' => time() + 14400,
                ];
            }
            
            // Hantar data ke layout app
            $view->with('prayerTimesList', $prayerTimesList);
        });
    }
    // ... (method register) ...
}
