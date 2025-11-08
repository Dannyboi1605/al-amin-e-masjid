<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PrayerTimeController extends Controller
{
    /**
     * Tunjuk page waktu solat (Menggunakan API Waktu Solat sebenar).
     */
    public function index()
    {
return view('prayertimes.index');
    }
}