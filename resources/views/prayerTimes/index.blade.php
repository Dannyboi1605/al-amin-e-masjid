@extends('layouts.app') 

@section('content')
<div class="container my-5">
    
    <h1 class="text-center mb-4 text-primary">Jadual Waktu Solat Harian</h1>
    <p class="text-center text-muted fs-5">Zon Waktu: SBH07 | Tarikh Hari Ini: {{ date('d M Y') }}</p>

    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold fs-5">
                    Waktu Solat Utama
                </div>
                <ul class="list-group list-group-flush">
                    {{-- Loop melalui data yang dihantar oleh View Composer --}}
                    @if(isset($prayerTimesList))
                        @foreach($prayerTimesList as $prayerName => $prayerTime)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">{{ $prayerName }}</span>
                            <span class="fs-5 text-dark" 
                                data-timestamp="{{ $prayerTime }}">
                                {{ date('h:i A', $prayerTime) }}
                            </span>
                        </li>
                        @endforeach
                    @else
                        <li class="list-group-item text-center text-danger">
                            Data waktu solat tidak dapat dimuatkan.
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Anda boleh tambah button untuk download PDF atau settings di sini --}}
            <div class="mt-4 text-center">
                <a href="#" class="btn btn-outline-primary">Lihat Kalendar Bulanan</a>
            </div>
            
        </div>
    </div>

</div>
@endsection