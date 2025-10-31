    <?php

    use App\Http\Controllers\PrayerTimeController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\EventController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AnnouncementController;
    use Illuminate\Support\Facades\Http;



    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('events', EventController::class)->middleware(['auth']);

    Route::resource('announcements', AnnouncementController::class)->middleware(['auth']);
    require __DIR__.'/auth.php';

    Route::get('/', [PrayerTimeController::class, 'index'])->name('prayer.index');
    