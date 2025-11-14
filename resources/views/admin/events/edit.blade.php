@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Event Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Event Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Event Date:</label>
            <input type="date" id="date" name="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Event Location:</label>
            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="allow_volunteers" name="allow_volunteers" value="1" {{ old('allow_volunteers', $event->allow_volunteers) ? 'checked' : '' }}>
            <label class="form-check-label" for="allow_volunteers">Allow volunteers</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection