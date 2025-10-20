@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->barang_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="barang_kode" class="form-control" value="{{ old('barang_kode', $barang->barang_kode) }}" required>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="barang_nama" class="form-control" value="{{ old('barang_nama', $barang->barang_nama) }}" required>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="barang_harga" class="form-control" value="{{ old('barang_harga', $barang->barang_harga) }}" required>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="barang_stok" class="form-control" value="{{ old('barang_stok', $barang->barang_stok) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
