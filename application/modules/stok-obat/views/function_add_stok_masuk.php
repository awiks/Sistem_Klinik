<script type="text/javascript" charset="utf-8" async defer>
	
	  $('.dt').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,
        orientation: 'auto bottom'
    });

    $('.select2').select2({
      placeholder: 'Ketik nama Supplier ...',
      allowClear: true,
      minimumInputLength: 0,
      minimumResultsForSearch: 20,
      ajax: {
        url: '<?= base_url('stok-obat/select_side_supplier') ?>',
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

    $('.select3').select2({
      placeholder: 'Ketik nama Obat ...',
      allowClear: true,
      minimumInputLength: 0,
      minimumResultsForSearch: 20,
      ajax: {
        url: '<?= base_url('stok-obat/select_side_obat') ?>',
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

  tampil_add_data();

  function tampil_add_data()
  {

      var id_supplier   = $('[name=id_supplier]').val();
      var tanggal_masuk = $('[name=tanggal_masuk]').val();

    $.ajax({
      url: '<?= base_url('stok-obat/ajax_add_data') ?>',
      type: 'post',
      dataType: 'json',
      data: {id_supplier: id_supplier,tanggal_masuk:tanggal_masuk,},
      beforeSend: function(){   
        $(".load").css('display','block');
      },
      complete: function(){
        $(".load").css('display','none');
      },
      success:function(data)
      {
        var data_null ='<tr><td colspan="5" class="text-center">Data masih kosong</td></tr>';
        var record = ''; 
        var no=0;
        $.each(data,function(i, item) {
          
            record += '<tr>'; 
            record += '<td>' + item.kode_barang + '</td>'; 
            record += '<td>' + item.nama_barang + '</td>'; 
            record += '<td>' + item.jumlah + '</td>'; 
            record += '<td>' + item.nama_satuan + '</td>';
            record += '<td class="text-center">' + item.aksi + '</td>';
            record += '</tr>'; 

            no++;
            
        });

        if ( no == 0 ){
          $('#record').html(data_null);
          $('.add-proses').prop('disabled', 'disabled');
        }
        else{
          $('#record').html(record);
          $('.add-proses').prop('disabled', '');
        }
      }
    })
    
  }

    $('body').on('click', '.add', function(event) {
    	event.preventDefault();
    	/* Act on the event */

    	var id_supplier   = $('[name=id_supplier]').val();
    	var tanggal_masuk = $('[name=tanggal_masuk]').val();
    	var id_barang     = $('[name=id_barang]').val();
    	var jumlah_masuk  = $('[name=jumlah_masuk]').val();

    	if ( id_supplier == null ){
    	  $('.supplier').addClass('has-error');
    	}
    	else if ( tanggal_masuk.length == '' ){
    	  $('[name=tanggal_masuk]').focus();
    	}
    	else if ( id_barang == null ){
    	  $('.barang').addClass('has-error');
    	}
    	else if ( jumlah_masuk.length == '' ){
    	  $('[name=jumlah_masuk]').focus();
    	}
    	else{

    		$.ajax({
    			url: '<?= base_url('stok-obat/add_data') ?>',
    			type: 'post',
    			dataType: 'html',
    			data: {id_supplier: id_supplier,tanggal_masuk:tanggal_masuk,
    				     id_barang:id_barang,jumlah_masuk:jumlah_masuk,},
          beforeSend: function(){   
           $('.add').html('<i class="fa fa-spinner fa-spin default"></i> Add');
          },
          complete: function(){
            $('.add').html('<i class="fa fa-cart-plus"></i> Add');
          },
  		    success:function(data)
  		    {
            if ( data =='oke' ){
             tampil_add_data();
             $('[name=jumlah_masuk]').val('');
             toastr.success('Data berhasil ditambahkan');
            }
            else{
              tampil_add_data();
              toastr.error('Data gagal ditambahkan');
            }
  		    }
    		})
    		
    	}
    });

    $('body').on('change', '[name=id_supplier]', function(event) {
       event.preventDefault();
        /* Act on the event */
        tampil_add_data();
    });

    $('body').on('change', '[name=tanggal_masuk]', function(event) {
       event.preventDefault();
        /* Act on the event */
        tampil_add_data();
    });

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
	  })

    $('body').on('submit', '#simpan', function(event) {
      event.preventDefault();
      /* Act on the event */

      $.ajax({
        url: '<?= base_url('stok-obat/simpan_add_data') ?>',
        type: 'post',
        dataType: 'html',
        data: new FormData(this),
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function(){   
         $('.add-proses').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
        },
        complete: function(){
          $('.add-proses').html('<i class="fa fa-check"></i> Proses');
        },
        success : function(data)
        {
          //window.history.back();
          location.reload();
        }
      })

    });

    // MODAL HAPUS 
  $('body').on('click', '.del', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');
    var data_barang = $(this).data('barang');

    $.ajax({
      url: '<?= base_url('stok-obat/delete') ?>',
      type: 'post',
      dataType: 'html',
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      data: {id:id,data_barang:data_barang,},
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
        url: '<?= base_url('stok-obat/hapus') ?>',
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
          if(data=='oke'){
             tampil_add_data();
             $('#Modal-del .close').click();
             toastr.success('Data berhasil dihapus');
          }
          else{
            toastr.error('Data gagal dihapus');
          }
        }
    })

  });

  // EDIT DATA
  $('body').on('click', '.edit', function(event) {
    event.preventDefault();
    /* Act on the event */
      
      var id = $(this).attr('id');
      var qty = $(this).data('qty');

      $.ajax({
        url: '<?= site_url('stok-obat/modal_edit_add') ?>',
        type: 'post',
        dataType: 'html',
        beforeSend: function(){   
         $(".load-edit").css('display','block');
        },
        complete: function(){
         $(".load-edit").css('display','none');
        },
        data: {id: id,qty:qty,},
        success : function(data){
          $('.modal-edit').html(data);
        }
      })

  });

  $('body').on('submit', '#perbarui', function(event) {
      event.preventDefault();
      /* Act on the event */

      $.ajax({
        url: '<?= site_url('stok-obat/perbarui_add') ?>',
        type: 'post',
        dataType: 'html',
        data: new FormData(this),
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function(){   
         $('#btn-edit').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
        },
        complete: function(){
          $('#btn-edit').html('<i class="fa fa-check"></i> Perbarui');
        },
        success : function(data)
        {
          if ( data == 'oke' ){

            $('#Modal-edit .close').click();
            toastr.success('Data berhasil diperbarui');
            tampil_add_data();
            
          }
          else{
            toastr.error('Data gagal diperbarui');
          }
        }
      })
      
    });

</script>