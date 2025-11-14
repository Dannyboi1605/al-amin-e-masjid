<?php

use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\Admin\VolunteerController as AdminVolunteerController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AdminForumController;
use App\Http\Controllers\CommentController;


// ===================================
// 1. PUBLIC ROUTES & HOMEPAGE
// ===================================

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/prayertimes', [PrayerTimeController::class, 'index'])->name('prayer.index');

require __DIR__.'/auth.php';

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

// --- MODUL PENGUMUMAN (PUBLIC) ---
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index.public');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show.public');

// --- MODUL ACARA (PUBLIC) ---
Route::get('/events', [EventController::class, 'index'])->name('events.index.public');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show.public');

// --- MODUL ABOUT US (PUBLIC) ---
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// --- MODUL FORUM (PUBLIC) ---
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forums.show');

// ===================================
// 3. PROTECTED USER ROUTES
// ===================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Volunteer application routes (only for authenticated users)
    Route::get('/events/{event}/volunteer', [VolunteerController::class, 'create'])->name('events.volunteer.create');
    Route::post('/events/{event}/volunteer', [VolunteerController::class, 'store'])->name('events.volunteer.store');
    
    // Forum comments (authenticated users can comment)
    Route::post('/forums/{forum}/comments', [CommentController::class, 'store'])->name('forums.comments.store');
    
    // NOTE: user-scoped resource routes for events were removed to avoid
    // colliding with the public events routes (which are named
    // "events.index.public" / "events.show.public").
});


// ===================================
// 4. ADMIN PANEL (PROTECTED BY ROLE)
// ===================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard (welcome page)
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // --- ADMIN FEEDBACK VIEW ---
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/{feedback}', [FeedbackController::class, 'show'])->name('feedbacks.show'); 
    
    // --- ADMIN DONATION VIEW ---
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index'); 
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');

   Route::resource('announcements', AnnouncementController::class);

   Route::resource('users', UserController::class);

    // Admin volunteer management
    Route::get('/volunteers', [AdminVolunteerController::class, 'index'])->name('volunteers.index');
    Route::get('/volunteers/{volunteer}', [AdminVolunteerController::class, 'show'])->name('volunteers.show');
    Route::post('/volunteers/{volunteer}/accept', [AdminVolunteerController::class, 'accept'])->name('volunteers.accept');
    Route::post('/volunteers/{volunteer}/reject', [AdminVolunteerController::class, 'reject'])->name('volunteers.reject');

    // Admin About Us Management
    Route::resource('about', \App\Http\Controllers\Admin\AboutController::class)->except(['show']);

    // Use admin-scoped controller for admin panel views
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    
    // --- ADMIN FORUM MANAGEMENT ---
    Route::resource('forums', AdminForumController::class);
    Route::get('/forums-comments', [AdminForumController::class, 'comments'])->name('forums.comments');
    Route::post('/comments/{comment}/toggle-hidden', [CommentController::class, 'toggleHidden'])->name('comments.toggle-hidden');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{id}/restore', [CommentController::class, 'restore'])->name('comments.restore');
    Route::delete('/comments/{id}/force-delete', [CommentController::class, 'forceDelete'])->name('comments.force-delete');
});