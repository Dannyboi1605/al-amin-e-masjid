<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" value="{{ $event->title }}" required> 
    </div>
    <div>
        <label for="description">Event Description:</label>
        <textarea id="description" name="description" required>{{ $event->description }}</textarea>
    </div>
    <div>
        <label for="date">Event Date:</label>
        <input type="date" id="date" name="date" value="{{ $event->date }}" required>
    </div>
    <div>
        <label for="location">Event Location:</label>
        <input type="text" id="location" name="location" value="{{ $event->location }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Event</button>
</form>