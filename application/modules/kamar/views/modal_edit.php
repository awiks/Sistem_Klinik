<form id="perbarui">
<input type="hidden" name="id" value="<?= sha1($edit->id_kamar) ?>">

   <div class="form-group">
      <label>Kode Kamar</label>
      <input type="text"
             value="<?= $edit->kode_kamar ?>" 
             name="kode_kamar" 
             class="form-control" readonly>
  </div>

  <div class="form-group">
      <label>Kategori</label>
      <select name="id_kategori" 
             class="form-control" required>
             <option value="">-- Pilih Kategori -- </option>
             <?php
             	foreach ( $kategori as $rows ) {

                if ( $rows->id_kategori == $edit->id_kategori ){
                  $selected = 'selected';
                }
                else{
                  $selected ='';
                }

             		echo '<option value="'.$rows->id_kategori.'" '.$selected.'>
                          '.$rows->nama_kategori.'
                      </option>';

             	}
             ?>
             </select>
  </div>

  <div class="form-group">
      <label>Nama Kamar</label>
      <input type="text" 
             name="nama_kamar"
             value="<?= $edit->nama_kamar ?>" 
             class="form-control" required>
  </div>

  <div class="form-group">
      <label>Harga Kamar</label>
      <input type="text" 
             name="harga_kamar"
             value="<?= number_format($edit->harga_kamar) ?>" 
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