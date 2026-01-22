@extends('menu/navbar')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tabel Kelompok</h4>

                <div class="d-flex flex-wrap gap-2 mb-3">
                    <a href="{{ route('kelompok.create') }}" class="btn btn-primary">
                        Create
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kategori Pesan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kelompok as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->jenis_kelompok }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <!-- Edit -->
                                        <a href="{{ url('kelompok/create?id=' . $item->id) }}"
                                            class="btn btn-warning btn-sm text-white">Edit</a>

                                        <!-- Delete -->
                                        <form action="{{ route('kelompok.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kelompok ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Data kosong</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection