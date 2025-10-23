@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    
    <div class="card-tools">
      <a href="{{ url('level/create') }}" class="btn btn-primary btn-sm mt-1">Tambah</a>
      <button onclick="modalAction('{{ url('level/create_ajax') }}')" class="btn btn-success btn-sm mt-1">Tambah Ajax</button>
    </div>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped table-hover table-sm" id="table_level">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Level</th>
          <th>Nama Level</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('js')
<script>
function modalAction(url = '') {
  $('#myModal').load(url, function(response, status, xhr) {
      if (status === 'success') {
          $('#myModal').modal('show');
      } else {
          Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Gagal memuat form. (' + xhr.status + ')'
          });
      }
  });
}

// ✅ Hapus Data Pakai Konfirmasi SweetAlert (sesuai Jobsheet 6 Praktikum 3)
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
      if (result.isConfirmed) {
          $.ajax({
              url: url,
              type: 'DELETE',
              success: function(response) {
                  if (response.status) {
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil!',
                          text: response.message
                      }).then(() => {
                          // ✅ Tutup modal dan refresh tabel tanpa reload halaman
                          $('#myModal').modal('hide');
                          $('#table_level').DataTable().ajax.reload(null, false);
                      });
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal!',
                          text: response.message
                      });
                  }
              },
              error: function(xhr) {
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

$(document).ready(function() {
  $('#table_level').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: "{{ url('level/list') }}",
          type: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      },
      columns: [
          { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
          { data: "level_kode" },
          { data: "level_nama" },
          { data: "aksi", orderable: false, searchable: false, className: "text-center" }
      ]
  });
});
</script>
@endpush
