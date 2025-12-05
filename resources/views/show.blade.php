@extends('menu/navbar')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Detail User</h4>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
            <li class="list-group-item"><strong>Tanggal Daftar:</strong> {{ $user->created_at->format('d M Y') }}</li>
            <li class="list-group-item"><strong>Role:</strong> {{ $user->role }}</li>
        </ul>
        <a href="{{ route('tabel') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection