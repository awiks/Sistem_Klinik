<form id="simpan">
  <div class="form-group">
      <label>Kode Supplier</label>
      <input type="text" 
      		 value="<?= $kode_supplier ?>" 
             name="kode_supplier" 
             class="form-control" readonly>
  </div>

  <div class="form-group">
      <label>Nama Supplier</label>
      <input type="text" 
             name="nama_supplier" 
             class="form-control" required>
  </div>

  <div class="form-group">
      <label>Alamat Supplier</label>
      <textarea name="alamat_supplier" 
                class="form-control" required></textarea>
  </div>

  <div class="form-group">
      <label>No telepon</label>
      <input type="text" 
             name="telepon" 
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