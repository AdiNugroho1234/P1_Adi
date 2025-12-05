@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h3>Scan Kode QR untuk Melanjutkan Pembayaran</h3>
    <img src="{{ asset('images/qris-example.png') }}" alt="QRIS" style="max-width: 250px;">
    <p class="mt-3">Setelah membayar, pesanan Anda akan diproses.</p>
</div>
@endsection
