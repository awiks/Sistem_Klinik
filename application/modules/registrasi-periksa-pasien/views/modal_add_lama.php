<form id="simpan_lama" method="post">

  <div class="row">
  	<div class="col-md-6">
  		<div class="form-group">
	      <label>No Registrasi</label>
	      <input type="text" value="<?= $no_registrasi ?>" 
	            class="form-control" 
	            name="no_registrasi" required readonly>
	    </div>
  	</div>
  	<div class="col-md-6">
  		<div class="form-group">
			<label>Tanggal daftar</label>
			<input type="text" value="<?= $tanggal ?>" 
			      class="form-control" 
			      name="tanggal" required readonly>
		</div>
  	</div>
  </div>

<div class="form-group">
	<label>No RM / Nama Pasien</label>
	<select name="id_daftar_pasien" 
	        class="form-control select2" 
	        required>
	</select>
</div>

<div class="form-group">
	<label>Poliklinik</label>
	<select name="id_jadwal" class="form-control" required>
		<option value="">-- Pilih Poliklinik --</option>
		<?php
			foreach ( $jadwal as $rows ) {
				
				echo '<option value="'.$rows->id_jadwal.'">'.$rows->nama_poliklinik.'</option>';
			}
		?>
	</select>
</div>

<div class="form-group">
	<label>Jadwal dokter</label>
	<select name="id_detail_praktek" class="form-control" required>
		<option value="">-- Pilih Jadwal dokter --</option>
	</select>
</div>

<div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-danger" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn bg-olive btn_lama">
	        <i class="fa fa-check"></i> Simpan
	</button>
</div>
</form>

<script type="text/javascript" charset="utf-8" async defer>

	$('#simpan_lama').validate({
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

	$('body').on('change', '[name="id_jadwal"]', function(event) {
	    event.preventDefault();
	    /* Act on the event */

	    var id_jadwal = $('[name="id_jadwal"]').val();

	    $.ajax({
	      url: '<?= site_url('registrasi-periksa-pasien/selected_poli') ?>',
	      type: 'post',
	      dataType: 'json',
	      data: {id_jadwal: id_jadwal,},
	      success : function(data)
	      {
	        var record = ''; 
	        $.each(data,function(i, item) {
	          record += '<option value="'+item.id_detail+'">'+item.nama_dokter+' - '+item.deskripsi_jadwal+ ' - '+item.jam_kunjungan+'</option>'; 
	        })

	        $('[name="id_detail_praktek"]').html('<option value="">-- Pilih Jadwal dokter --</option>'+record);
	      }
	    })
	});

	$('.select2').select2({
      placeholder: 'Ketik No Rm / Nama Pasien ...',
      allowClear: true,
      minimumInputLength: 3,
      minimumResultsForSearch: 20,
      ajax: {
        url: '<?= site_url('registrasi-periksa-pasien/select_side_pasien') ?>',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: data
          };
        },
        cache: true
      }
    });

</script>