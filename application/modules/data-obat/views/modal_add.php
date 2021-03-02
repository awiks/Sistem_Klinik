<form id="simpan">
  <div class="form-group">
      <label>Kode Obat</label>
      <input type="text"
             value="<?= $no_surat ?>" 
             name="kode_barang" 
             class="form-control" readonly>
  </div>

  <div class="form-group">
      <label>Kategori</label>
      <select name="id_kategori" 
             class="form-control" required>
       <option value="">-- Pilih Kategori -- </option>
       <?php
       	foreach ( $kategori as $rows ) {

       		echo '<option value="'.$rows->id_kategori.'">'.$rows->nama_kategori.'</option>';

       	}
       ?>
       </select>
  </div>

  <div class="form-group">
      <label>Nama Obat</label>
      <input type="text" 
             name="nama_barang" 
             class="form-control" required>
  </div>

  <div class="form-group">
      <label>Satuan</label>
      <select name="id_satuan" 
             class="form-control" required>
       <option value="">-- Pilih Satuan -- </option>
       <?php
        foreach ( $satuan as $rows ) {

          echo '<option value="'.$rows->id_satuan.'">'.$rows->nama_satuan.'</option>';

        }
       ?>
       </select>
  </div>

  <div class="form-group">
      <label>Aturan Pakai</label>
      <input type="text" 
             name="aturan_pakai" 
             class="form-control" required>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-danger" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn bg-olive btn_add">
	        <i class="fa fa-check"></i> Simpan
	</button>
  </div>
</form>

<script type="text/javascript" charset="utf-8" async defer>
	$('#simpan').validate({
		errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	})

</script>