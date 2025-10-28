<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" required> 
    </div>
    <div>
        <label for="description">Event Description:</label>
        <textarea id="description" name="description" required></textarea>
    </div>
    <div>
        <label for="date">Event Date:</label>
        <input type="date" id="date" name="date" required>
    </div>
    <div>
        <label for="location">Event Location:</label>
        <input type="text" id="location" name="location" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Event</button>
</form>