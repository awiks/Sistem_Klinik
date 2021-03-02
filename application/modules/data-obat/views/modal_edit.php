<form id="perbarui">
  <input type="hidden" name="id" value="<?= sha1($edit->id_barang) ?>">
  <div class="form-group">
      <label>Kode Obat</label>
      <input type="text"
             value="<?= $edit->kode_barang ?>" 
             name="kode_barang" 
             class="form-control" disabled>
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
      <label>Nama Obat</label>
      <input type="text" 
             name="nama_barang"
             value="<?= $edit->nama_barang ?>" 
             class="form-control" required>
  </div>

  <div class="form-group">
      <label>Satuan</label>
      <select name="id_satuan" 
             class="form-control" required>
             <option value="">-- Pilih Satuan -- </option>
             <?php
              foreach ( $satuan as $rows ) {

                if ( $rows->id_satuan == $edit->id_satuan ){
                  $selected = 'selected';
                }
                else{
                  $selected ='';
                }

                echo '<option value="'.$rows->id_satuan.'" '.$selected.'>
                          '.$rows->nama_satuan.'
                      </option>';

              }
             ?>
             </select>
  </div>

  <div class="form-group">
      <label>Aturan Pakai</label>
      <input type="text" 
             name="aturan_pakai"
             value="<?= $edit->aturan_pakai ?>" 
             class="form-control" required>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-danger" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn bg-success btn_edit">
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