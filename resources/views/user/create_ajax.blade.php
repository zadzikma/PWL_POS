<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-primary text-white">
      <h5 class="modal-title">Form Tambah User (AJAX)</h5>
      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <form id="form-tambah" action="{{ url('user/ajax') }}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Level</label>
          <div class="col-sm-9">
            <select name="level_id" class="form-control" required>
              <option value="">Pilih Level</option>
              @foreach($level as $item)
                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Username</label>
          <div class="col-sm-9">
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Password</label>
          <div class="col-sm-9">
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
          </div>
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
          text: response.message
        }).then(() => {
          $('#myModal').modal('hide');
          $('#table_user').DataTable().ajax.reload(null, false);
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Validasi Gagal!',
          text: response.message
        });
      }
    },
    error: function(xhr){
      Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: 'Coba lagi nanti!'
      });
    }
  });
});
</script>
