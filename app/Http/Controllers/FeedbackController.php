<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;


class FeedbackController extends Controller
{

    
    public function create()
    {
        return view('feedbacks.create');
    }

    // Dalam FeedbackController.php

public function store(Request $request)
{
    // 1. Validation yang disasarkan (hanya pada message dan email)
    $validatedData = $request->validate([
        'message' => 'required|string',
        'email' => 'nullable|email|max:255', // email tidak wajib
    ]);

    // 2. Logik
    $user_id = Auth::id(); // Dapat ID user (NULL jika guest)
    $is_anonymous = $request->has('is_anonymous') ? true : false; 
    
    // 3. Simpan ke Database
    Feedback::create([
        'message' => $validatedData['message'],
        
        // Logic Email: Jika anonim, set NULL. Jika tidak, gunakan emel dari Auth atau form.
        'email' => $is_anonymous 
                   ? null 
                   : ($user_id ? Auth::user()->email : $validatedData['email']),
        
        'is_anonymous' => $is_anonymous,
        'user_id' => $user_id,
        'status' => 'new',
    ]);

    // 4. Redirect
    return redirect()->route('feedback.create')->with('success', 'Terima kasih atas maklum balas anda! Ia telah dihantar kepada pihak pengurusan.');
}

    public function index()
{
    // Ambil semua feedback dari database, susun dari yang terbaru masuk.
    $feedbacks = Feedback::latest()->get();

    return view('admin.feedbacks.index', [
        'feedbacks' => $feedbacks
    ]);
}
}

