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

        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Klik tombol cetak di bagian bawah.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Invoice
                    <small class="float-right">Date: <?= date('d-m-Y',strtotime($detail->tanggal_transaksi)) ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Nama Pasien
                  <address>
                    <strong><?= $detail->no_rekam_medik ?></strong><br>
                    <?= $detail->nama_pasien ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Dokter
                  <address>
                    <strong><?= $detail->nama_dokter ?></strong><br>
                    <?= $detail->nama_poliklinik ?><br>
                    <?= $detail->deskripsi_layanan ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>No Reg #<?= $detail->no_registrasi ?></b><br>
                  <br>
                  <b>Trans ID :</b> <?= $detail->no_transaksi ?><br>
                  <b>Kasir :</b> <?= $detail->nama_kasir ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Kode Obat</th>
                      <th>Nama Obat</th>
                      <th>Aturan Pakai</th>
                      <th>Satuan</th>
                      <th>Qty</th>
                      <th>Harga</th>
                      <th width="15%">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                          $id_transaksi_periksa = $detail->id_transaksi_periksa;

                          $query = $this->db->query("SELECT dtp.*,b.nama_barang,b.aturan_pakai,s.nama_satuan,b.kode_barang 
                                                     FROM tb_detail_transaksi_periksa  dtp
                                                     JOIN tb_barang b ON dtp.id_barang=b.id_barang
                                                     JOIN tb_satuan s ON b.id_satuan=s.id_satuan
                                                     WHERE dtp.id_transaksi_periksa='$id_transaksi_periksa'");

                          foreach ( $query->result() as $row ) {
                            
                            echo '<tr>
                                <td>'.$row->kode_barang.'</td>
                                <td>'.$row->nama_barang.'</td>
                                <td>'.$row->aturan_pakai.'</td>
                                <td>'.$row->nama_satuan.'</td>
                                <td>'.$row->jumlah_obat.'</td>
                                <td>'.number_format($row->harga_satuan).'</td>
                                <td>'.number_format($row->sub_total).'</td>
                               </tr>';

                          }

                        ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                       <tr>
                        <th style="width:70%">Total biaya Obat</th>
                        <td><?= number_format($detail->biaya_obat) ?></td>
                       </tr>
                      <tr>
                        <th>Total biaya Layanan</th>
                        <td><?= number_format($detail->biaya_layanan) ?></td>
                      </tr>
                      <tr>
                        <th>Subtotal</th>
                        <td><?= number_format($detail->sub_total) ?></td>
                      </tr>
                      <tr>
                        <th>Diskon</th>
                        <td><?= number_format($detail->diskon) ?></td>
                      </tr>
                      <tr>
                        <th>Yang dibayar</th>
                        <td><?= number_format($detail->bayar) ?></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">

                  <a href="<?= site_url('transaksi-periksa-pasien') ?>" 
                     class="btn btn-danger">
                     <i class="fas fa-history"></i> 
                   Kembali</a>
                  
                  <a href="#"
                     data-id="<?= $detail->no_transaksi ?>"
                     class="btn btn-default cetak float-right">
                     <i class="fas fa-print"></i> 
                   Print</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>



      </div><!-- END container-fluid -->

  </section>
</div>