<script type="text/javascript" charset="utf-8" async defer>

	  tampildata();

    function tampildata()
    {

      var urutan   = $('.urutan').val();

      $("#myTable").DataTable({

        "processing": true,
        "serverSide": false,
        "order": [
                [0, urutan]
            ],
        "ajax" :{
          url : "<?= site_url('daftar-pasien/ajax') ?>",
          type: "POST",
              dataType: "json"
        },
        "columns" : [ 
                      { "data" : "no_rekam_medik" }, 
                      { "data" : "nama_pasien" }, 
                      { "data" : "jenis_kelamin" }, 
                      { "data" : "tanggal_lahir" }, 
                      { "data" : "umur" }, 
                      { "data" : "no_telepon" }, 
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

  $('body').on('click', '.cetak', function(event) {
    event.preventDefault();
    /* Act on the event */
    var id = $(this).attr('id');
    window.open('<?= site_url('daftar-pasien/cetak') ?>/'+id+'','_blank', 'width=800, height=500' );
  });

  $('body').on('click', '.add_baru', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('daftar-pasien/add') ?>',
      type: 'post',
      dataType: 'html',
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

  $('body').on('submit', '#simpan_add', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('daftar-pasien/simpan') ?>',
      type: 'post',
      dataType: 'html',
      data: new FormData(this),
      contentType: false,       
      cache: false,             
      processData:false,
      beforeSend: function(){   
        $('#btn_add_baru').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
      },
      complete: function(){
        $('#btn_add_baru').html('<i class="fa fa-check"></i> Simpan');
      },
      success : function(data)
      {
        if(data=='oke')
        {

          $('#myTable').DataTable().destroy();
          tampildata();

          $('#Modal-lg .close').click();
          toastr.success('Data berhasil ditambahkan<br>Harap untuk mencetak kartu Pasien');
        }
        else
        {
          toastr.error('Data gagal ditambahkan');
        }
      }
    })
  });

  $('body').on('click', '.detail', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= site_url('daftar-pasien/detail') ?>',
      type: 'post',
      dataType: 'html',
      data: {id:id,},
      beforeSend: function(){   
       $(".load-lg").css('display','block');
      },
      complete: function(){
       $(".load-lg").css('display','none');
      },
      success : function(data){
        $('.modal-add-lg').html(data);
      }
    })
  
  });

  $('body').on('submit', '#perbarui', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('daftar-pasien/perbarui') ?>',
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

          $('#Modal-lg .close').click();
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