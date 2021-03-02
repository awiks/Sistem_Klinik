<form id="perbarui">
<input type="hidden" name="id" value="<?= sha1($edit->id_satuan) ?>">
  <div class="form-group">
      <label>Satuan</label>
      <input type="text" 
             name="nama_satuan"
             value="<?= $edit->nama_satuan ?>" 
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
	})

</script>