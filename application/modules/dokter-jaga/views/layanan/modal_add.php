<form id="simpan">
  <div class="form-group">
      <label>Poliklinik</label>
      <select name="id_poliklinik" 
               class="form-control select2" required>
               <option value="">-- Pilih Poliklinik --</option>
      	<?php
      		foreach ( $poliklinik as $rows ) {
      			
      			echo '<option value="'.$rows->id_poliklinik.'">'.$rows->nama_poliklinik.'</option>';
      		}
      	?>
      </select>
  </div>

  <div class="form-group">
      <label>Deskripsi</label>
      <input type="text" 
             name="deskripsi_layanan"
             class="form-control" required>
 </div>

 <div class="form-group">
      <label>Harga Layanan</label>
      <input type="text" 
             name="harga_layanan"
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
	});

	$('.select2').select2();

  $('[name=harga_layanan]').maskNumber({integer: true});

</script>