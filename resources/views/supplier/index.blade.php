@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools">
      {{-- Tombol Tambah biasa --}}
      <a href="{{ url('supplier/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
      {{-- Tombol Tambah versi AJAX --}}
      <button onclick="modalAction('{{ url('supplier/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
        Tambah AJAX
      </button>
    </div>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Telepon</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Modal kosong untuk AJAX -->
<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true"></div>
@endsection


@push('js')
<!-- Pastikan jQuery & SweetAlert sudah dimuat -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function modalAction(url = '') {
  console.log('Memuat modal dari:', url);
  $('#myModal').load(url, function() {
    $('#myModal').modal('show');
  });
}

$(document).ready(function() {
  $('#table_supplier').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ url('supplier/list') }}",
      type: "POST"
    },
    columns: [
      { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
      { data: "supplier_kode" },
      { data: "supplier_nama" },
      { data: "supplier_alamat" },
      { data: "supplier_phone" },
      { data: "aksi", orderable: false, searchable: false }
    ]
  });
});

function deleteData(url) {
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Data yang dihapus tidak dapat dikembalikan!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if(result.isConfirmed){
      $.ajax({
        url: url,
        type: 'DELETE',
        success: function(response){
          if(response.status){
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: response.message
            }).then(() => {
              $('#myModal').modal('hide');
              $('#table_supplier').DataTable().ajax.reload(null,false);
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: response.message
            });
          }
        },
        error: function(){
          Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: 'Coba lagi nanti.'
          });
        }
      });
    }
  });
}
</script>
@endpush
