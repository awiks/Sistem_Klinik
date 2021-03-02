<form id="perbarui" method="post">
  <input type="hidden" name="id" value="<?= sha1($edit->id_daftar_pasien) ?>">
  <div class="row">
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>No Rekam Medik</label>
	  	<input type="text" value="<?= $edit->no_rekam_medik ?>" 
	  	      class="form-control" 
	  	      name="no_rekam_medik" required readonly>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>Tanggal Daftar</label>
	  	<input type="text" value="<?= date('d-m-Y',strtotime($edit->tanggal_daftar)) ?>" 
	  	      class="form-control" 
	  	      name="tanggal_daftar" required readonly>
	  </div>
  	</div>
  </div>

  <div class="row">
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>Nama Pasien</label>
	  	<input type="text" value="<?= $edit->nama_pasien ?>" 
	  	      class="form-control" 
	  	      name="nama_pasien" required disabled>
	  </div>
  	</div>
  	<div class="col-md-6">
  	  <div class="form-group">
	  	<label>Tanggal lahir</label>
	  	<input type="text" 
	  	      class="form-control dt"
	  	      value="<?= date('d-m-Y',strtotime($edit->tanggal_lahir)) ?>" 
	  	      placeholder="dd-mm-yyyy" 
	  	      name="tanggal_lahir" required disabled>
	  </div>
  	</div>
  </div>
  
  <div class="row">
  	<div class="col-md-4">
  		<div class="form-group">
  			<label>Jenis Kelamin</label>
  			<select name="jenis_kelamin" class="form-control" required disabled>
  				<option value="">-- Pilih --</option>
  				<option value="L" <?php if($edit->jenis_kelamin=="L"): echo 'selected'; endif; ?>>Laki - laki</option>
  				<option value="P" <?php if($edit->jenis_kelamin=="P"): echo 'selected'; endif; ?>>Perempuan</option>
  			</select>
  		</div>
  	</div>
  	<div class="col-md-4">
  		<div class="form-group">
  			<div class="form-group">
			  	<label>Golongan darah</label>
			  	<input type="text" value="<?= $edit->golongan_darah ?>" 
			  	      class="form-control" 
			  	      name="golongan_darah" required disabled>
			</div>
  		</div>
  	</div>
  	<div class="col-md-4">
		<div class="form-group">
		  	<label>No telepon</label>
		  	<input type="text" value="<?= $edit->no_telepon ?>" 
		  	      class="form-control" 
		  	      name="no_telepon" required disabled>
		</div>
  	</div>
  </div>

  <div class="form-group">
  	<label>Alamat</label>
  	<input type="text" value="<?= $edit->alamat_pasien ?>" 
  	      class="form-control" 
  	      name="alamat_pasien" required disabled>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">

 	<button type="button" 
	        class="btn bg-blue unlock"
	        id="btn_add_baru" style="display:block">
	        <i class="fa fa-lock"></i> Lock

	<button type="button" 
	        class="btn btn-danger" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn btn-success btn_edit"
	        style="display:none">
	        <i class="fa fa-check"></i> Perbarui
	</button>
	
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

  $('.dt').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
  });

  $('body').on('click', '.unlock', function(event) {
  	event.preventDefault();
  	/* Act on the event */
  	$('[name="nama_pasien"]').prop('disabled', false);
  	$('[name="tanggal_lahir"]').prop('disabled', false);
  	$('[name="jenis_kelamin"]').prop('disabled', false);
  	$('[name="golongan_darah"]').prop('disabled', false);
  	$('[name="no_telepon"]').prop('disabled', false);
  	$('[name="alamat_pasien"]').prop('disabled', false);

  	$('.btn_edit').css('display', 'block');
  	$('.unlock').html('<i class="fa fa-unlock"></i> Unlock');
  	$('.unlock').addClass('lock');
  	$('.unlock').removeClass('unlock')
  });

  $('body').on('click', '.lock', function(event) {
  	event.preventDefault();
  	/* Act on the event */
  	$('[name="nama_pasien"]').prop('disabled', true);
  	$('[name="tanggal_lahir"]').prop('disabled', true);
  	$('[name="jenis_kelamin"]').prop('disabled', true);
  	$('[name="golongan_darah"]').prop('disabled', true);
  	$('[name="no_telepon"]').prop('disabled', true);
  	$('[name="alamat_pasien"]').prop('disabled', true);

  	$('.btn_edit').css('display', 'none');
  	$('.lock').html('<i class="fa fa-lock"></i> Lock');
  	$('.lock').addClass('unlock');
  	$('.lock').removeClass('lock')
  });

</script>