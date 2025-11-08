@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Senarai Maklum Balas Masuk</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Message Preview</th>
                        <th>Pengirim</th>
                        <th>Status</th>
                        <th>Tarikh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $feedback)
                    {{-- Highlight NEW feedback menggunakan Bootstrap BG --}}
                    <tr class="{{ $feedback->status === 'new' ? 'table-warning' : '' }}"> 
                        <td>{{ $feedback->id }}</td>
                        
                        {{-- Truncated Message --}}
                        <td>{{ Str::limit($feedback->message, 50, '...') }}</td>
                        
                        {{-- Sender Logic --}}
                        <td>
                            @if($feedback->is_anonymous)
                                <span class="badge bg-secondary">Anonymous</span>
                            @elseif($feedback->user_id)
                                {{ $feedback->user->name ?? 'User Berdaftar' }}
                            @elseif($feedback->email)
                                {{ $feedback->email }}
                            @else
                                N/A
                            @endif
                        </td>
                        
                        {{-- Status Logic (Guna Badge Bootstrap) --}}
                        <td>
                            @php
                                $statusClass = [
                                    'new' => 'danger', 
                                    'in_review' => 'warning', 
                                    'completed' => 'success'
                                ][$feedback->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">
                                {{ strtoupper($feedback->status) }}
                            </span>
                        </td>
                        
                        <td>{{ $feedback->created_at->format('d M H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection