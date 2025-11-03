@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="float-right">
      <a href="{{ url('barang/create') }}" class="btn btn-sm btn-primary">Tambah</a>
      <button class="btn btn-sm btn-success" id="btn-tambah-ajax">Tambah (AJAX)</button>
    </div>
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
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

{{-- Modal Tambah/Edit AJAX --}}
<div class="modal fade" id="modal-barang" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Form Barang (AJAX)</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="form-barang">
          @csrf
          <input type="hidden" id="barang_id" name="barang_id">
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="barang_kode" id="barang_kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="barang_nama" id="barang_nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control">
              @foreach(App\Models\KategoriModel::all() as $kategori)
              <option value="{{ $kategori->kategori_id }}">{{ $kategori->kategori_nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control">
              @foreach(App\Models\SupplierModel::all() as $supplier)
              <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_nama }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" id="btn-simpan-ajax">Simpan</button>
        <button class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
  let table = $('#table_barang').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('barang/list') }}",
    columns: [
      { data: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'barang_kode' },
      { data: 'barang_nama' },
      { data: 'kategori' },
      { data: 'supplier' },
      { data: 'harga' },
      { data: 'aksi', orderable: false, searchable: false }
    ],
    order: [[1, 'asc']]
  });

  // Tombol tambah AJAX
  $('#btn-tambah-ajax').click(function() {
    $('#form-barang')[0].reset();
    $('#barang_id').val('');
    $('#modal-barang').modal('show');
  });

  // Tombol simpan AJAX
  $('#btn-simpan-ajax').click(function(e) {
    e.preventDefault();
    let id = $('#barang_id').val();
    let url = id ? "{{ url('barang') }}/" + id : "{{ url('barang') }}";
    let method = id ? "PUT" : "POST";

    $.ajax({
      url: url,
      type: method,
      data: $('#form-barang').serialize(),
      success: function(res) {
        $('#modal-barang').modal('hide');
        table.ajax.reload();
        alert('Data berhasil disimpan!');
      },
      error: function(xhr) {
        alert('Terjadi kesalahan saat menyimpan data!');
      }
    });
  });

  // Tombol edit AJAX
  $('#table_barang').on('click', '.btn-edit-ajax', function() {
    let id = $(this).data('id');
    $.get("{{ url('barang') }}/" + id + "/edit", function(data) {
      $('#barang_id').val(data.barang_id);
      $('#barang_kode').val(data.barang_kode);
      $('#barang_nama').val(data.barang_nama);
      $('#harga_beli').val(data.harga_beli);
      $('#harga_jual').val(data.harga_jual);
      $('#kategori_id').val(data.kategori_id);
      $('#supplier_id').val(data.supplier_id);
      $('#modal-barang').modal('show');
    });
  });

  // Tombol hapus AJAX
  $('#table_barang').on('click', '.btn-hapus-ajax', function() {
    if (confirm('Yakin ingin menghapus data ini?')) {
      let id = $(this).data('id');
      $.ajax({
        url: "{{ url('barang') }}/" + id,
        type: 'DELETE',
        data: { _token: "{{ csrf_token() }}" },
        success: function() {
          table.ajax.reload();
          alert('Data berhasil dihapus!');
        }
      });
    }
  });

  // Tutup notifikasi manual
  $(document).on('click', '.close', function() {
    $(this).closest('.alert').remove();
  });
});
</script>
@endpush
