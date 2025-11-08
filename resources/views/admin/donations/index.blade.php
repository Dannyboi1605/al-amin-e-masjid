@extends('layouts.admin')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Senarai Derma Masuk</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>BillCode (Ref.)</th>
                        <th>Amaun (RM)</th>
                        <th>Penderma</th>
                        <th>Status</th>
                        <th>Tarikh</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->transaction_id }}</td>

                        {{-- Amaun dalam format RM --}}
                        <td>
                            <strong>RM {{ number_format($donation->amount, 2) }}</strong>
                        </td>

                        {{-- Logik Penderma --}}
                        <td>
                            @if ($donation->user_id)
                                {{ $donation->user->name ?? 'User Berdaftar' }}
                            @else
                                {{ $donation->donor_email }}
                            @endif
                        </td>

                        {{-- Status Bayaran (Badge) --}}
                        <td>
                            @php
                                $status = $donation->transaction_status;
                                $statusClass = ['completed' => 'success', 'pending' => 'warning', 'failed' => 'danger'][$status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">
                                {{ strtoupper($status) }}
                            </span>
                        </td>

                        <td>{{ $donation->created_at->format('Y-m-d H:i') }}</td>

                        {{-- Action --}}
                        <td>
                            <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection