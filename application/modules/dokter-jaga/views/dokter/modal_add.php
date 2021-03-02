<form id="simpan">
  <div class="row">
  	<div class="col-md-7">
  	  <div class="form-group">
        <label>Nama Dokter</label>
        <input type="text" 
               name="nama_dokter" 
               class="form-control" required>
	  </div>
  	</div>
  	<div class="col-md-5">
  	  <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" 
               name="deskripsi" 
               class="form-control" required>
	  </div>
  	</div>
  </div>

  <div class="row">
  	<div class="col-md-6">
  		<div class="form-group">
		      <label>Tempat lahir</label>
		      <input type="text" 
		             name="tempat_lahir" 
		             class="form-control" required>
		</div>
  	</div>
  	<div class="col-md-6">
  		<div class="form-group">
		      <label>Tanggal lahir</label>
		      <input type="text" 
		             name="tanggal_lahir"
		             placeholder="dd-mm-yyyy" 
		             class="form-control tanggal" required>
		</div>
  	</div>
  </div>

  <div class="row">
  	<div class="col-md-6">
  		<div class="form-group">
		      <label>Jenis Kelamin</label>
		      <select name="jenis_kelamin" 
		               class="form-control" required>
		      	<option value="">-- Pilih Jenis kelamin --</option>
		      	<option value="L">Laki-laki</option>
		      	<option value="P">Perempuan</option>
		      </select>
		</div>
  	</div>
  	<div class="col-md-6">
  		<div class="form-group">
		      <label>No telepon</label>
		      <input type="text" 
		             name="no_telepon" 
		             class="form-control" required>
		</div>
  	</div>
  </div>

  <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" 
               class="form-control" required></textarea>
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

	$('.tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
    });

</script>

