@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('kategori/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $index => $kt)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $kt->kategori_kode }}</td>
                    <td>{{ $kt->kategori_nama }}</td>
                    <td class="text-center">
                        <a href="{{ url('kategori/'.$kt->kategori_id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ url('kategori/'.$kt->kategori_id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">@endpush
@push('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>$(document).ready(()=>$('#table_kategori').DataTable());</script>
@endpush
