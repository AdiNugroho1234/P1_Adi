@extends('layouts.app')
@section('content')
<section class="cart section py-5 bg-light">
    <div class="container">
        <h3 class="mb-4 fw-bold text-primary">
            <i class="lni lni-cart-full me-2"></i> Keranjang Belanja
        </h3>

        <!-- Alert -->
        @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-3">{{ session('error') }}</div>
        @endif

        <!-- Form Checkout -->
        <form id="checkoutForm" action="{{ route('cart.prosesCheckout') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <!-- List Produk -->
            <div class="cart-list-head card shadow-sm border-0 rounded-4 mb-4">
                <div class="cart-list-title p-3 bg-primary text-white rounded-top">
                    <div class="row fw-semibold">
                        <div class="col-lg-4">Produk</div>
                        <div class="col-lg-2 text-center">Qty</div>
                        <div class="col-lg-2 text-center">Subtotal</div>
                        <div class="col-lg-1 text-center">Remove</div>
                    </div>
                </div>

                <div class="p-3">
                    @foreach ($cartItems as $item)
                    <div class="cart-single-list border-bottom py-3">
                        <div class="row align-items-center">
                            <!-- Image + Nama -->
                            <div class="col-lg-4 d-flex align-items-center">
                                @if (!empty($item->photo))
                                <img src="{{ asset('storage/' . $item->photo) }}"
                                    alt="{{ $item->nama_barang }}"
                                    class="img-fluid rounded"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center shadow-sm" style="width:80px; height:80px;">
                                    <small>No Image</small>
                                </div>
                                @endif
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-semibold text-truncate" style="max-width: 250px;" title="{{ $item->nama_barang }}">
                                        {{ $item->nama_barang }}
                                    </h6>
                                    <small class="text-muted d-block">{{ $item->jenis_barang }}</small>
                                </div>
                            </div>

                            <!-- Qty -->
                            <div class="col-lg-2 text-center">
                                <input type="number" class="form-control text-center rounded-pill" value="{{ $item->quantity }}" min="1" readonly>
                            </div>

                            <!-- Subtotal -->
                            <div class="col-lg-2 text-center">
                                <p class="mb-0 fw-bold text-dark">
                                    Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Remove -->
                            <div class="col-lg-1 text-center">
                                <a class="btn btn-sm btn-outline-danger rounded-circle" href="{{ route('cart.remove', $item->id) }}" onclick="return confirm('Remove item from cart?')">
                                    <i class="lni lni-close"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Alamat -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3"><i class="lni lni-map-marker me-2"></i>Alamat Pengiriman</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="fw-semibold">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-semibold">Kota</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-semibold">Provinsi</label>
                            <input type="text" name="province" class="form-control" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="fw-semibold">Kode Pos</label>
                            <input type="text" name="postal_code" class="form-control" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="fw-semibold">Negara</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4 text-primary">
                        <i class="lni lni-receipt me-2"></i>Ringkasan Belanja
                    </h5>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Items <span class="fw-semibold">{{ $cartItems->sum('quantity') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Subtotal <span class="fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-top pt-3 mt-2">
                            <span class="fw-bold">Total Bayar</span>
                            <span class="fw-bold text-success fs-5">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-success rounded-pill w-100 py-2 fw-semibold shadow-sm">
                        <i class="lni lni-credit-cards me-2"></i> Bayar Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Midtrans Snap -->
@if(isset($snapToken))
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script type="text/javascript">
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            alert('Pembayaran berhasil!');
            window.location.href = "/order/success";
        },
        onPending: function(result) {
            alert('Menunggu pembayaran...');
            window.location.href = "/order/pending";
        },
        onError: function(result) {
            alert('Terjadi kesalahan saat pembayaran.');
            console.log(result);
        },
        onClose: function() {
            alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
        }
    });
</script>
@endif
@endsection