<script type="text/javascript" charset="utf-8" async defer>

	
  $('.dt').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
  });
  

  tampildata();

    function tampildata()
    {

      var bulan   = $('.bulan').val();
      var tahun   = $('.tahun').val();

      $("#myTable").DataTable({

        "processing": true,
          "serverSide": false,
        "ajax" :{
          url : "<?= site_url('transaksi-periksa-pasien/ajax') ?>",
          type: "POST",
              dataType: "json",
              data:{
                bulan:bulan,
                tahun:tahun
              }
        },
        "columns" : [{ "data" : "no_transaksi" }, 
                     { "data" : "pasien" }, 
                     { "data" : "nama_dokter" }, 
                     { "data" : "biaya_layanan" }, 
                     { "data" : "biaya_obat" }, 
                     { "data" : "sub_total" }, 
                     { "data" : "aksi" }],
          //Set column definition initialisation properties
          "columnDefs": [{ 
            "targets": [0],
            "orderable": false
          }]

      });

   }

  $('body').on('change', '.bulan', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('#myTable').DataTable().destroy();
    tampildata();
  });

  $('body').on('change', '.tahun', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('#myTable').DataTable().destroy();
    tampildata();
  });

</script>

