@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools">
      <button onclick="modalAction('{{ url('kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah AJAX</button>
    </div>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Kategori</th>
          <th>Nama Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('js')
<script>
function modalAction(url = '') {
  $('#myModal').load(url, function() {
    $('#myModal').modal('show');
  });
}

var dataKategori;
$(document).ready(function() {
  dataKategori = $('#table_kategori').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ url('kategori/list') }}",
      type: "POST"
    },
    columns: [
      { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
      { data: "kategori_kode" },
      { data: "kategori_nama" },
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
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message })
                        .then(() => {
                            $('#myModal').modal('hide');
                            $('#table_kategori').DataTable().ajax.reload(null,false);
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                    }
                },
                error: function(){
                    Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan!', text: 'Coba lagi nanti.' });
                }
            }); // <-- tutup $.ajax
        }
    }); // <-- tutup then()
} // <-- tutup deleteData
</script>
@endpush

