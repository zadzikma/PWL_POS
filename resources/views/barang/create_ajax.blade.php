<div class="modal fade" id="modalCreateAjax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Barang (AJAX)</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formCreateAjax">
          @csrf
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="barang_kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="barang_nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
              @foreach($kategori as $kat)
                <option value="{{ $kat->kategori_id }}">{{ $kat->kategori_nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control">
              @foreach($supplier as $sup)
                <option value="{{ $sup->supplier_id }}">{{ $sup->supplier_nama }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
