<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-primary text-white">
      <h5 class="modal-title">Edit Data User</h5>
      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <form id="form-edit" action="{{ url('user/'.$user->user_id.'/update_ajax') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="modal-body">
        <div class="mb-3">
          <label>Level Pengguna</label>
          <select name="level_id" class="form-control" required>
            <option value="">- Pilih Level -</option>
            @foreach($level as $item)
              <option value="{{ $item->level_id }}" {{ $user->level_id == $item->level_id ? 'selected' : '' }}>
                {{ $item->level_nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" value="{{ $user->username }}" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="nama" value="{{ $user->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
          <small class="form-text text-muted">Abaikan jika tidak ingin ubah password</small>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
$('#form-edit').submit(function(e){
    e.preventDefault();
    var form = $(this);

    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        beforeSend: function() {
            // ✅ disable tombol simpan biar gak diklik dua kali
            form.find('button[type="submit"]').prop('disabled', true);
        },
        success: function(response){
            if(response.status){
                // ✅ Tutup modal DULU biar form hilang dari belakang
                $('#myModal').modal('hide');

                // ✅ Baru munculkan notifikasi berhasil
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                }).then(() => {
                    // ✅ Reload tabel tanpa refresh halaman
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
        error: function(){
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Silakan coba lagi.'
            });
        },
        complete: function() {
            // ✅ aktifkan kembali tombol simpan setelah request selesai
            form.find('button[type="submit"]').prop('disabled', false);
        }
    });
});
</script>
