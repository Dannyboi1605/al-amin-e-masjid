@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="mb-3">Selamat Datang Ke Admin Panel Website Al-Amin E-Masjid</h1>
            <p class="lead">Gunakan panel ini untuk mengurus pengumuman, sumbangan, maklum balas dan tetapan laman.</p>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pengumuman</h5>
                            <p class="card-text">Urus dan cipta pengumuman untuk dipaparkan pada laman utama.</p>
                            <a href="{{ route('admin.announcements.index') }}" class="btn btn-sm btn-primary">Lihat Pengumuman</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Donations</h5>
                            <p class="card-text">Semak sumbangan yang diterima.</p>
                            <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-primary">Lihat Donations</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Feedbacks</h5>
                            <p class="card-text">Urus maklum balas dari pengguna.</p>
                            <a href="{{ route('admin.feedbacks.index') }}" class="btn btn-sm btn-primary">Lihat Feedbacks</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
