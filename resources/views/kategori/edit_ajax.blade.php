<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-warning text-white">
      <h5 class="modal-title">Edit Kategori</h5>
      <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
    </div>

    <form id="form-edit" action="{{ url('kategori/'.$kategori->kategori_id.'/update_ajax') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="mb-3">
          <label>Kode Kategori</label>
          <input type="text" name="kategori_kode" class="form-control" value="{{ $kategori->kategori_kode }}" required>
        </div>
        <div class="mb-3">
          <label>Nama Kategori</label>
          <input type="text" name="kategori_nama" class="form-control" value="{{ $kategori->kategori_nama }}" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
$('#form-edit').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'), // PUT
        data: $(this).serialize(),
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
        error: function(xhr){
            Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: xhr.responseText });
        }
    });
});

</script>
