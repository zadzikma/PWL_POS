@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <a href="{{ url('barang/create') }}" class="btn btn-sm btn-primary float-right">Tambah</a>
    </div>

    <div class="card-body">
        {{-- Notifikasi sukses/hapus --}}
        <div id="notif">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">&times;</button>
                </div>
            @endif
        </div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Akan diisi oleh DataTables Ajax --}}
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    $('#table_barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('barang/list') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'barang_kode' },
            { data: 'barang_nama' },
            { data: 'kategori' },
            { data: 'supplier' },
            { data: 'harga' }, // ini hasil dari controller (bukan kolom asli DB)
            { data: 'aksi', orderable: false, searchable: false }
    ],

        order: [[1, 'asc']]
    });

    // Hapus notifikasi saat klik tombol close
    $(document).on('click', '.close', function() {
        $(this).closest('.alert').remove();
    });
});
</script>
@endpush
