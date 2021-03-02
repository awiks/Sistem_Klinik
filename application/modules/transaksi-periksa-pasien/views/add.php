<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <div class="content-header pt-2 pb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title_content ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
    <section class="content">

    <div class="container-fluid">

      <div class="card">
          
          <div class="card-body">
            
            <div class="row">
              <div class="col-md-8">
                  
                  <div class="row">
                     <div class="col-md-6">

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">
                          No Trans</label>
                          <div class="col-sm-9">
                            <input type="text"
                                   value="<?= $no_transaksi ?>" 
                                   class="form-control no_trans" 
                                   disabled>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">
                           No Ref./ Reg</label>
                          <div class="col-sm-9">
                            <select class="form-control no_reg" style="width:100%">
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">
                           No RM</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                   class="form-control no_rm" 
                                   disabled>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">
                           Nm Pasien</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                   class="form-control nm_pas" 
                                   disabled>
                          </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                       
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">
                           Tanggal</label>
                          <div class="col-sm-8">
                            <input type="text"
                                   value="<?= date('d-m-Y') ?>" 
                                   class="form-control dt">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">
                           Kasir</label>
                          <div class="col-sm-8">
                            <input type="text" 
                                   class="form-control kasir" 
                                   value="Admin" disabled>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">
                           Poliklinik</label>
                          <div class="col-sm-8">
                            <input type="text" 
                                   class="form-control poliklinik" 
                                   disabled>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">
                           Jenis Layanan</label>
                          <div class="col-sm-8">
                            <select class="form-control layanan">
                              <option value="">-- Pilih Layanan --</option>
                            </select>
                          </div>
                        </div>

                     </div>
                  </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kode Obat / Nama Obat</label>
                      <select class="form-control select_obat" style="width: 100%">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Sisa Stock</label>
                      <input type="text" 
                             class="form-control stock"
                             style="text-align: center;" 
                             disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group number">
                      <label>Qty </label>
                       <a href="#Modal-del"
                          title="Pengaturan discount dan PPN"
                          data-id="1"
                          data-toggle="modal" 
                          class="float-right add_disc">
                          <i class="fas fa-cogs"></i>
                        </a>
                        <div class="input-group">
                          <input type="text"
                                 style="text-align: center;" 
                                 class="form-control qty" disabled>
                          <span class="input-group-append">
                            <button type="button" 
                                    class="btn bg-olive btn_qty" disabled>
                               <i class="fas fa-plus-circle"></i> Add
                            </button>
                          </span>
                        </div>
                    </div>
                  </div>
                  
                </div>

                <div class="text-center load" 
                   style="display:block;
                          position:absolute;
                          z-index: 9999999;
                          margin-left:40%;
                          top:70%;
                          background-color:#fff;
                          padding:10px;
                          min-width: 150px;
                          border: 0 solid rgba(0,0,0,.125);
                          box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
                          border-radius:10px;">
                    <i class="fa fa-spinner fa-spin default"></i> Memuat...
                </div>

                <table class="table table-striped table-bordered" width="100%">
                  <thead class="bg-olive">
                    <tr>
                      <th class="p-2" width="3%">#</th>
                      <th class="p-2">Kode</th>
                      <th class="p-2">Nama Obat</th>
                      <th class="p-2">Satuan</th>
                      <th class="p-2">Qty.Jual</th>
                      <th class="p-2">Sub Total</th>
                      <th class="p-2" width="8%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="record"></tbody>
                </table>

              </div>
              <div class="col-md-4">

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                   Biaya Layanan</label>
                  <div class="col-sm-7">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold by_lyan"
                           disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                  Biaya Obat  </label>
                  <div class="col-sm-7">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold by_obat"
                           disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                  Subtotal </label>
                  <div class="col-sm-7">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold sub_total"
                           disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Disc % </label>
                  <div class="col-sm-3">
                    <input type="text"
                           class="form-control text-bold disc" 
                           disabled>
                  </div>
                  <div class="col-sm-7">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold by_disc"
                           disabled>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">PPN %</label>
                  <div class="col-sm-3">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold ppn" 
                           disabled>
                  </div>
                  <div class="col-sm-7">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold by_ppn" 
                           disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                  Yang harus dibayar </label>
                  <div class="col-sm-7">
                    <input type="text"
                           value="0" 
                           class="form-control text-bold yg_hrus_dbyr"
                           disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                  Metode Pembayaran</label>
                  <div class="col-sm-7">
                    <select class="form-control metode">
                      <option value="">-- Pilih metode bayar -- </option>
                      <?php 
                        foreach ( $metode as $rows ) {
                           echo '<option value="'.$rows->id_metode.'">
                                     '.$rows->deskripsi.'
                                 </option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div id="input_metode" style="display: none">
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label title_label">
                  </label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control atas_nama">
                  </div>
                </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                  Jumlah bayar </label>
                  <div class="col-sm-7">
                    <input type="text" 
                           class="form-control text-bold jml_byr"
                           disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">
                  Sisa kembali </label>
                  <div class="col-sm-7">
                    <input type="text"
                           class="form-control text-bold sisa_byr" 
                           disabled>
                  </div>
                </div>
                
              </div>
            </div>

          </div>
          <div class="card-footer">
            
            <a href="<?= site_url('transaksi-periksa-pasien') ?>" 
               class="btn btn-danger">
              <i class="fas fa-history"></i>
              Kembali
            </a>

            <div class="float-right">
              <button type="button"
                      class="btn btn-primary btn_proses"
                      disabled>
                <i class="fas fa-plus-circle"></i>
                Proses transaksi
              </button>
            </div>

          </div>
        </div>

    </div>
  </section>
</div>