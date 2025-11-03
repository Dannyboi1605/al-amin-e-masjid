@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Feedbacks</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Message Preview</th> <th>Pengirim</th>
                <th>Status</th>
                <th>Tarikh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->id }}</td>
                
                {{-- FIX 2: Potong Mesej (Truncate) --}}
                <td>{{ Str::limit($feedback->message, 50, '...') }}</td> 
                
                {{-- FIX 1: Logik Pengirim --}}
                <td>
                    @if($feedback->is_anonymous)
                        <span class="badge bg-secondary">Anonymous</span>
                    @elseif($feedback->user_id)
                        {{-- Jika user login (ada user_id), kita tunjuk nama user --}}
                        {{ $feedback->user->name ?? 'User #' . $feedback->user_id }} 
                    @elseif($feedback->email)
                        {{ $feedback->email }} {{-- Jika Guest, tunjuk emel (jika ada) --}}
                    @else
                        N/A (Anonim Penuh)
                    @endif
                </td>
                
                <td><span class="badge bg-warning">{{ $feedback->status }}</span></td>
                <td>{{ $feedback->created_at->format('d M H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection