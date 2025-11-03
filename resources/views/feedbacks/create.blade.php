<form method="POST" action="{{ route('feedback.store') }}">
    @csrf
    
    <div>
        <label for="message">Your Feedback:</label>
        <textarea id="message" name="message" required></textarea>
    </div>

    @auth
        {{-- Kalau user dah login, kita tak perlu tanya emel, kita auto-isi --}}
        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
    @else
        {{-- Kalau guest (tak login), kita wajib tanya emel --}}
        <div>
            <label for="email">Your Email (Optional):</label>
            <input type="email" id="email" name="email">
        </div>
    @endauth
    
    <div>
        <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1">
        <label for="is_anonymous">Send Anonymously (Management cannot follow up)</label>
    </div>
    
    <button type="submit">Submit Feedback</button>
</form>