@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Volunteer Application #{{ $volunteer->id }}</h1>

    <p><strong>User:</strong> {{ $volunteer->user->name }} &lt;{{ $volunteer->user->email }}&gt;</p>
    <p><strong>Event:</strong> {{ $volunteer->event->title }}</p>
    <p><strong>Message:</strong></p>
    <div class="card mb-3"><div class="card-body">{{ $volunteer->message ?: '-' }}</div></div>
    <p><strong>Status:</strong> {{ ucfirst($volunteer->status) }}</p>

    <div class="mt-3">
        @if($volunteer->status === 'pending')
            <form action="{{ route('admin.volunteers.accept', $volunteer->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-success">Accept</button>
            </form>
            <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-danger">Reject</button>
            </form>
        @endif

        <a href="{{ route('admin.volunteers.index') }}" class="btn btn-secondary">Back to list</a>
    </div>
</div>
@endsection
