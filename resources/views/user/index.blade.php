@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools">
      <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
    </div>
  </div>

  <div class="card-body">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-borehead table-striped table-hover table-sm" id="table_user">
      <thead>
        <tr><th>>No</th>
          <th>Username</th>
          <th>Nama</th>
          <th>Level</th>
          <th>Aksi</th></tr>
      </thead>
    </table>
      
@endsection

@push('js')
<script>
$(document).ready(function() {
  $('#table_user').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: "{{ url('user/list') }}",
          type: "GET", // sementara pakai GET (karena POST sempat HTML)
          dataType: "json",
      },
      columns: [
          { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false, className: "text-center" },
          { data: "username", name: "username" },
          { data: "nama", name: "nama" },
          { data: "level.level_nama", name: "level.level_nama" },
          { data: "aksi", name: "aksi", orderable: false, searchable: false }
      ]
  });
});
</script>
@endpush
