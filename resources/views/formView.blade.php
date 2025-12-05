@extends('menu/navbar')

@section('content')


<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Detail Pesanan #{{ $order->id }}</h4>

        <div class="row">
            <!-- Foto Produk -->
            <div class="col-md-4 text-center">
                @if($order->photo)
                <img src="{{ asset('storage/' . $order->photo) }}"
                    alt="Foto Produk"
                    class="img-fluid rounded shadow"
                    style="width: 250px; height: 250px; object-fit: cover;">
                @else
                <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                    style="height: 250px;">
                    <span class="text-muted">Tidak ada foto</span>
                </div>
                @endif
            </div>

            <!-- Info Pesanan -->
            <div class="col-md-8">
                <h5 class="fw-bold mb-3">{{ $order->nama_produk }}</h5>

                <table class="table table-bordered">
                    <tr>
                        <th>Nama Pemesan</th>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <th>Kota</th>
                        <td>{{ $order->city }}</td>
                    </tr>
                    <tr>
                        <th>Provinsi</th>
                        <td>{{ $order->province }}</td>
                    </tr>
                    <tr>
                        <th>Kode Pos</th>
                        <td>{{ $order->postal_code }}</td>
                    </tr>
                    <tr>
                        <th>Negara</th>
                        <td>{{ $order->country }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $order->jumlah }}</td>
                    </tr>
                    <tr>
                        <th>Harga Satuan</th>
                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <form action="{{ route('pesanan.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Tandai pesanan ini sebagai dibayar?')">
                                    Dibayar
                                </button>
                            </form>
                        </td>
                    </tr>
                </table>

                <a href="{{ route('pesanan') }}" class="btn btn-secondary mt-3">
                    ← Kembali ke Daftar Pesanan
                </a>
            </div>
        </div>

    </div>
</div>

@endsection