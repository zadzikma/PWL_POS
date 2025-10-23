<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-primary text-white">
      <h5 class="modal-title">Tambah Kategori</h5>
      <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
    </div>

    <form id="form-tambah" action="{{ url('kategori/ajax') }}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="mb-3">
          <label>Kode Kategori</label>
          <input type="text" name="kategori_kode" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama Kategori</label>
          <input type="text" name="kategori_nama" class="form-control" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
$('#form-tambah').submit(function(e){
  e.preventDefault();
  $.ajax({
    url: $(this).attr('action'),
    method: $(this).attr('method'),
    data: $(this).serialize(),
    success: function(response){
      if(response.status){
        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message })
        .then(() => {
          $('#myModal').modal('hide');
          $('#table_kategori').DataTable().ajax.reload(null, false);
        });
      } else {
        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
      }
    }
  });
});
</script>
