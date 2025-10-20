@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <a href="{{ url('supplier/create') }}" class="btn btn-sm btn-primary float-right">Tambah</a>
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

        <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Telp</th>
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
    // Inisialisasi DataTables dengan Ajax
    $('#table_supplier').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('supplier/list') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'supplier_kode', name: 'supplier_kode' },
            { data: 'supplier_nama', name: 'supplier_nama' },
            { data: 'supplier_alamat', name: 'supplier_alamat' },
            { data: 'supplier_phone', name: 'supplier_phone' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
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
