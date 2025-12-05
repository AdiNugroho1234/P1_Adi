@extends('layouts.app')

@section('content')
<section class="checkout-wrapper section">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Form Checkout -->
            <div class="col-lg-8">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf

                    <div class="checkout-steps-form-style-1">
                        <ul class="list-unstyled">

                            <!-- Alamat Pengiriman -->
                            <li class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        @php
                                        use App\Models\AlamatUser;
                                        $alamatUtama = AlamatUser::where('user_id', auth()->id())
                                        ->where('utama', 1)->first();
                                        @endphp

                                        @if ($alamatUtama)
                                        <h6><i class="lni lni-map-marker"></i> Alamat Pengiriman</h6>
                                        <div class="alamat-utama">
                                            <strong>{{ $alamatUtama->name }} (+62{{ $alamatUtama->telepon }})</strong><br>
                                            {{ $alamatUtama->alamat }}, {{ strtoupper($alamatUtama->kota) }},
                                            {{ strtoupper($alamatUtama->provinsi) }},
                                            {{ strtoupper($alamatUtama->negara) }},
                                            {{ $alamatUtama->kode_pos }}
                                            <span class="badge bg-danger">Utama</span>
                                        </div>

                                        <!-- Simpan alamat ke form -->
                                        <input type="hidden" name="alamat_id" value="{{ $alamatUtama->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        @endif
                                    </div>
                                </div>
                            </li>

                            <!-- Produk Dipesan -->
                            <li class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-3">Produk Dipesan</h5>
                                        @foreach ($checkoutItems as $item)
                                        <div class="row align-items-center mb-3 border-bottom pb-2">
                                            <div class="col-md-2">
                                                @php $photo = json_decode($item->photo, true); @endphp
                                                <img src="{{ asset('storage/' . ($photo[0] ?? 'images/no-image.png')) }}"
                                                    class="img-fluid rounded"
                                                    alt="{{ $item->nama_barang }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6>{{ $item->nama_barang }}</h6>
                                                <small class="text-muted">Variasi: {{ $item->ukuran ?? '-' }}</small>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <p>Rp{{ number_format($item->harga, 0, ',', '.') }} x {{ $item->quantity }}</p>
                                                <p><strong>Rp{{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</strong></p>
                                            </div>

                                            <!-- simpan detail produk ke form -->
                                            <input type="hidden" name="items[{{ $item->id }}][barang_id]" value="{{ $item->id }}">
                                            <input type="hidden" name="items[{{ $item->id }}][nama_barang]" value="{{ $item->nama_barang }}">
                                            <input type="hidden" name="items[{{ $item->id }}][harga]" value="{{ $item->harga }}">
                                            <input type="hidden" name="items[{{ $item->id }}][ukuran]" value="{{ $item->ukuran }}">
                                            <input type="hidden" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <!-- Payment Info -->
                            <li>
                                <h6 class="title">Payment Info</h6>
                                <div class="checkout-payment-form">
                                    {{-- 🔔 Notifikasi sukses/error --}}
                                    @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <div class="payment-card-info mt-3">
                                        <button type="submit" class="btn btn-success w-100">Kirim Pesanan</button>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </form>
            </div>

            <!-- Sidebar Ringkasan -->
            <div class="col-lg-4">
                <div class="checkout-sidebar">
                    @php
                    $subtotal = 0;
                    foreach ($checkoutItems as $item) {
                    $subtotal += $item->harga * $item->quantity;
                    }
                    @endphp
                    <h5>Ringkasan Harga</h5>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Ongkir:</span>
                        <strong>Rp0</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-2 border-top pt-2">
                        <span>Total Bayar:</span>
                        <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection