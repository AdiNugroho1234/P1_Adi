@extends('layouts.app')

@section('content')
<section class="item-details section">
    <div class="container">
        <div class="row align-items-start">
            <!-- Kolom Kiri: Gambar -->
            <div class="col-lg-6 d-flex">

                <!-- Thumbnail -->
                <div class="me-3">
                    <div class="d-flex flex-column gap-2">
                        @if (!empty($photos))
                        @foreach ($photos as $photo)
                        <img src="{{ asset('storage/' . $photo) }}" class="thumbnail shadow-sm thumb"
                            style="width: 60px; height: 60px; object-fit: cover;" onclick="changeImage(this)">
                        @endforeach
                        @else
                        @for ($i = 0; $i < 4; $i++)
                            <img src="{{ asset('storage/' . $barang['photo']) }}" class="thumbnail shadow-sm thumb"
                            style="width: 60px; height: 60px; object-fit: cover;" onclick="changeImage(this)">
                            @endfor
                            @endif
                    </div>
                </div>

                <!-- Gambar Utama -->
                <div class="flex-grow-1">
                    <img id="mainDisplayImage"
                        src="{{ !empty($photos) ? asset('storage/' . $photos[0]) : asset('storage/' . $barang['photo']) }}"
                        alt="{{ $barang['nama_barang'] }}"
                        class="img-fluid rounded border"
                        style="max-height: 500px; object-fit: contain;">
                </div>
            </div>

            <!-- Kolom Kanan: Informasi Produk -->
            <div class="col-lg-6 mt-4 mt-lg-0">
                <h4 class="title">{{ $barang['nama_barang'] }}</h4>
                <p class="category">
                    <i class="lni lni-tag"></i> Kategori:
                    <a href="javascript:void(0)">{{ $barang['jenis_barang'] }}</a>
                </p>
                <h3 class="price">
                    Rp{{ number_format($barang['harga'], 0, ',', '.') }}
                    <span class="text-muted text-decoration-line-through">Rp4.000.000</span>
                </h3>
                <p class="info-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
                </p>

                <!-- Form Tambah ke Cart -->

                <form id="addCartForm{{ $barang['id'] }}" action="{{ route('cart.add', $barang['id']) }}" method="POST">
                    @csrf
                    <!-- 🔽 Tambahkan hidden input di sini -->
                    <input type="hidden" name="barang_id" value="{{ $barang['id'] }}">
                    <input type="hidden" name="nama_barang" value="{{ $barang['nama_barang'] }}">
                    <input type="hidden" name="jenis_barang" value="{{ $barang['jenis_barang'] }}">
                    <input type="hidden" name="harga" value="{{ $barang['harga'] }}">
                    <input type="hidden" name="photo"
                        value="{{ !empty($photos) ? $photos[0] : $barang['photo'] }}">
                    <!-- 🔼 Sampai sini -->
                    @php
                    $ukuranList = json_decode($barang['ukuran'], true);
                    @endphp

                    <h4 class="mt-4 mb-3">Ukuran Sepatu</h4>
                    <div class="nike-size-grid mb-3 d-flex flex-wrap gap-2">
                        @foreach ($ukuranList as $u)
                        <label class="nike-size-option btn btn-outline-dark m-0">
                            <input type="radio" name="ukuran" value="{{ $u['ukuran'] }}" data-stok="{{ $u['stok'] }}" required hidden>
                            <span>EU {{ $u['ukuran'] }}</span>
                        </label>
                        @endforeach
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" id="stok" name="stok" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                        </div>
                    </div>

                    <div class="trow mt-3 g-2">
                        <button type="submit" class="btn btn-primary w-100 border">
                            <i class="lni lni-cart me-1"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </form>

                <div class="row mt-3 g-2">
                    <div class="col-md-6">
                        <button class="btn btn-light w-100 border">
                            <i class="lni lni-reload"></i> Compare
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-light w-100 border">
                            <i class="lni lni-heart"></i> Wishlist
                        </button>
                    </div>
                </div>

                <!-- Dropdown Opsional -->
                <div class="dropdown mt-4">
                    <span class="lni lni-ellipsis-h" role="button" data-bs-toggle="dropdown"></span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="lni lni-pencil"></i> Edit this item</a></li>
                        <li><a class="dropdown-item" href="#"><i class="lni lni-trash"></i> Remove this item</a></li>
                    </ul>
                </div>

                <!-- Deskripsi & Spesifikasi -->
                <div class="row g-4 mt-4">
                    <div class="col-lg-6">
                        <h4 class="mb-3">Description</h4>
                        <p class="text-muted">{{ $barang['description'] }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="mb-3">Specifications</h4>
                        <ul class="list-unstyled">
                            <li><strong>Color:</strong> {{ $barang['warna'] }}</li>
                            <li><strong>Style:</strong> {{ $barang['model'] }}</li>
                            <li><strong>Negara:</strong> {{ $barang['negara'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainDisplayImage = document.getElementById('mainDisplayImage');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const radios = document.querySelectorAll('input[name="ukuran"]');
        const stokInput = document.getElementById('stok');

        thumbnails.forEach(function(thumbnail) {
            thumbnail.addEventListener('mouseover', function() {
                mainDisplayImage.src = this.src;
            });
        });

        radios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                const stok = this.dataset.stok || 0;
                stokInput.value = stok;
            });
        });
    });
</script>
@endsection