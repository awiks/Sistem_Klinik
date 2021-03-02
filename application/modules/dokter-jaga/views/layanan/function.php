<script type="text/javascript" charset="utf-8" async defer>

	  tampildata();

    function tampildata()
    {
      var urutan   = $('.urutan').val();

      $("#myTable").DataTable({

        "processing": true,
        "serverSide": false,
        "ajax" :{
          url : "<?= site_url('dokter-jaga/ajax_layanan') ?>",
          type: "POST",
              dataType: "json",
              data:{
                urutan:urutan
              }
        },
        "columns" : [{ "data" : "nomor" }, 
                        { "data" : "nama_poliklinik" }, 
                        { "data" : "deskripsi_layanan" }, 
                        { "data" : "harga_layanan" }, 
                        { "data" : "create_date" }, 
                        { "data" : "aksi" }],
          //Set column definition initialisation properties
          "columnDefs": [{ 
            "targets": [0],
            "orderable": false
          }]
      });
   }

  $('body').on('change', '.urutan', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('#myTable').DataTable().destroy();
    tampildata();
  });

  $('body').on('click', '.add', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('dokter-jaga/modal_add_layanan') ?>',
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
    });
  });

  $('body').on('submit', '#simpan', function(event) {
      event.preventDefault();
      /* Act on the event */

      $.ajax({
        url: '<?= site_url('dokter-jaga/simpan_layanan') ?>',
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
            $('#myTable').DataTable().destroy();
            tampildata();

            $('#Modal-add .close').click();
            toastr.success('Data berhasil disimpan');
          }
          else
          {
            toastr.error('Data gagal disimpan');
          }
        }
      })
  });

  // EDIT DATA
  $('body').on('click', '.edit', function(event) {
    event.preventDefault();
    /* Act on the event */
      
      var id = $(this).attr('id');

      $.ajax({
        url: '<?= site_url('dokter-jaga/modal_edit_layanan') ?>',
        type: 'post',
        dataType: 'html',
        beforeSend: function(){   
         $(".load-edit").css('display','block');
        },
        complete: function(){
         $(".load-edit").css('display','none');
        },
        data: {id: id},
        success : function(data){
          $('.modal-edit').html(data);
        }
      });
  });

  $('body').on('submit', '#perbarui', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('dokter-jaga/perbarui_layanan') ?>',
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
          $('#myTable').DataTable().destroy();
          tampildata();

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

  // MODAL HAPUS 
  $('body').on('click', '.delete', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= base_url('dokter-jaga/delete_layanan') ?>',
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
        url: '<?= base_url('dokter-jaga/hapus_layanan') ?>',
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
          if(data=='oke')
          {
            $('#myTable').DataTable().destroy();
            tampildata();

            $('#Modal-del .close').click();
            toastr.success('Data berhasil dihapus');
          }
          else
          {
            toastr.error('Data gagal dihapus');
          }
        }
    })

  });

</script>