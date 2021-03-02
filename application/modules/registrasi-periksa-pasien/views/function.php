<script type="text/javascript" charset="utf-8" async defer>

	$('.tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
    });

    function display_ct() {
		var x = new Date()
		// time part //
		var hour=x.getHours();
		var minute=x.getMinutes();
		var second=x.getSeconds();
		if(hour <10 ){hour='0'+hour;}
		if(minute <10 ) {minute='0' + minute; }
		if(second<10){second='0' + second;}
		
		x1 = hour+':'+minute+':'+second;
		document.getElementById('ct').innerHTML = x1;
		display_c();
	}


	function display_c(){
	var refresh=10; // Refresh rate in milli seconds
		mytime=setTimeout('display_ct()',refresh)
	}
    
    display_c()

    function tampildata()
    {
      var tanggal = $('.tanggal').val();
      var jadwal  = $('.jadwal').val();

      $("#myTable").DataTable({

        "processing": false,
        "serverSide": false,
        "ajax" :{
          url : "<?= site_url('registrasi-periksa-pasien/ajax_jadwal') ?>",
          type: "POST",
              dataType: "json",
              data:{
                tanggal:tanggal,
                jadwal:jadwal,
              }
        },
        "columns" : [{ "data" : "nomor" }, 
                     { "data" : "no_registrasi"}, 
                     { "data" : "no_rekam_medik"}, 
                     { "data" : "nama_pasien" }, 
                     { "data" : "jam_daftar" }, 
                     { "data" : "no_antrian" }, 
                     { "data" : "status" }, 
                     { "data" : "aksi" }],
          //Set column definition initialisation properties
          "columnDefs": [{ 
            "targets": [0],
            "orderable": false
          }]
      });
    }

    tampildata();

    function check_jadwal()
    {
    	var tanggal = $('.tanggal').val();

    	$.ajax({
    		url: '<?= site_url('registrasi-periksa-pasien/check_jadwal') ?>',
    		type: 'post',
    		dataType: 'script',
    		data: {tanggal: tanggal},
    		success : function(data)
    		{
    		  $('.add_lama').prop("disabled", data);
    		  $('.add_baru').prop("disabled", data);
    		  $('.jadwal').prop("disabled", data);
    		}
    	})
    }

    check_jadwal();

    function select_jadwal()
    {
    	var tanggal = $('.tanggal').val();

    	$.ajax({
    		url: '<?= site_url('registrasi-periksa-pasien/select_jadwal') ?>',
    		type: 'post',
    		dataType: 'json',
    		data: {tanggal: tanggal,},
    		success : function(data)
		    {
		        var record = ''; 
		        $.each(data,function(i, item) {
		          record += '<option value="'+item.id_detail+'">'+item.nama_poliklinik+' - '+item.nama_dokter+' - '+item.deskripsi_jadwal+ ' - '+item.jam_kunjungan+'</option>'; 
		        })

		        $('.jadwal').html('<option value="all">All Schedule</option>'+record);
		    }
    	})
    }

    select_jadwal();
	
	function tampil_antrian()
	{
		var tanggal = $('.tanggal').val();

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/tampil_antrian') ?>',
			type: 'post',
			dataType: 'html',
			data: {tanggal: tanggal,},
			beforeSend: function(){   
	          $(".load").css('display','block');
	        },
	        complete: function(){
	          $(".load").css('display','none');
	        },
	        success : function(data){
	          $('#tampil_antrian').html(data);
	        }
		})
	}

	tampil_antrian();

	$('body').on('change', '.tanggal', function(event) {
	    event.preventDefault();
	    /* Act on the event */
	    tampil_antrian();
	    check_jadwal();
	    select_jadwal();

	    $('#myTable').DataTable().destroy();
	    tampildata();
	});

	$('body').on('change', '.jadwal', function(event) {
	    event.preventDefault();
	    /* Act on the event */
		
		$('#myTable').DataTable().destroy();
	    tampildata();
	});

	$('body').on('click', '.add_lama', function(event) {
		event.preventDefault();
		/* Act on the event */
		var tanggal = $('.tanggal').val();

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/add_lama') ?>',
			type: 'post',
			dataType: 'html',
			data: {tanggal:tanggal,},
			beforeSend: function(){   
	          $(".load-add").css('display','block');
	        },
	        complete: function(){
	          $(".load-add").css('display','none');
	        },
	        success : function(data){
	          $('.modal-add').html(data);
	          $('.modal-title').text('Add data Pasien Lama');
	        }
		});
		
	});

	$('body').on('submit', '#simpan_lama', function(event) {
		event.preventDefault();
		/* Act on the event */

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/simpan_lama') ?>',
			type: 'post',
	        dataType: 'html',
	        data: new FormData(this),
	        contentType: false,       
	        cache: false,             
	        processData:false,
	        beforeSend: function(){   
	          $('.btn_lama').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
	        },
	        complete: function(){
	          $('.btn_lama').html('<i class="fa fa-check"></i> Simpan');
	        },
	        success : function(data)
	        {
	          if(data=='oke')
	          {
	          	tampil_antrian();

	          	$('#myTable').DataTable().destroy();
	            tampildata();

	          	$('#Modal-add .close').click();
	          	toastr.success('Data berhasil ditambahkan');
	          }
	          else if(data=='ada'){

	          	toastr.warning('Nama pasien yang anda pilih sudah terdaftar di tanggal ini.');
	          }
	          else
	          {
	          	toastr.error('Data gagal ditambahkan');
	          }
	        }
		})
		
	});

	$('body').on('click', '.add_baru', function(event) {
		event.preventDefault();
		/* Act on the event */

		var tanggal = $('.tanggal').val();

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/add_baru') ?>',
			type: 'post',
			dataType: 'html',
			data: {tanggal:tanggal,},
			beforeSend: function(){   
	          $(".load-lg").css('display','block');
	        },
	        complete: function(){
	          $(".load-lg").css('display','none');
	        },
	        success : function(data){
	          $('.modal-add-lg').html(data);
	          $('.title').text('Add data Pasien Baru');
	        }
		})
	
	});

	$('body').on('submit', '#simpan_baru', function(event) {
		event.preventDefault();
		/* Act on the event */

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/simpan_baru') ?>',
			type: 'post',
	        dataType: 'html',
	        data: new FormData(this),
	        contentType: false,       
	        cache: false,             
	        processData:false,
	        beforeSend: function(){   
	          $('.btn_baru').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
	        },
	        complete: function(){
	          $('.btn_baru').html('<i class="fa fa-check"></i> Simpan');
	        },
	        success : function(data)
	        {
	          if(data=='oke')
	          {
	          	tampil_antrian();

	          	$('#myTable').DataTable().destroy();
	            tampildata();

	          	$('#Modal-lg .close').click();
	          	toastr.success('Data berhasil ditambahkan<br>Harap untuk mencetak kartu Pasien di Daftar Pasien');
	          }
	          else
	          {
	          	toastr.error('Data gagal ditambahkan');
	          }
	        }
		})
		
	});

	$('body').on('click', '.cetak', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).attr('id');
		window.open('<?= site_url('registrasi-periksa-pasien/cetak') ?>/'+id+'','_blank', 'width=800, height=500' );
	});

	$('body').on('click', '.proses', function(event) {
		event.preventDefault();
		/* Act on the event */

		var id   = $(this).attr('id');
		var name = $(this).data('name');
		var code = $(this).data('code');
		var count = $(this).data('count');
		var time = $(this).data('time');
		var date = $(this).data('date');
		var poli = $(this).data('poli');
		var doct = $(this).data('doct');
		var praktek = $(this).data('praktek');
		var status = $(this).data('status');

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/modal_proses') ?>',
			type: 'post',
			dataType: 'html',
			data: {id: id,name:name,code:code,count:count,time:time,date:date,poli:poli,doct:doct,praktek:praktek,status:status,},
			beforeSend: function(){   
	          $(".load-add").css('display','block');
	        },
	        complete: function(){
	          $(".load-add").css('display','none');
	        },
	        success : function(data){
	          $('.modal-add').html(data);
	          $('.modal-title').text('Konfirmasi');
	        }
		});
		
	});

	$('body').on('click', '.proses_btn', function(event) {
		event.preventDefault();
		/* Act on the event */

		var id = $(this).data('id');

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/proses_btn') ?>',
			type: 'post',
			dataType: 'html',
			data: {id: id},
			beforeSend: function(){   
	          $('.proses_btn').html('<i class="fa fa-spinner fa-spin default"></i> Proccesing...');
	        },
	        complete: function(){
	          $('.proses_btn').html('<i class="fas fa-spinner"></i> Proses');
	        },
			success : function(data)
			{
			  if(data=='oke')
	          {
	          	$('#myTable').DataTable().destroy();
	            tampildata();

	          	$('#Modal-add .close').click();
	          	toastr.success('Data berhasil diproses');
	          }
	          else
	          {
	          	toastr.error('Data gagal diproses');
	          }
			}
		});
		
	});

	$('body').on('click', '.pending_btn', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/pending_btn') ?>',
			type: 'post',
			dataType: 'html',
			data: {id: id},
			beforeSend: function(){   
	          $('.pending_btn').html('<i class="fa fa-spinner fa-spin default"></i> Proccesing...');
	        },
	        complete: function(){
	          $('.pending_btn').html('<i class="fas fa-hourglass-half"></i> Pending');
	        },
			success : function(data)
			{
			  if(data=='oke')
	          {
	          	$('#myTable').DataTable().destroy();
	            tampildata();

	          	$('#Modal-add .close').click();
	          	toastr.warning('Proses pending berhasil dilakukan');
	          }
	          else
	          {
	          	toastr.error('Proses pending gagal dilakukan');
	          }
			}
		});
		
	});

	$('body').on('click', '.cancel_btn', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');

		$.ajax({
			url: '<?= site_url('registrasi-periksa-pasien/cancel_btn') ?>',
			type: 'post',
			dataType: 'html',
			data: {id: id},
			beforeSend: function(){   
	          $('.cancel_btn').html('<i class="fa fa-spinner fa-spin default"></i> Proccesing...');
	        },
	        complete: function(){
	          $('.cancel_btn').html('<i class="fas fa-times"></i> Cancel');
	        },
			success : function(data)
			{
			  if(data=='oke')
	          {
	          	$('#myTable').DataTable().destroy();
	            tampildata();

	          	$('#Modal-add .close').click();
	          	toastr.success('Proses cancel berhasil dilakukan');
	          }
	          else
	          {
	          	toastr.error('Proses cancel gagal dilakukan');
	          }
			}
		});
		
	});

</script>

