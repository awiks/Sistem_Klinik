<script type="text/javascript" charset="utf-8" async defer>

  /*KEYPRESS INPUT ONLY NUMBER*/
  $('body').on('keypress', '.number', function(event) {
     //this.value = this.value.replace(/[^0-9\.]/g,'');  Event hanya angka yang bisa diketik
      $(this).val($(this).val().replace(/^(\d*)(\.\d*)?$/g,''));
        
      if ((event.which != 46 || $(this).val().indexOf('Firefox') != -1) && (event.which < 48 || event.which > 57)) {
         event.preventDefault();
      }
      else if ((event.which != 46 || $(this).val().indexOf('Chrome') != -1) && (event.which < 48 || event.which > 57)) {
         event.preventDefault();
      }
  });

  $('body').on('click', '.add_disc', function(event) {
    event.preventDefault();
    /* Act on the event */
    var id = $(this).data('id');
    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/modal_discount') ?>',
      type: 'post',
      dataType: 'html',
      data: {id: id},
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      success:function(data)
      {
        $('.modal-del').html(data);
        $('.modal-title').html('<i class="fas fa-cogs"></i> Pengaturan');
      }
    });
  });

  $('body').on('submit', '#perbarui_discount', function(event) {
    event.preventDefault();
    /* Act on the event */

    var discount = $('[name="discount"]').val();
    var ppn      = $('[name="ppn"]').val();

    $.ajax({
        url: '<?= site_url('transaksi-periksa-pasien/perbarui_discount') ?>',
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
            $('#Modal-del .close').click();
            toastr.success('Data berhasil diperbarui');

            /*TAMPIL DATA DISKON PPN */
            tampil_discount_ppn();

            /* TAMPIL DISKON */
            total_diskon(discount);

            /* TAMPIL PPN */
            total_ppn(ppn);

            /*TAMPIL YANG HARUS DIBAYAR */
            total_yg_hrus_dbyar();

            /* REFRESH JUMLAH BAYAR*/
            jumlah_bayar();
          }
          else
          {
            toastr.error('Data gagal diperbarui');
          }
        }
    })
  });

  function tampil_discount_ppn()
  {
    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/tampil_discount_ppn') ?>',
      dataType: 'json',
      success:function(data)
      {
        $('.disc').val(data.discount);
        $('.ppn').val(data.ppn);
      }
    })
  }

  /*TAMPIL DATA DISKON PPN */
  tampil_discount_ppn();

  //$('[data-tooltip="tooltip"]').tooltip();
	
  $('.dt').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      autoclose: true,
      orientation: 'auto bottom'
  });

  /* No Ref./ Reg */
  function selected_registrasi()
  {
    var dt = $('.dt').val();

    $('.no_reg').select2({
        placeholder: 'Ketik No Reg / Nama Pasien ...',
        allowClear: true,
        minimumInputLength: 0,
        minimumResultsForSearch: 20,
        ajax: {
          url: '<?= site_url('transaksi-periksa-pasien/select_regristrasi') ?>',
          type: 'get',
          dataType: 'json',
          data:{
            dt:dt,
          },
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
        cache: true
      }
    });
  }

  selected_registrasi();

  $('body').on('change', '.dt', function(event) {
    event.preventDefault();
    /* Act on the event */

    $('.no_reg').val(''); 
    $('.no_rm').val(''); 
    $('.nm_pas').val(''); 
    $('.poliklinik').val(''); 

    $('.jml_byr').val('');
    $('.sisa_byr').val('');

    /* No Ref./ Reg */
    selected_registrasi();

    /* Jenis Layanan */
    var poliklinik = 0;
    select_layanan(poliklinik);

    /* MENAMPILKAN DATA OBAT */
    tampil_data_obat();

    /*TAMPIL BIAYA OBAT */
    biaya_obat();

    /*TAMPIL DATA DISKON PPN */
    tampil_discount_ppn();
  });
  
  $('body').on('change', '.no_reg', function(event) {
    event.preventDefault();
    /* Act on the event */
    var no_reg = $('.no_reg').val();

    $('.jml_byr').val('');
    $('.sisa_byr').val('');

    if ( no_reg == null ){
      $('.no_rm').val(''); 
      $('.nm_pas').val(''); 
      $('.poliklinik').val(''); 

      /* Jenis Layanan */
      var poliklinik = 0;
      select_layanan(poliklinik);

      /*TAMPIL DATA DISKON PPN */
      tampil_discount_ppn();
    }
    else{
        $.ajax({
          url: '<?= site_url('transaksi-periksa-pasien/select_no_reg') ?>',
          type: 'post',
          dataType: 'json',
          data: {no_reg: no_reg},
          success : function(data)
          {
             $('.no_rm').val(data.no_rekam_medik);
             $('.nm_pas').val(data.nama_pasien);
             $('.poliklinik').val(data.nama_poliklinik);

             /* Jenis Layanan */
             var id_layanan = data.id_poliklinik;
             select_layanan(id_layanan);

             /*SAAT ONCHANGE NO REG MENAMPILKAN VALUE NOL*/
             $('.by_lyan').val('0');

             /* MENAMPILKAN DATA OBAT */
             tampil_data_obat();

             /*TAMPIL BIAYA OBAT */
             biaya_obat();

             /*TAMPIL DATA DISKON PPN */
             tampil_discount_ppn();

          }
        });
    }
  });

  /* Jenis Layanan */
  function select_layanan(poliklinik)
  {
    $.ajax({
       url: '<?= site_url('transaksi-periksa-pasien/select_layanan') ?>',
       type: 'post',
       dataType: 'json',
       data: {poliklinik:poliklinik,},
       success : function(data)
       {
          var record = ''; 
          $.each(data,function(i, item) {
            record += '<option value="'+item.id_layanan+'">'+item.deskripsi_layanan+'</option>'; 
          })

          $('.layanan').html('<option value="">-- Pilih Layanan --</option>'+record);
       }
     });
  }

  $('body').on('change', '.layanan', function(event) {
    event.preventDefault();
    /* Act on the event */
    var layanan  = $('.layanan').val();
    var discount = $('.disc').val();
    var ppn      = $('.ppn').val();

    $('.jml_byr').val('');
    $('.sisa_byr').val('');

    if ( layanan == '' ){

      $('.by_lyan').val('0');
      
      /* TAMPIL SUBTOTAL*/
      sub_total();

      /* TAMPIL DISKON */
      total_diskon(discount);

      /* TAMPIL PPN */
      total_ppn(ppn);

      /*TAMPIL YANG HARUS DIBAYAR */
      total_yg_hrus_dbyar();

    }
    else{
      $.ajax({
        url: '<?= site_url('transaksi-periksa-pasien/select_jenis_layanan') ?>',
        type: 'post',
        dataType: 'json',
        data: {layanan: layanan,},
        success:function(data)
        {

          $('.by_lyan').val(data.harga_layanan);
          
          /* TAMPIL SUBTOTAL*/
          sub_total();

          /* TAMPIL DISKON */
          total_diskon(discount);

          /* TAMPIL PPN */
          total_ppn(ppn);

          /*TAMPIL YANG HARUS DIBAYAR */
          total_yg_hrus_dbyar();


        }
      });
    }
  });

  $('.select_obat').select2({
      placeholder: 'Ketik Kode Obat / Nama Obat ...',
      allowClear: true,
      minimumInputLength: 0,
      minimumResultsForSearch: 20,
      ajax: {
        url: '<?= site_url('transaksi-periksa-pasien/select_side_obat') ?>',
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

  $('body').on('change', '.select_obat', function(event) {
    	event.preventDefault();
    	/* Act on the event */

    	var id = $('.select_obat').val();
      var no_reg = $('.no_reg').val();

    	if ( id == null ){
    		$('.qty').prop('disabled', true);
  			$('.btn_qty').prop('disabled', true);
  			$('.stock').val('');
  			$('.qty').val('');
    	}
    	else{

        if ( no_reg == null ){
          $('.qty').prop('disabled', true);
          $('.btn_qty').prop('disabled', true);
          $('.stock').val('');
          $('.qty').val('');
          toastr.info('Harap mencari daftar pasien terlebih dahulu');
        }
        else{
          $.ajax({
            url: '<?= site_url('transaksi-periksa-pasien/select_obat') ?>',
            type: 'post',
            dataType: 'json',
            data: {id:id},
            success:function(data)
            {
              $('.stock').val(data.jumlah_stok);
              $('.qty').prop('disabled', false);
              $('.btn_qty').prop('disabled', false);
              $('.qty').focus();
            }
          });
        }
    	}
  });

  $('body').on('keyup', '.qty', function(event) {
  	event.preventDefault();
  	/* Act on the event */
  	var stock   = $('.stock').val();
  	var qty     = $('.qty').val();
        i_stock = parseInt(stock);
        i_qty   = parseInt(qty);
  	    sisa    = i_stock - i_qty;
        i_sisa  = isNaN(sisa) ? 0 : sisa;

  	if ( i_qty > i_stock ){
  		toastr.warning('Jumlah Qty melebihi Sisa Stock');
  		$('.btn_qty').prop('disabled', true);
  	}
    else if ( i_sisa == 0 ){
      $('.btn_qty').prop('disabled', false);
    }
  	else{
      $('.btn_qty').prop('disabled', false);
  		toastr.info('Sisa Stock tinggal '+i_sisa);
  	}
  });

  /* FUNCTION DATA OBAT */
  function tampil_data_obat()
  {
    var no_reg = $('.no_reg').val();

    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/tampil_data_obat') ?>',
      type: 'post',
      dataType: 'json',
      data: {no_reg: no_reg},
      beforeSend: function(){   
        $(".load").css('display','block');
      },
      complete: function(){
        $(".load").css('display','none');
      },
      success : function(data)
      {
        var data_null ='<tr><td colspan="7" class="text-center">Data masih kosong</td></tr>';
        var record = ''; 
        var no=0;
        $.each(data,function(i, item) {
          
            record += '<tr>'; 
            record += '<td>' + item.nomor + '</td>'; 
            record += '<td>' + item.kode_barang + '</td>'; 
            record += '<td>' + item.nama_barang + '</td>'; 
            record += '<td>' + item.nama_satuan + '</td>'; 
            record += '<td>' + item.jumlah_obat + '</td>';
            record += '<td>' + item.subtotal + '</td>';
            record += '<td class="text-center">' + item.aksi + '</td>';
            record += '</tr>'; 
            no++;
        });

        if ( no == 0 ){
          $('#record').html(data_null);
        }
        else{
          $('#record').html(record);
        }
      }
    });
  }

  /* FUNCTION DATA OBAT */
  tampil_data_obat();

  $('body').on('click', '.btn_qty', function(event) {
    event.preventDefault();
    /* Act on the event */
    
    var no_reg    = $('.no_reg').val();
    var id_barang = $('.select_obat').val();
    var qty       = $('.qty').val();
    var stock     = $('.stock').val();

    if ( qty == '' ){
      $('.qty').focus();
    }
    else{

      $.ajax({
        url: '<?= site_url('transaksi-periksa-pasien/simpan_temp_obat') ?>',
        type: 'post',
        dataType: 'html',
        data: {no_reg: no_reg,id_barang:id_barang,stock:stock,qty:qty,},
        beforeSend: function(){   
          $(".btn_qty").html('<i class="fa fa-spinner fa-spin default"></i> Add');
        },
        complete: function(){
          $(".btn_qty").html('<i class="fa fa-plus-circle"></i> Add');
        },
        success : function(data)
        {
          if ( data =='oke' ){
            /* FUNCTION DATA OBAT */
            tampil_data_obat();
           
            /*TAMPIL BIAYA OBAT */
            biaya_obat();

            $('.jml_byr').val('');
            $('.sisa_byr').val('');

            toastr.success('Data obat berhasil ditambahkan');
          }
          else if ( data == 'stok_min' )
          {
            toastr.warning('Maaf Stok obat tidak mencukupi');
          }
          else{
            toastr.danger('Data obat gagal ditambahkan');
          }
        }
      });
    }
  });

  $('body').on('click', '.del', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/modal_del') ?>',
      type: 'post',
      dataType: 'html',
      data: {id: id},
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      success:function(data)
      {
        $('.modal-del').html(data);
        $('.modal-title').html('Konfirmasi');
      }
    });
  });

  //HAPUS DATA 
 $('body').on('click', '.hapus_data', function(event) {
   event.preventDefault();
   /* Act on the event */

    var id = $('.del').attr('id');
  
    $.ajax({
        url: '<?= base_url('transaksi-periksa-pasien/hapus') ?>',
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
            $('#Modal-del .close').click();
            toastr.success('Data berhasil dihapus');
            
            /* FUNCTION DATA OBAT */
            tampil_data_obat();

            /*TAMPIL BIAYA OBAT */
            biaya_obat();
          }
          else
          {
            toastr.error('Data gagal dihapus');
          }
        }
    })
  });

  $('body').on('click', '.edit', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');
    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/modal_edit') ?>',
      type: 'post',
      dataType: 'html',
      data: {id: id},
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      success:function(data)
      {
        $('.modal-del').html(data);
        $('.modal-title').html('Perbarui Data');
      }
    });
  });

  $('body').on('submit', '#perbarui', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/perbarui') ?>',
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
          $('#Modal-del .close').click();
          toastr.success('Data berhasil diperbarui');

          /* FUNCTION DATA OBAT */
          tampil_data_obat();

          /*TAMPIL BIAYA OBAT */
          biaya_obat();

          $('.jml_byr').val('');
          $('.sisa_byr').val('');
        }
        else if ( data == 'stok_min' )
        {
          toastr.warning('Maaf Stok obat tidak mencukupi');
        }
        else
        {
          toastr.error('Data gagal diperbarui');
        }
      }
    })
  });

  /*FUNCTION BIAYA OBAT */
  function biaya_obat()
  {
    var no_reg = $('.no_reg').val();
    var discount = $('.disc').val();
    var ppn      = $('.ppn').val();

    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/biaya_obat') ?>',
      type: 'post',
      dataType: 'json',
      data: {no_reg:no_reg,},
      success : function(data)
      {
        $('.by_obat').val(data.by_obat);
        
        /* TAMPIL SUBTOTAL*/
        sub_total();

        /* TAMPIL DISKON */
        total_diskon(discount);

        /* TAMPIL PPN */
        total_ppn(ppn);

        /*TAMPIL YANG HARUS DIBAYAR */
        total_yg_hrus_dbyar();
      }
    });
  }

  /* FUNCTION SUBTOTAL */
  function sub_total()
  {
    var sub_total = 0;
    var by_lyan = $('.by_lyan').val();
    var by_obat = $('.by_obat').val();
        i_by_lyan = by_lyan.replace(",","").replace(",","");
        i_by_obat = by_obat.replace(",","").replace(",","");

        int_by_lyan = parseInt(i_by_lyan);
        int_by_obat = parseInt(i_by_obat);

        n_by_lyan = isNaN(int_by_lyan) ? 0 : int_by_lyan;
        n_by_obat = isNaN(int_by_obat) ? 0 : int_by_obat;

    sub_total = n_by_lyan + n_by_obat;

    format_number = sub_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

    $('.sub_total').val(format_number);
  }

  /* FUNCTION DISKON */
  function total_diskon(discount)
  {
     var total_diskon =0;
     var disc      = discount;
     var sub_total = $('.sub_total').val();
         i_sub_total = sub_total.replace(",","").replace(",","");

         int_disc = parseInt(disc);
         int_sub_total = parseInt(i_sub_total);

         n_disc      = isNaN(int_disc) ? 0 : int_disc;
         n_sub_total = isNaN(int_sub_total) ? 0 : int_sub_total;

     total_diskon = ( n_disc / 100 ) * n_sub_total;

     format_number = total_diskon.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

     $('.by_disc').val(format_number);
  }

  /* FUNCTION PPN */
  function total_ppn(ppn)
  {
     var total_ppn =0;
     var by_ppn    = ppn;
     var sub_total = $('.sub_total').val();
     var by_disc   = $('.by_disc').val();
         i_sub_total = sub_total.replace(",","").replace(",","");
         i_by_disc   = by_disc.replace(",","").replace(",","");

         int_sub_total = parseInt(i_sub_total);
         int_disc      = parseInt(i_by_disc);
         int_by_ppn    = parseInt(by_ppn);

         n_sub_total = isNaN(int_sub_total) ? 0 : int_sub_total;
         n_disc      = isNaN(int_disc) ? 0 : int_disc;
         n_by_ppn    = isNaN(int_by_ppn) ? 0 : int_by_ppn;

      total_ppn = ( n_by_ppn / 100 ) * ( n_sub_total - n_disc );

      format_number = total_ppn.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

      $('.by_ppn').val(format_number);
  }

  /* FUNCTION YANG HARUS DIBAYAR */
  function total_yg_hrus_dbyar()
  {
     var total_bayar = 0;
     var sub_total = $('.sub_total').val();
     var by_disc   = $('.by_disc').val();
     var by_ppn    = $('.by_ppn').val();
     
     i_sub_total   = sub_total.replace(",","").replace(",","");
     i_by_disc     = by_disc.replace(",","").replace(",","");
     i_by_ppn      = by_ppn.replace(",","").replace(",","");

     int_sub_total = parseInt(i_sub_total);
     int_by_disc   = parseInt(i_by_disc);
     int_by_ppn    = parseInt(i_by_ppn);

     n_sub_total = isNaN(int_sub_total) ? 0 : int_sub_total;
     n_by_disc   = isNaN(int_by_disc) ? 0 : int_by_disc;
     n_by_ppn    = isNaN(int_by_ppn) ? 0 : int_by_ppn;

     total_bayar = ( n_sub_total - n_by_disc ) + n_by_ppn;
     format_number = total_bayar.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

     $('.yg_hrus_dbyr').val(format_number);
  }

  /* MENAMPILKAN METODE PEMBAYARAN */
  $('body').on('change', '.metode', function(event) {
    event.preventDefault();
    /* Act on the event */
    var metode = $('.metode').val();

    if ( metode == '' ){
      $('#input_metode').css('display', 'none');
      $('.atas_nama').val('');
      $('.jml_byr').prop('disabled', true);
    }
    else{

      $.ajax({
        url: '<?= site_url('transaksi-periksa-pasien/select_metode') ?>',
        type: 'post',
        dataType: 'json',
        data: {metode: metode},
        success:function(data)
        {
          if ( data.status_form == '1' ){
            $('#input_metode').css('display', 'block');
            $('.jml_byr').prop('disabled', false);
            $('.title_label').text(data.title_label);
          }
          else{
            $('#input_metode').css('display', 'none');
            $('.title_label').text('');
            $('.jml_byr').prop('disabled', false);
          }
        }
      });
    } 
  });

  $('.jml_byr').maskNumber({integer: true});

  function jumlah_bayar()
  {
    total_sisa = 0;
    var yg_hrus_dbyr = $('.yg_hrus_dbyr').val();
    var jml_byr      = $('.jml_byr').val();

    i_yg_hrus_dbyr   = yg_hrus_dbyr.replace(",","").replace(",","");
    i_jml_byr        = jml_byr.replace(",","").replace(",","");

    int_yg_hrus_dbyr = parseInt(i_yg_hrus_dbyr);
    int_jml_byr      = parseInt(i_jml_byr);

    n_yg_hrus_dbyr = isNaN(int_yg_hrus_dbyr) ? 0 : int_yg_hrus_dbyr;
    n_jml_byr      = isNaN(int_jml_byr) ? 0 : int_jml_byr;

    total_sisa = n_jml_byr - n_yg_hrus_dbyr;

    format_number = total_sisa.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

    $('.sisa_byr').val(format_number);

    if ( jml_byr == ''){
      $('.sisa_byr').val('');
    }

    if ( n_jml_byr < n_yg_hrus_dbyr ){
      toastr.options = {
        "positionClass": "toast-bottom-left",
        "timeOut": "600",
      }
      toastr.info('Uang pembayaran kurang');
      $('.btn_proses').prop('disabled', true);
    }
    else{
      $('.btn_proses').prop('disabled', false);
    }
  }

  $('body').on('keyup', '.jml_byr', function(event) {
    event.preventDefault();
    /* Act on the event */
      jumlah_bayar();
  });
  
  toastr.options = {
    "positionClass": "toast-bottom-left",
  }

  $('body').on('click', '.btn_proses', function(event) {
    event.preventDefault();
    /* Act on the event */

    var no_trans = $('.no_trans').val();
    var no_reg   = $('.no_reg').val();
    var poliklinik   = $('.poliklinik').val();
    var layanan   = $('.layanan').val();
    var dt        = $('.dt').val();
    
    var by_lyan   = $('.by_lyan').val();
    var by_obat   = $('.by_obat').val();
    var sub_total = $('.sub_total').val();
    var by_disc   = $('.by_disc').val();
    var by_ppn    = $('.by_ppn').val();
    var yg_hrus_dbyr = $('.yg_hrus_dbyr').val();
    var metode   = $('.metode').val();
    var atas_nama   = $('.atas_nama').val();
    var kasir       = $('.kasir').val();

    var discount = $('.disc').val();
    var ppn      = $('.ppn').val();

    $.ajax({
      url: '<?= site_url('transaksi-periksa-pasien/simpan_trans') ?>',
      type: 'post',
      dataType: 'html',
      data: {no_trans: no_trans,no_reg:no_reg,
             poliklinik:poliklinik,layanan:layanan,dt:dt,
             by_lyan:by_lyan,by_obat:by_obat,sub_total:sub_total,
             by_disc:by_disc,by_ppn:by_ppn,yg_hrus_dbyr:yg_hrus_dbyr,
             metode:metode,atas_nama:atas_nama,kasir:kasir,},
      beforeSend: function(){   
        $('.btn_proses').html('<i class="fa fa-spinner fa-spin default"></i> Proses transaksi');
      },
      complete: function(){
        $('.btn_proses').html('<i class="fas fa-plus-circle"></i> Proses transaksi');
      },
      success : function(data)
      {
        if ( data == 'oke' ){

          location.reload();
          
          
          window.open('<?= site_url('transaksi-periksa-pasien/cetak/') ?>'+no_trans+'','_blank', 'width=800, height=500' );
        
        }
        else{

          toastr.error('Data gagal disimpan');
        }
      }

    });

  });
</script>