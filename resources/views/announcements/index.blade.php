<h1>Announcements</h1>

@foreach($announcements as $announcement)
    <div class="announcement" style="border: 1px solid black; margin-bottom: 10px; padding: 10px;">
        <h2>{{ $announcement->title }}</h2>
        <p>{{ $announcement->content }}</p>
        <p><strong>Date:</strong> {{ $announcement->created_at->format('M d, Y') }}</p>

        <a href="{{ route('announcements.edit', $announcement->id) }}">Edit Announcement</a>
        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this announcement?');">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
    </div>
@endforeach

<a href="{{ route('announcements.create') }}">Create New Announcement</a>