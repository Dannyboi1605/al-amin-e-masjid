<?php

use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

// ===================================
// 1. PUBLIC ROUTES & HOMEPAGE (FIXED)
// ===================================

// 1. HOMEPAGE: Hanya return view 'welcome'
Route::get('/', function () {
    return view('welcome');
})->name('homepage');


// 2. DEDICATED PRAYER TIMES PAGE: Menggunakan Controller yang sudah di-clean
Route::get('/prayertimes', [PrayerTimeController::class, 'index'])->name('prayer.index');


// Auth (Login, Register) - Default Laravel
require __DIR__.'/auth.php';

// Route Dashboard (Kekal protected, URL: /dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ===================================
// 2. USER MODULES (PUBLIC ACCESS)
// ===================================

// --- MODUL DONATION ---
Route::get('/donation', [DonationController::class, 'create'])->name('donation.create');
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');
Route::get('/donation/success', [DonationController::class, 'paymentSuccess'])->name('donation.success');
Route::post('/donation/callback', [DonationController::class, 'callback'])->name('donation.callback');


// --- MODUL FEEDBACK ---
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


// ===================================
// 3. PROTECTED ADMIN & USER ROUTES
// ===================================

Route::middleware('auth')->group(function () {
    // Standard User Routes (Profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Management (Events & Announcements)
    Route::resource('events', EventController::class);
    Route::resource('announcements', AnnouncementController::class);
});


// ===================================
// 4. ADMIN PANEL (PROTECTED BY ROLE)
// ===================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // --- ADMIN FEEDBACK VIEW ---
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/{feedback}', [FeedbackController::class, 'show'])->name('feedbacks.show'); 
    
    // --- ADMIN DONATION VIEW ---
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index'); // Senarai Derma
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show'); // Detail Derma

});