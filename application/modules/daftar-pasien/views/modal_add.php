<form id="simpan_add" method="post">
  
  <div class="row">
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>No Rekam Medik</label>
	  	<input type="text" value="<?= $kode_rekam ?>" 
	  	      class="form-control" 
	  	      name="no_rekam_medik" required readonly>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>Tanggal Daftar</label>
	  	<input type="text" value="<?= date('d-m-Y') ?>" 
	  	      class="form-control" 
	  	      name="tanggal_daftar" required readonly>
	  </div>
  	</div>
  </div>

  <div class="row">
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>Nama Pasien</label>
	  	<input type="text"
	  	      class="form-control" 
	  	      name="nama_pasien" required>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>Tanggal lahir</label>
	  	<input type="text" 
	  	      class="form-control dt"
	  	      placeholder="dd-mm-yyyy" 
	  	      name="tanggal_lahir" required>
	  </div>
  	</div>
  </div>
  
  <div class="row">
  	<div class="col-md-4">
  		<div class="form-group">
  			<label>Jenis Kelamin</label>
  			<select name="jenis_kelamin" class="form-control" required>
  				<option value="">-- Pilih --</option>
  				<option value="L">Laki - laki</option>
  				<option value="P">Perempuan</option>
  			</select>
  		</div>
  	</div>
  	<div class="col-md-4">
  		<div class="form-group">
  			<div class="form-group">
			  	<label>Golongan darah</label>
			  	<input type="text" 
			  	      class="form-control" 
			  	      name="golongan_darah" required>
			</div>
  		</div>
  	</div>
  	<div class="col-md-4">
		<div class="form-group">
		  	<label>No telepon</label>
		  	<input type="text" 
		  	      class="form-control" 
		  	      name="no_telepon" required>
		</div>
  	</div>
  </div>

  <div class="form-group">
  	<label>Alamat</label>
  	<input type="text"
  	      class="form-control" 
  	      name="alamat_pasien" required>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-danger" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn bg-olive"
	        id="btn_add_baru">
	        <i class="fa fa-check"></i> Simpan
	</button>
  </div>
</form>

<script type="text/javascript" charset="utf-8" async defer>

	$('#simpan_add').validate({
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

  $('.dt').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
  });

</script>