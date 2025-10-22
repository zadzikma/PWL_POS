@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools">
      <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
      <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah ajax</button>
    </div>
  </div>

  <div class="card-body">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row mb-3">
      <div class="col-md-12">
        <div class="form-group row">
          <label class="col-1 control-label col-form-label">Filter:</label>
          <div class="col-3">
            <select class="form-control" id="level_id" name="level_id" required>
              <option value="">- Semua -</option>
              @foreach($level as $item)
                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
              @endforeach
            </select>
            <small class="form-text text-muted">Level Pengguna</small>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
      <thead>
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Nama</th>
          <th>Level</th>
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
    console.log('Load modal dari URL:', url);
    $('#myModal').load(url, function(response, status, xhr) {
        if (status === 'success') {
            $('#myModal').modal('show');
        } else {
            console.error('Gagal load modal:', xhr.status, xhr.statusText);
        }
    });
}


 

var dataUser;
$(document).ready(function() {
  dataUser = $('#table_user').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: "{{ url('user/list') }}",
          type: "GET",
          dataType: "json",
          data: function (d) {
              d.level_id = $('#level_id').val();
          }
      },
      columns: [
          { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false, className: "text-center" },
          { data: "username", name: "username" },
          { data: "nama", name: "nama" },
          { data: "level.level_nama", name: "level.level_nama" },
          { data: "aksi", name: "aksi", orderable: false, searchable: false }
      ]
  });

  $('#level_id').on('change', function(){
      dataUser.ajax.reload();
  });
});
</script>
@endpush
