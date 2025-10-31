<form action="{{ route('announcements.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Announcement Title:</label>
        <input type="text" id="title" name="title" required> 
    </div>
    <div>
        <label for="content">Announcement Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Announcement</button>
</form>