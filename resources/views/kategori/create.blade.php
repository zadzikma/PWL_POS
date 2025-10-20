@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>

    <div class="card-body">
        <form action="{{ url('kategori') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-2 col-form-label">Kode Kategori</label>
                <div class="col-10">
                    <input type="text" name="kategori_kode" class="form-control" placeholder="Masukkan kode kategori" value="{{ old('kategori_kode') }}" required>
                    @error('kategori_kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-2 col-form-label">Nama Kategori</label>
                <div class="col-10">
                    <input type="text" name="kategori_nama" class="form-control" placeholder="Masukkan nama kategori" value="{{ old('kategori_nama') }}" required>
                    @error('kategori_nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('kategori') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
