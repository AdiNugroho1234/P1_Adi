@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm p-4">
            <h4 class="mb-4">Profil Saya</h4>

            <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')


                <!-- Input foto -->
                <div class="text-center mb-3">
                    <img src="{{ auth()->user()->photo
                ? asset('storage/profile/' . auth()->user()->photo)
                : asset('storage/profile/default.png') }}"
                        class="rounded-circle mb-2" width="120" height="120" alt="Foto Profil">
                    <input type="file" name="photo" class="form-control mt-2">
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', auth()->user()->name) }}">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', auth()->user()->email) }}">
                </div>

                <!-- No HP -->
                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', auth()->user()->phone) }}">
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control">{{ old('address', auth()->user()->address) }}</textarea>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label>Password Baru (opsional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('welcome') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection