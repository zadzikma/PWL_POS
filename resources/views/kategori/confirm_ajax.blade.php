<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-danger text-white">
      <h5 class="modal-title">Hapus Kategori</h5>
      <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
      <p>Apakah Anda yakin ingin menghapus kategori <strong>{{ $kategori->kategori_nama }}</strong>?</p>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      <button type="button" class="btn btn-danger" onclick="deleteData('{{ url('kategori/'.$kategori->kategori_id.'/delete_ajax') }}')">Hapus</button>
    </div>
  </div>
</div>
