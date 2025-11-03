<div class="modal fade" id="modalEditAjax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Barang (AJAX)</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formEditAjax">
          @csrf
          @method('PUT')
          <input type="hidden" name="barang_id" id="edit_barang_id">

          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="barang_kode" id="edit_barang_kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="barang_nama" id="edit_barang_nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" id="edit_harga_beli" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" id="edit_harga_jual" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-warning">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
