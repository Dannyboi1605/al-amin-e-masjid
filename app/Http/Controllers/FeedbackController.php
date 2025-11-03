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

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        $user_id = Auth::check() ? Auth::id() : null;

        $is_anonymous = $request->has('is_anonymous') ? true : false;

        Feedback::create([
        'message' => $validatedData['message'],
        
        // Simpan emel hanya jika user tak pilih anonim.
        // Kalau user login, email dah ada di belakang tabir (dalam Auth::user()->email)
        'email' => $is_anonymous ? null : ($user_id ? Auth::user()->email : $validatedData['email']),
        
        'is_anonymous' => $is_anonymous,
        'user_id' => $user_id, // Boleh jadi NULL kalau guest (sebab migration kita dah set nullable)
        'status' => 'new', // Set status default untuk admin
    ]);

        // Here you can handle the feedback, e.g., save it to the database or send an email
        // For demonstration, we'll just return a success message

        return redirect()->route('feedback.create')->with('success', 'Thank you for your feedback!');
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

