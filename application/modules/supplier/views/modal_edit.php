<form id="perbarui" method="post">
  <input type="hidden" name="id" value="<?= sha1($edit->id_supplier) ?>">
  <div class="form-group">
      <label>Kode Supplier</label>
      <input type="text" 
      		 value="<?= $edit->kode_supplier ?>" 
             name="kode_supplier" 
             class="form-control" disabled>
  </div>

  <div class="form-group">
      <label>Nama Supplier</label>
      <input type="text"
             value="<?= $edit->nama_supplier ?>" 
             name="nama_supplier" 
             class="form-control" required>
  </div>

  <div class="form-group">
      <label>Alamat Supplier</label>
      <textarea name="alamat_supplier" 
                class="form-control" required><?= $edit->alamat_supplier ?></textarea>
  </div>

  <div class="form-group">
      <label>No telepon</label>
      <input type="text" 
             name="telepon"
             value="<?= $edit->telepon ?>"  
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

</script>