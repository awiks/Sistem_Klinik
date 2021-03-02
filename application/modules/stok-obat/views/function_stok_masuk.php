<script type="text/javascript" charset="utf-8" async defer>

	  tampildata();

    function tampildata()
    {

      var bulan   = $('.bulan').val();
      var tahun   = $('.tahun').val();

      $("#myTable").DataTable({

        "processing": true,
          "serverSide": false,
        "ajax" :{
          url : "<?= site_url('stok-obat/ajax-stok-masuk') ?>",
          type: "POST",
              dataType: "json",
              data:{
                bulan:bulan,
                tahun:tahun
              }
        },
        "columns" : [{ "data" : "nomor" }, 
                        { "data" : "no_transaksi" }, 
                        { "data" : "nama_supplier" }, 
                        { "data" : "tanggal_masuk" }, 
                        { "data" : "total_data" }, 
                        { "data" : "create_date" }, 
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