<form id="perbarui">
<input type="hidden" name="id" value="<?= sha1($edit->id_barang) ?>">
  <div class="form-group">
      <label>Kode Obat</label>
      <input type="text" 
             value="<?= $edit->kode_barang ?>" 
             class="form-control" disabled>
  </div>

  <div class="form-group">
      <label>Nama Obat</label>
      <input type="text" 
             value="<?= $edit->nama_barang ?>" 
             class="form-control" disabled>
  </div>

  <div class="form-group">
      <label>Jumlah Stok</label>
      <input type="text" 
             name="jumlah_stok"
             value="<?= $edit->jumlah_stok ?>" 
             class="form-control" required>
  </div>

  <div class="form-group">
      <label>Harga Jual</label>
      <input type="text" 
             name="harga_jual"
             value="<?= number_format($edit->harga_jual) ?>" 
             class="form-control" required>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-danger" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn btn-success btn_edit">
	        <i class="fa fa-check"></i> Perbarui
	</button>
  </div>
</form>

<script type="text/javascript" charset="utf-8" async defer>
	$('#perbarui').validate({
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
	});

	$('[name=harga_jual]').maskNumber({integer: true});

</script>