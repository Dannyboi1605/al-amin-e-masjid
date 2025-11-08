@extends('layouts.admin')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
@section('content')
<div class="container my-5">
    <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary mb-3">← Kembali ke Senarai</a>
    
    <h1 class="mb-4">Butiran Derma: {{ $donation->transaction_id }}</h1>
    
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Maklumat Transaksi
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless">
                <tbody>
                    {{-- AMAUN & STATUS (Most Important) --}}
                    <tr>
                        <th style="width: 30%;">Amaun Diterima</th>
                        <td><h4 class="text-success">RM {{ number_format($donation->amount, 2) }}</h4></td>
                    </tr>
                    <tr>
                        <th>Status Bayaran</th>
                        <td>
                            @php
                                $status = $donation->transaction_status;
                                $statusClass = ['completed' => 'success', 'pending' => 'warning', 'failed' => 'danger'][$status] ?? 'secondary';
                            @endphp
                            <span class="badge fs-6 bg-{{ $statusClass }}">
                                {{ strtoupper($status) }}
                            </span>
                        </td>
                    </tr>
                    
                    {{-- TRACKING --}}
                    <tr><th>BillCode (Rujukan Luaran)</th><td>{{ $donation->transaction_id }}</td></tr>
                    <tr><th>Nombor Resit</th><td>{{ $donation->receipt_number ?? 'N/A' }}</td></tr>
                    <tr><th>Tarikh Transaksi</th><td>{{ $donation->created_at->format('Y-m-d H:i:s') }}</td></tr>
                    
                    {{-- PENDERMA INFO --}}
                    <tr><td colspan="2"><hr></td></tr>
                    <tr>
                        <th>Nama Penderma</th>
                        <td>{{ $donation->user->name ?? $donation->donor_name ?? 'Guest' }}</td>
                    </tr>
                    <tr>
                        <th>Emel Penderma</th>
                        <td>{{ $donation->donor_email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection