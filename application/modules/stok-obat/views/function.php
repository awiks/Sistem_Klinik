<script type="text/javascript" charset="utf-8" async defer>
	
	tampildata();

    function tampildata()
  	{

      var kategori = $('.kategori').val();
      var urutan   = $('.urutan').val();

	    $("#myTable").DataTable({

	    	"processing": true,
	        "serverSide": false,
	  		"ajax" :{
	  			url : "<?= site_url('stok-obat/ajax') ?>",
	  			type: "POST",
	            dataType: "json",
	            data:{
	              kategori:kategori,
	              urutan:urutan
	            }
	  		},
	  		"columns" : [{ "data" : "nomor" }, 
	                      { "data" : "kode_barang" }, 
	                      { "data" : "nama_barang" }, 
	                      { "data" : "harga_jual" }, 
	                      { "data" : "jumlah_stok" }, 
                         { "data" : "nama_satuan" }, 
                         { "data" : "total_harga" }, 
	                      { "data" : "aksi" }],
	        //Set column definition initialisation properties
	        "columnDefs": [{ 
	          "targets": [0],
	          "orderable": false
	        }]

	    });

   }

$('body').on('change', '.kategori', function(event) {
    event.preventDefault();
		/* Act on the event */
    $('#myTable').DataTable().destroy();
    tampildata();
});

$('body').on('change', '.urutan', function(event) {
    event.preventDefault();
		/* Act on the event */
    $('#myTable').DataTable().destroy();
    tampildata();
});

// EDIT DATA
$('body').on('click', '.edit', function(event) {
  event.preventDefault();
  /* Act on the event */
    
    var id = $(this).attr('id');

    $.ajax({
      url: '<?= site_url('stok-obat/modal_edit') ?>',
      type: 'post',
      dataType: 'html',
      beforeSend: function(){   
       $(".load-edit").css('display','block');
      },
      complete: function(){
       $(".load-edit").css('display','none');
      },
      data: {id: id,},
      success : function(data){
        $('.modal-edit').html(data);
      }
    })
});

$('body').on('submit', '#perbarui', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('stok-obat/perbarui') ?>',
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

</script>