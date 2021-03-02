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
          <div class="card-header pt-2 pb-2">
            <a href="<?= site_url('stok-obat/stok-masuk') ?>" class="btn bg-danger">
             <i class="fa fa-undo"></i> Kembali
            </a>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                    <label>No Transaksi</label>
                    <input type="text"
                          value="<?= $data_masuk->no_transaksi ?>" 
                           class="form-control" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Supplier</label>
                    <input type="text"
                          value="<?= $data_masuk->kode_supplier.' - '.$data_masuk->nama_supplier ?>" 
                           class="form-control" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                      <label>Tanggal Masuk</label>
                      <input type="text"
                             value="<?= date('d-m-Y',strtotime($data_masuk->tanggal_masuk)) ?>"  
                             class="form-control" disabled>
                  </div>
              </div>
            </div>

            
            <div class="table-responsive">
              <table class="table table-striped" width="100%">
                <thead>
                  <tr class="bg-olive">
                    <th width="5%">#</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $nomor=1;
                    foreach ( $detail_masuk as $rows ) {
                      
                      echo '<tr>
                              <td>'.$nomor.'</td>
                              <td>'.$rows->kode_barang.'</td>
                              <td>'.$rows->nama_barang.'</td>
                              <td>'.$rows->jumlah_masuk.'</td>
                              <td>'.$rows->nama_satuan.'</td>
                            </tr>';

                      $nomor++;
                    }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </section>
</div>