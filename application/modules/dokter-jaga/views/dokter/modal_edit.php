<form id="perbarui">
  <input type="hidden" name="id" value="<?= sha1($edit->id_dokter) ?>">
  <div class="row">
  	<div class="col-md-7">
  	  <div class="form-group">
        <label>Nama Dokter</label>
        <input type="text" 
               name="nama_dokter"
               value="<?= $edit->nama_dokter ?>" 
               class="form-control" required>
	  </div>
  	</div>
  	<div class="col-md-5">
  	  <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" 
               name="deskripsi"
               value="<?= $edit->deskripsi ?>" 
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
		             value="<?= $edit->tempat_lahir ?>" 
		             class="form-control" required>
		</div>
  	</div>
  	<div class="col-md-6">
  		<div class="form-group">
		      <label>Tanggal lahir</label>
		      <input type="text" 
		             name="tanggal_lahir"
		             value="<?= date('d-m-Y',strtotime($edit->tanggal_lahir)) ?>"
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
		      	<option value="L" <?php if($edit->jenis_kelamin == 'L'): echo 'selected'; endif; ?>>Laki-laki</option>
		      	<option value="P" <?php if($edit->jenis_kelamin == 'P'): echo 'selected'; endif; ?>>Perempuan</option>
		      </select>
		</div>
  	</div>
  	<div class="col-md-6">
  		<div class="form-group">
		      <label>No telepon</label>
		      <input type="text" 
		             name="no_telepon"
		             value="<?= $edit->no_telepon ?>" 
		             class="form-control" required>
		</div>
  	</div>
  </div>

  <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" 
               class="form-control" required><?= $edit->alamat ?></textarea>
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

	$('.tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
    });

</script>

