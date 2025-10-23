<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-primary text-white">
      <h5 class="modal-title">Tambah Supplier</h5>
      <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
    </div>

    <form id="form-tambah" action="{{ url('supplier/ajax') }}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="mb-3">
          <label>Kode Supplier</label>
          <input type="text" name="supplier_kode" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama Supplier</label>
          <input type="text" name="supplier_nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <input type="text" name="supplier_alamat" class="form-control">
        </div>
        <div class="mb-3">
          <label>No. HP</label>
          <input type="text" name="supplier_phone" class="form-control">
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
                Swal.fire({ icon:'success', title:'Berhasil', text:response.message })
                .then(() => {
                    $('#myModal').modal('hide');
                    $('#table_supplier').DataTable().ajax.reload(null,false);
                });
            } else {
                Swal.fire({ icon:'error', title:'Gagal', text:response.message });
            }
        },
        error: function(){
            Swal.fire({ icon:'error', title:'Terjadi Kesalahan', text:'Coba lagi nanti.' });
        }
    });
});
</script>
