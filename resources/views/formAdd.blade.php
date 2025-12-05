@extends('menu/navbar')
@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('jenis.store') }}" method="POST" class="inline">
        @csrf

        <br>
        <br>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama jenis</label>
                    <input type="text" value="{{ $jenis['jenis_barang'] }}" name="jenis_barang" class="form-control" required>
                </div>

                <input type="text" hidden name="action_task" value="save_jenis">
                <input type="hidden" name="id" value="{{ $jenis['id'] }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection