@extends('menu/navbar')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data barang Barang</h4>

        <!-- Tombol Tambah -->
        <div class="mb-3">
            <a href="{{ url('barang/create') }}" class="btn btn-primary btn-sm">Tambah barang</a>
        </div>

        <div class="table-responsive">
            <table id="barang-listing" class="table table-bordered">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Photo Barang</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jenis</th>
                        <th>Ukuran & stok</th>
                        <th>Warna</th>
                        <th>Gaya</th>
                        <th>Negara</th>
                        <th>deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="width: 130px;">
                            @php
                            $photos = json_decode($item->photo, true);
                            $photos = is_array($photos) ? $photos : [$item->photo];
                            @endphp

                            @foreach ($photos as $photo)
                            <img src="{{ asset('storage/' . $photo) }}"
                                alt="gambar"
                                style="width: 60px; height: 60px; object-fit: cover; margin: 2px; border-radius: 4px;">
                            @endforeach
                        </td>

                        <td style="width: 150px;">{{ Str::limit($item->nama_barang, 15) }}</td>

                        <td style="width: 100px;">Rp {{ number_format($item->harga, 2, '.', '.') }}</td>

                        <td style="width: 100px;">{{ $item->jenis_barang }}</td>

                        <td>
                            @php
                            $ukuranStok = json_decode($item->ukuran, true);
                            @endphp
                            @if ($ukuranStok && is_array($ukuranStok))
                            @foreach ($ukuranStok as $detail)
                            Ukuran: {{ $detail['ukuran'] }} - Stok: {{ $detail['stok'] }}<br>
                            @endforeach
                            @else
                            Ukuran: - Stok: -
                            @endif
                        </td>
                        <td style="width: 80px;">{{ Str::limit($item->warna, 10) }}</td>

                        <td style="width: 80px;">{{ $item->model }}</td>

                        <td style="width: 100px;">{{ $item->negara }}</td>

                        <td style="width: 200px;" class="text-truncate" title="{{ $item->description }}">
                            {{ Str::limit($item->description, 15) }}
                        </td>

                        <td style="width: 120px;">
                            <div class="d-flex gap-1">
                                <!-- Tombol Edit -->
                                <a href="{{ url('barang/create?id=' . $item->id) }}"
                                    class="btn btn-warning btn-sm text-white">Edit</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('barang.delete', $item->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Tidak ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>@endsection