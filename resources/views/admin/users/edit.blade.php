@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Pengguna: {{ $user->name }}</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                
                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Penuh</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                {{-- Emel --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Emel</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                {{-- ROLE SELECTION --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role Pengguna</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User Biasa</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin (Pengurusan)</option>
                    </select>
                </div>
                
                {{-- STATUS (BAN/UNBAN) --}}
                <div class="mb-4">
                    <label for="is_active" class="form-label">Status Akaun (Ban/Unban)</label>
                    <select name="is_active" id="is_active" class="form-select" required>
                        <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif (Boleh Login)</option>
                        <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Banned (Tidak Boleh Login)</option>
                    </select>
                    <small class="form-text text-muted">Akaun Banned tidak boleh log masuk.</small>
                </div>
                
                <button type="submit" class="btn btn-success">Kemaskini Akaun</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </form>
            
        </div>
    </div>
</div>
@endsection