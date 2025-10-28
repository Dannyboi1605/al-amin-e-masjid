<h1>Events</h1>

@foreach($events as $event)
    <div class="event" style="border: 1px solid black; margin-bottom: 10px; padding: 10px;">
        <h2>{{ $event->title }}</h2>
        <p>{{ $event->description }}</p>
        <p><strong>Date:</strong> {{ $event->date }}</p>

        <a href="{{ route('events.edit', $event->id) }}">Edit Event</a>
    </div>

<form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this event?');">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>   
@endforeach

<a href="{{ route('events.create') }}">Create New Event</a>
<a href="{{ route('events.index') }}">Back to Events List</a>