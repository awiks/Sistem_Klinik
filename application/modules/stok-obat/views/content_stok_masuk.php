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
          <div class="card-header p-1">

            <div class="row">
              <div class="col-md-6">
                <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('stok-obat') ?>">
                    <i class="fas fa-pallet"></i> Stok Obat
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">
                   <i class="fas fa-dolly-flatbed"></i> Stok Masuk
                  </a>
                </li>
            </ul>
              </div>
              <div class="col-md-6">
                <div class="card-tools float-right">

                    <div class="form-inline">
                      <label>Filter : </label>
                      <div class="form-group">

                        <select class="form-control bulan ml-2">
                          <option value="all">Semua Bulan</option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>

                        <select class="form-control tahun ml-2 mr-2"> 
                          <?php
                          $selected = date('Y'); 
                          $earliest_year = 2020; 
                          $latest_year = date('Y'); 
                          foreach ( range( $latest_year, $earliest_year ) as $i ) {
                              echo '<option value="'.$i.'"'.($i === $selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                          }
                          ?> 
                        </select>

                      </div>
                    </div>

                </div>
              </div>
            </div>

          </div>
          <div class="card-body pt-2">

             <a href="<?= site_url('stok-obat/add-obat-masuk') ?>"
                        class="btn btn-primary mb-2 float-right">
                <i class="fas fa-calendar-plus"></i> 
              Proses Obat Masuk</a>

              <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                  <thead>
                    <tr class="bg-olive">
                      <th width="5%">#</th>
                      <th>No Transaksi</th>
                      <th>Nama Supplier</th>
                      <th>Tanggal Masuk</th>
                      <th>Total Jenis Obat</th>
                      <th>Tanggal input</th>
                      <th width="15%">Detail Obat</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>

          </div>
        </div>

      </div>
    </section>
</div>