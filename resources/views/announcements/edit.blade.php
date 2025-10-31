<form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Announcement Title:</label>
        <input type="text" id="title" name="title" value="{{ $announcement->title }}" required> 
    </div>
    </div>
    <div>
        <label for="content">Announcement Content:</label>
        <textarea id="content" name="content" required>{{ $announcement->content }}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Update Announcement</button>
</form>