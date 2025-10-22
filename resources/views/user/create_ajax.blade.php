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
                    // ✅ Tutup modal setelah klik OK
                    $('#myModal').modal('hide');
                    // ✅ Reload DataTable tanpa reset halaman
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
