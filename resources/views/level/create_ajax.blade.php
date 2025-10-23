<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-primary text-white">
      <h5 class="modal-title">Tambah Data Level (AJAX)</h5>
      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <form id="form-tambah" action="{{ url('level/ajax') }}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="mb-3">
          <label>Kode Level</label>
          <input type="text" name="level_kode" class="form-control" placeholder="Masukkan kode level" required>
        </div>
        <div class="mb-3">
          <label>Nama Level</label>
          <input type="text" name="level_nama" class="form-control" placeholder="Masukkan nama level" required>
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
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response){
            if(response.status){
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: response.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                $('#myModal').modal('hide');          
                $('body').removeClass('modal-open');  
                $('.modal-backdrop').remove();        
                $('#table_level').DataTable().ajax.reload(null, false); 
            });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: response.message
                });
            }
        },
        error: function(){
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Coba lagi nanti!'
            });
        }
    });
});
</script>
