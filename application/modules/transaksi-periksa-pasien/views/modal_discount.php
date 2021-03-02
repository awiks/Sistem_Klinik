<form id="perbarui_discount">
	<input type="hidden" name="id" 
	       value="<?= sha1($edit->id_discount_ppn) ?>">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group number">
		      <label>Diskon %</label>
		      <input type="text" 
		             name="discount"
		             value="<?= $edit->discount ?>" 
		             class="form-control" required>
		    </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group number">
		      <label>PPN %</label>
		      <input type="text" 
		             name="ppn"
		             value="<?= $edit->ppn ?>" 
		             class="form-control" required>
		   </div>
		</div>
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
	$('#perbarui_discount').validate({
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