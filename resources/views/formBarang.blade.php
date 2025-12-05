@extends('menu/navbar')
@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="inline">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" value="{{ $barang['nama_barang'] ?? '' }}" name="nama_barang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Barang</label>
                    <input type="number" value="{{ $barang['harga'] ?? '' }}" name="harga" class="form-control" required>
                </div>

                <h4>Ukuran & Stok</h4>
                <div id="size-stock-wrapper">
                    @php
                    $ukuranStok = isset($barang['ukuran']) ? json_decode($barang['ukuran'], true) : [];
                    @endphp

                    @if (!empty($ukuranStok))
                    @foreach ($ukuranStok as $item)
                    <div class="flex gap-2 mb-2">
                        <input type="number" name="sizes[]" placeholder="Ukuran" value="{{ $item['ukuran'] }}" class="form-control w-25">
                        <input type="number" name="stocks[]" placeholder="Stok" value="{{ $item['stok'] }}" class="form-control w-25">
                    </div>
                    @endforeach
                    @else
                    <div class="flex gap-2 mb-2">
                        <input type="number" name="sizes[]" placeholder="Ukuran" class="form-control w-25">
                        <input type="number" name="stocks[]" placeholder="Stok" class="form-control w-25">
                    </div>
                    @endif
                </div>
                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addSize()">+ Ukuran</button>

                <div class="mb-3">
                    <label class="form-label">Jenis Barang</label>
                    <select name="jenis_barang" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenis as $item)
                        <option value="{{ $item->jenis_barang }}"
                            {{ (isset($barang['jenis_barang']) && $barang['jenis_barang'] == $item->jenis_barang) ? 'selected' : '' }}>
                            {{ $item->jenis_barang }}
                        </option>
                        @endforeach
                    </select>
                </div>

                @if (!empty($barang['photo']) && is_array($barang['photo']))
                @foreach ($barang['photo'] as $photo)
                <div class="flex gap-2 mb-2 items-center">
                    <input type="file" name="gambar[]" class="form-control w-3/4">
                    <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="text-blue-600 underline">
                        {{ basename($photo) }}
                    </a>
                </div>
                @endforeach
                @else
                <div class="flex gap-2 mb-2">
                    <input type="file" name="gambar[]" class="form-control w-75">
                </div>
                @endif
                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addPhoto()">+ Foto</button>


                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ $barang['description'] ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Warna Barang</label>
                    <input type="text" value="{{ $barang['warna'] ?? '' }}" name="warna" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Model Barang</label>
                    <input type="text" value="{{ $barang['model'] ?? '' }}" name="model" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Negara</label>
                    <input type="text" value="{{ $barang['negara'] ?? '' }}" name="negara" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Created At</label>
                    <input type="text" value="{{ $barang['created_at'] ?? '' }}" name="created_at" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Updated At</label>
                    <input type="text" value="{{ $barang['updated_at'] ?? '' }}" name="updated_at" class="form-control" readonly>
                </div>

                <input type="hidden" name="action_task" value="save_barang">
                <input type="hidden" name="id" value="{{ $barang['id'] ?? '' }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    function addSize() {
        const html = `
            <div class="flex gap-2 mb-2">
                <input type="number" name="sizes[]" placeholder="Ukuran" class="form-control w-25">
                <input type="number" name="stocks[]" placeholder="Stok" class="form-control w-25">
            </div>`;
        document.getElementById('size-stock-wrapper').insertAdjacentHTML('beforeend', html);
    }
</script>
<script>
    function addPhoto() {
        const container = document.createElement('div');
        container.className = "flex gap-2 mb-2";

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'gambar[]';
        input.className = 'form-control w-75';

        container.appendChild(input);
        document.querySelector('button[onclick="addPhoto()"]').before(container);
    }
</script>

@endsection