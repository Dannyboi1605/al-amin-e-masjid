<?php

use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
// Hapus: use Illuminate\Support\Facades\Http; 


// TUKAR: Letak route utama yang paling penting (Waktu Solat) di atas
Route::get('/', [PrayerTimeController::class, 'index'])->name('prayer.index');

// Route Dashboard (standard Laravel)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route User Profile (standard Laravel)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Resource (Events & Announcements)
Route::resource('events', EventController::class)->middleware(['auth']);
Route::resource('announcements', AnnouncementController::class)->middleware(['auth']);

// Route Authentication (login, register, dll.)
require __DIR__.'/auth.php';

// ===================================
// MODUL DERMA (DONATION MODULE)
// ===================================

// 1. Tunjuk borang & Proses borang
Route::get('/donation', [DonationController::class, 'create'])->name('donation.create');
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');

// 2. Page 'Terima Kasih' (bila user patah balik dari ToyyibPay)
Route::get('/donation/success', [DonationController::class, 'paymentSuccess'])->name('donation.success');

// 3. Webhook (Signal dari ToyyibPay Server)
Route::post('/donation/callback', [DonationController::class, 'callback'])->name('donation.callback');