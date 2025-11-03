<div class="modal fade" id="modalConfirmAjax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Konfirmasi Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">&times;</button>
      </div>
      <div class="modal-body">
        <p>Apakah kamu yakin ingin menghapus data barang ini?</p>
        <input type="hidden" id="delete_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" id="btnDeleteAjax" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
