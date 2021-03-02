<form id="perbarui">
<input type="hidden" name="id" value="<?= sha1($edit->id_metode) ?>">
	<div class="form-group">
	      <label>Jenis Pembayaran</label>
	      <input type="text" 
	             name="deskripsi"
	             value="<?= $edit->deskripsi ?>"  
	             class="form-control" required>
	</div>
	<div class="form-group">
	      <label>Title Label</label>
	      <input type="text" 
	             name="title_label"
	             value="<?= $edit->title_label ?>"  
	             class="form-control" required>
	</div>
	<div class="form-group">
		<label>Multi Type Payment</label>
		<select name="status_form" class="form-control" required>
			<option value="">-- Pilih --</option>
			<option value="1" <?php if($edit->status_form == '1'): echo 'selected'; endif; ?>>Ya</option>
			<option value="0" <?php if($edit->status_form == '0'): echo 'selected'; endif; ?>>Tidak</option>
		</select>
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