@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ url('supplier') }}">
            @csrf
            <div class="form-group">
                <label>Kode Supplier</label>
                <input type="text" name="supplier_kode" class="form-control" value="{{ old('supplier_kode') }}">
                @error('supplier_kode') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" name="supplier_nama" class="form-control" value="{{ old('supplier_nama') }}">
                @error('supplier_nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="supplier_alamat" class="form-control">{{ old('supplier_alamat') }}</textarea>
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="supplier_telp" class="form-control" value="{{ old('supplier_telp') }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ url('supplier') }}" class="btn btn-default btn-sm">Kembali</a>
        </form>
    </div>
</div>
@endsection
