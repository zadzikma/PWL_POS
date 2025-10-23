<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Data Level</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form id="form-edit" method="POST" action="{{ url('level/' . $level->level_id . '/update_ajax') }}">
            @csrf
            @method('PUT')

            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Level</label>
                    <input type="text" name="level_kode" class="form-control" value="{{ $level->level_kode }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Level</label>
                    <input type="text" name="level_nama" class="form-control" value="{{ $level->level_nama }}" required>
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
$('#form-edit').submit(function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
            if (response.status) {
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
                    title: 'Gagal!',
                    text: response.message
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Coba lagi nanti.'
            });
        }
    });
});
</script>
