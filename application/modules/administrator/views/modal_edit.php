<form id="perbarui">
 <input type="hidden" name="id" value="<?= sha1($edit->id_admin) ?>">
  <div class="form-group">
      <label>Kode Admin</label>
      <input type="text"
             value="<?= $edit->kode_admin ?>" 
             name="kode_admin" 
             class="form-control" disabled>
  </div>

  <div class="form-group">
      <label>Nama Admin</label>
      <input type="text"
             value="<?= $edit->nama_admin ?>" 
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
	       <option value="L" <?php if($edit->jenis_kelamin == 'L'): echo 'selected'; endif; ?>>Laki-laki</option>
	       <option value="P" <?php if($edit->jenis_kelamin == 'P'): echo 'selected'; endif; ?>>Perempuan</option>
	       </select>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	      <label>Role Akses</label>
	      <select name="role" 
	              class="form-control" required>
	        <option value="">-- Pilih -- </option>
	        <option value="Admin" <?php if($edit->role == 'Admin'): echo 'selected'; endif; ?>>Admin</option>
	        <option value="Pimpinan" <?php if($edit->role == 'Pimpinan'): echo 'selected'; endif; ?>>Pimpinan</option>
	        
	       </select>
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