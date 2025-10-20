@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('level') }}" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ url('level') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="level_kode">Kode Level</label>
                <input type="text" name="level_kode" id="level_kode"
                    class="form-control @error('level_kode') is-invalid @enderror"
                    value="{{ old('level_kode') }}" placeholder="Masukkan kode level">
                @error('level_kode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="level_nama">Nama Level</label>
                <input type="text" name="level_nama" id="level_nama"
                    class="form-control @error('level_nama') is-invalid @enderror"
                    value="{{ old('level_nama') }}" placeholder="Masukkan nama level">
                @error('level_nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
