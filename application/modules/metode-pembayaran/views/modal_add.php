<form id="simpan">
	<div class="form-group">
	      <label>Jenis Pembayaran</label>
	      <input type="text" 
	             name="deskripsi" 
	             class="form-control" required>
	</div>
	<div class="form-group">
	      <label>Title Label</label>
	      <input type="text" 
	             name="title_label" 
	             class="form-control" required>
	</div>
	<div class="form-group">
		<label>Multi Type Payment</label>
		<select name="status_form" class="form-control" required>
			<option value="">-- Pilih --</option>
			<option value="1">Ya</option>
			<option value="0">Tidak</option>
		</select>
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
	});
</script>