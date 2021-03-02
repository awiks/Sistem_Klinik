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
        <form id="simpan">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form barang masuk</h3>
          </div>
          <div class="card-body">
            
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group supplier">
                    <label>Supplier</label>
                    <select class="form-control flat select2" 
                            name="id_supplier" required>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <label>Tanggal Masuk</label>
                      <input type="text" 
                             name="tanggal_masuk" 
                             class="form-control dt" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <label>No Transaksi</label>
                      <input type="text" 
                             name="no_transaksi"
                             value="<?= $no_transaksi ?>" 
                             class="form-control" required readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <div class="form-group barang">
                    <label>Nama Obat</label>
                    <select class="form-control select3"
                            name="id_barang">
                      
                    </select>
                  </div>
                </div>
                <div class="col-md-4">

                  <div class="form-group number">
                    <label>Jumlah Qty </label>
                      <div class="input-group">
                        <input type="text" style="text-align: center;" name="jumlah_masuk" class="form-control">
                        <span class="input-group-append">
                          <button type="button" class="btn bg-olive add">
                             <i class="fas fa-plus-circle"></i> Add
                          </button>
                        </span>
                      </div>
                  </div>
                </div>
              </div>

              <div class="text-center load" 
               style="display:block;
                      position:absolute;z-index:9999;
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

              <table class="table table-striped">
                <thead>
                  <tr class="bg-olive">
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th width="10%">Hapus</th>
                  </tr>
                </thead>
                <tbody id="record"></tbody>
              </table>
            
          </div>
          
          <div class="card-footer">

            <a href="<?= site_url('stok-obat/stok-masuk') ?>" class="btn bg-danger">
             <i class="fa fa-undo"></i> Kembali
            </a>
            
            <button type="submit" 
                  class="btn bg-olive add-proses">
                  <i class="fa fa-check"></i> Proses
            </button>

          </div>
          
        </div>
         </form>
      </div>
    </section>
</div>