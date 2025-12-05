@extends('menu/navbar')

@section('content')
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pesanan</h4>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                 <td>
                                    @if($order->photo)
                                    <img src="{{ asset('storage/'.$order->photo) }}"
                                        alt="Foto Produk"
                                        style="width:80px; height:80px; object-fit:cover; border-radius:8px;">
                                    @else
                                    <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $order->nama_produk }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('pesanan.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Tandai pesanan ini sebagai dibayar?')">
                                            Dibayar
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <a href="{{ route('pesanan.show', $order->id) }}" class="btn btn-primary btn-sm">
                                        Lihat Detail
                                    </a>

                                    <form action="{{ route('pesanan.destroy', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesanan?')">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
@endsection