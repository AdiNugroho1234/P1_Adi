@extends('layouts.app')

@section('content')
<section class="py-5 text-center">
    <div class="container">
        <div class="card shadow-lg p-5">
            <h2 class="text-warning mb-3">⏳ Pembayaran Sedang Diproses</h2>
            <p>Pembayaran kamu belum dikonfirmasi. Silakan cek kembali status transaksi di menu pesanan kamu.</p>
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</section>
@endsection