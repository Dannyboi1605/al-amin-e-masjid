@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Volunteer Applications</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Event</th>
                <th>Message</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($volunteers as $volunteer)
                <tr>
                    <td>{{ $volunteer->id }}</td>
                    <td>{{ $volunteer->user->name }} &lt;{{ $volunteer->user->email }}&gt;</td>
                    <td>{{ $volunteer->event->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($volunteer->message, 60) }}</td>
                    <td>{{ ucfirst($volunteer->status) }}</td>
                    <td>{{ $volunteer->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.volunteers.show', $volunteer->id) }}" class="btn btn-sm btn-info">View</a>
                        @if($volunteer->status === 'pending')
                            <form action="{{ route('admin.volunteers.accept', $volunteer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-success">Accept</button>
                            </form>
                            <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-danger">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
