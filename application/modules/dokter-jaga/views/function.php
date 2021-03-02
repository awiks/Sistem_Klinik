<script type="text/javascript" charset="utf-8" async defer>

	$('.tanggal').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
    });

    function tampil_data()
    {
    	var tanggal = $('.tanggal').val();

    	$.ajax({
    		url: '<?= site_url('dokter-jaga/tampil_data') ?>',
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
	          $('#tampil_data').html(data);
	        }
    	})
    }

    tampil_data();

  $('body').on('change', '.tanggal', function(event) {
	    event.preventDefault();
	    /* Act on the event */
	    tampil_data();
	});

	$('body').on('click', '.add', function(event) {
      event.preventDefault();
      /* Act on the event */

      $.ajax({
        url: '<?= site_url('dokter-jaga/modal_add') ?>',
        type: 'post',
        dataType: 'html',
        beforeSend: function(){   
          $(".load-add").css('display','block');
        },
        complete: function(){
          $(".load-add").css('display','none');
        },
        success : function(data){
          $('.modal-add').html(data);
        }
      })
    });

    $('body').on('submit', '#simpan', function(event) {
    	event.preventDefault();
    	/* Act on the event */

    	$.ajax({  
	        url: '<?= site_url('dokter-jaga/simpan') ?>',
	        type: 'post',
	        dataType: 'html',
	        data: new FormData(this),
	        contentType: false,       
	        cache: false,             
	        processData:false,
	        beforeSend: function(){   
	         $('.btn_add').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
	        },
	        complete: function(){
	          $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
	        },
	        success : function(data)
	        {

	          if(data=='oke')
	          {
	          	tampil_data();
	          	$('#Modal-add .close').click();
	          	toastr.success('Data berhasil ditambahkan');
	          }
	          else if ( data == 'ada' ){
	          	toastr.warning('Data yang anda masukan sudah ada');
	          }
	          else
	          {
	          	toastr.error('Data gagal ditambahkan');
	          }
	        }
	    })
    });

  // MODAL HAPUS
  $('body').on('click', '.delete', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= base_url('dokter-jaga/delete') ?>',
      type: 'post',
      dataType: 'html',
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      data: {id:id,},
      success :function (data){
        $('.modal-del').html(data);
      }
    })
  });

  //HAPUS DATA
 $('body').on('click', '.hapus_data', function(event) {
   event.preventDefault();
   /* Act on the event */

    var id = $('.del').attr('id');
  
    $.ajax({
        url: '<?= base_url('dokter-jaga/hapus') ?>',
        type: 'post',
        dataType: 'html',
        beforeSend: function(){   
          $('.hapus_data').html('<i class="fa fa-spinner fa-spin default"></i> Deleting..');
        },
        complete: function(){
          $('.hapus_data').html('<i class="fa fa-trash"></i> Hapus');
        },
        data: {id:id,},
        success :function (data){
          if ( data == 'oke' ){
          	tampil_data();
          	$('#Modal-del .close').click();
          	toastr.success('Data berhasil dihapus');
          }
          else{
          	toastr.error('Data gagal dihapus');
          }
        }
    })

  });

    /* BAGIAN DETAIL */

	$('body').on('click', '.add-jadwal', function(event) {
      event.preventDefault();
      /* Act on the event */

      var  id_jadwal = $(this).data('id');
      var  nama_poli = $(this).data('poli');

      $.ajax({
        url: '<?= site_url('dokter-jaga/modal_add_jadwal') ?>',
        type: 'post',
        dataType: 'html',
        data: {id_jadwal: id_jadwal,nama_poli:nama_poli,},
        beforeSend: function(){   
          $(".load-add").css('display','block');
        },
        complete: function(){
          $(".load-add").css('display','none');
        },
        success : function(data){
          $('.modal-add').html(data);
        }
      })
    });

    $('body').on('submit', '#simpan_jadwal', function(event) {
    	event.preventDefault();
    	/* Act on the event */

    	$.ajax({  
	        url: '<?= base_url('dokter-jaga/simpan_add_jadwal') ?>',
	        type: 'post',
	        dataType: 'html',
	        data: new FormData(this),
	        contentType: false,       
	        cache: false,             
	        processData:false,
	        beforeSend: function(){   
	         $('.btn_add').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
	        },
	        complete: function(){
	          $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
	        },
	        success : function(data)
	        {
	          if(data=='oke')
	          {
	          	tampil_data();
	          	$('#Modal-add .close').click();
	          	toastr.success('Data berhasil ditambahkan');
	          }
	          else
	          {
	          	toastr.error('Data gagal ditambahkan');
	          }
	        }
	    })
    });

 /* MODAL EDIT DETAIL */
 $('body').on('click', '.edit_jadwal', function(event) {
 	event.preventDefault();
 	/* Act on the event */

 	var id = $(this).attr('id');
 	var nama_poli = $(this).data('poli');

 	$.ajax({
 		url: '<?= base_url('dokter-jaga/edit_jadwal') ?>',
 		type: 'post',
 		dataType: 'html',
 		data: {id:id,nama_poli:nama_poli,},
 		beforeSend: function(){   
         $(".load-edit").css('display','block');
        },
        complete: function(){
         $(".load-edit").css('display','none');
        },
        success :function (data){
         $('.modal-edit').html(data);
        }
 	})
 	
 });

$('body').on('submit', '#perbarui_jadwal', function(event) {
	event.preventDefault();
	/* Act on the event */

	$.ajax({  
        url: '<?= base_url('dokter-jaga/perbarui_edit_jadwal') ?>',
        type: 'post',
        dataType: 'html',
        data: new FormData(this),
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function(){   
         $('.btn_edit').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
        },
        complete: function(){
          $('.btn_edit').html('<i class="fa fa-check"></i> Perbarui');
        },
        success : function(data)
        {
          if(data=='oke')
          {
          	tampil_data();
          	$('#Modal-edit .close').click();
          	toastr.success('Data berhasil diperbarui');
          }
          else
          {
          	toastr.error('Data gagal diperbarui');
          }
        }
    })
});


  // MODAL HAPUS DETAIL
  $('body').on('click', '.delete_jadwal', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= base_url('dokter-jaga/delete_jadwal') ?>',
      type: 'post',
      dataType: 'html',
      data: {id:id,},
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      success :function (data){
        $('.modal-del').html(data);
      }
    })
  });

 //HAPUS DATA DETAIL
 $('body').on('click', '.hapus_data_jadwal', function(event) {
   event.preventDefault();
   /* Act on the event */

    var id = $('.del').attr('id');
  
    $.ajax({
        url: '<?= base_url('dokter-jaga/hapus_jadwal') ?>',
        type: 'post',
        dataType: 'html',
        data: {id:id,},
        beforeSend: function(){   
          $('.hapus_data_jadwal').html('<i class="fa fa-spinner fa-spin default"></i> Deleting..');
        },
        complete: function(){
          $('.hapus_data_jadwal').html('<i class="fa fa-trash"></i> Hapus');
        },
        success :function (data){
          if ( data == 'oke' ){
          	tampil_data();
          	$('#Modal-del .close').click();
          	toastr.success('Data berhasil dihapus');
          }
          else{
          	toastr.error('Data gagal dihapus');
          }
        }
    })

  });

</script>