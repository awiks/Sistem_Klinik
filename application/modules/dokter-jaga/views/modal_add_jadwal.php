<form id="simpan_jadwal" action="<?= site_url('dokter-jaga/simpan_jadwal') ?>" method="post">
	<input type="hidden" name="id_jadwal" value="<?= $id_jadwal ?>">
  <div class="form-group">
      <label>Nama Poliklinik</label>
      <input type="text" 
             value="<?= $nama_poli ?>" 
             class="form-control" disabled>
  </div>

  <div class="form-group">
      <label>Dokter</label>
      <select name="id_dokter" 
               class="form-control select2" required>
               <option value="">-- Pilih Poliklinik --</option>
      	<?php
      		foreach ( $dokter as $rows ) {
      			
      			echo '<option value="'.$rows->id_dokter.'">'.$rows->nama_dokter.'</option>';
      		}
      	?>
      </select>
  </div>

  <div class="form-group">
      <label>Deskripsi</label>
      <input type="text"
             name="deskripsi_jadwal" 
             class="form-control" required>
  </div>

  <div class="row">
  	<div class="col-md-6">
  		<div class="form-group">
	      <label>Jam Awal</label>
	      <input type="text"
	             name="jam_start" 
                 class="form-control t1" required>
        </div>
  	</div>
  	<div class="col-md-6">
  		<div class="form-group">
	      <label>Jam  Akhir</label>
	      <input type="text"
	             name="jam_end" 
                 class="form-control t2" required>
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

  $(function(){

	$('#simpan_jadwal').validate({
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

 $('.t1').timepicker({
 	 showInputs: false,
  showMeridian: false

 });
 
 $('.t2').timepicker({
 	 showInputs: false,
   showMeridian: false
 });


	$('.select2').select2();
 
 });
</script>