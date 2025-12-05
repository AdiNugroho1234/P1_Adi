@extends('menu/navbar')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Jenis Barang</h4>

        <!-- Tombol Tambah -->
        <div class="mb-3">
            <a href="{{ url('jenis/create') }}" class="btn btn-primary btn-sm">Tambah Jenis</a>
        </div>

        <div class="table-responsive">
            <table id="jenis-listing" class="table table-bordered">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Jenis Barang</th>
                        <th>tgl pembuatan</th>
                        <th>tgl updated</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenis as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->jenis_barang }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <div class="d-flex gap-2 flex-wrap">
                                <!-- Edit -->
                                <a href="{{ url('jenis/create?id=' . $item->id) }}"
                                    class="btn btn-warning btn-sm text-white">Edit</a>

                                <!-- Delete -->
                                <form action="{{ route('jenis.delete', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jenis ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Tidak ada data jenis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection