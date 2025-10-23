<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-danger text-white">
      <h5 class="modal-title">Konfirmasi Hapus Data Level</h5>
      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <form id="form-hapus" action="{{ url('level/' . $level->level_id . '/delete_ajax') }}" method="POST">
      @csrf
      @method('DELETE')

      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus level berikut ini?</p>
        <ul>
          <li><strong>Kode Level:</strong> {{ $level->level_kode }}</li>
          <li><strong>Nama Level:</strong> {{ $level->level_nama }}</li>
        </ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
      </div>
    </form>
  </div>
</div>

<script>
$('#form-hapus').submit(function(e){
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
                    text: response.message
                }).then(() => {
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
        error: function(xhr){
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Coba lagi nanti.'
            });
        }
    });
});
</script>
