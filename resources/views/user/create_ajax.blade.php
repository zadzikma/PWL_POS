<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Tambah Data User</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <form id="form-tambah" action="{{ url('user/ajax') }}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="level_id">Level Pengguna</label>
          <select name="level_id" id="level_id" class="form-control" required>
            <option value="">- Pilih Level -</option>
            @foreach($level as $item)
              <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
      </div>

      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
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
                // ✅ Tutup modal dulu sebelum alert tampil
                $('#myModal').modal('hide');

                // ✅ Baru tampilkan pesan sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message
                }).then(() => {
                    // ✅ Setelah klik OK, reload tabel
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

