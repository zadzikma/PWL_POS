@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
    <div class="card-body">
        @if(!$supplier)
            <div class="alert alert-danger">Data tidak ditemukan</div>
            <a href="{{ url('supplier') }}" class="btn btn-default btn-sm mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('supplier/'.$supplier->supplier_id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Kode Supplier</label>
                    <input type="text" name="supplier_kode" class="form-control" value="{{ old('supplier_kode', $supplier->supplier_kode) }}">
                    @error('supplier_kode') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="supplier_nama" class="form-control" value="{{ old('supplier_nama', $supplier->supplier_nama) }}">
                    @error('supplier_nama') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="supplier_alamat" class="form-control">{{ old('supplier_alamat', $supplier->supplier_alamat) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="supplier_phone" class="form-control" value="{{ old('supplier_phone', $supplier->supplier_phone) }}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="{{ url('supplier') }}" class="btn btn-default btn-sm">Kembali</a>
            </form>
        @endif
    </div>
</div>
@endsection
