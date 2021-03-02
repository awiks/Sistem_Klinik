<form id="simpan">

  <div class="form-group">
      <label>Kode Admin</label>
      <input type="text"
             value="<?= $kode_admin ?>" 
             name="kode_admin" 
             class="form-control" readonly>
  </div>

  <div class="form-group">
      <label>Nama Admin</label>
      <input type="text" 
             name="nama_admin" 
             class="form-control" required>
  </div>

  <div class="row">
  	<div class="col-md-6">
  	  <div class="form-group">
	      <label>Jenis Kelamin</label>
	      <select name="jenis_kelamin" 
	              class="form-control" required>
	       <option value="">-- Pilih -- </option>
	       <option value="L">Laki-laki</option>
	       <option value="P">Perempuan</option>
	       </select>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	      <label>Role Akses</label>
	      <select name="role" 
	              class="form-control" required>
	       <option value="">-- Pilih -- </option>
	       <option value="Admin">Admin</option>
	       <option value="Pimpinan">Pimpinan</option>
	       </select>
	  </div>
  	</div>
  </div>

  <div class="row">
  	<div class="col-md-6">
  	  <div class="form-group">
	      <label>Username</label>
	      <input type="text" 
	             name="username" 
	             class="form-control" required>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	      <label>Password</label>
	      <input type="text" 
	             name="password" 
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