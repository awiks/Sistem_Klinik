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
          <div class="card-header pb-2 pt-2">
            
            <a href="<?= site_url('transaksi-periksa-pasien/add') ?>" 
               class="btn btn-primary">
              <i class="fas fa-cart-plus"></i>
              Add Transaksi
            </a>

            <div class="card-tools">
              
              <div class="form-inline">
                  <label>Filter : </label>
                  <div class="form-group">

                    <select class="form-control bulan ml-2">
                      <option value="all">Semua Bulan</option>
                      <option value="1" <?php if(date('n')=='1'): echo 'selected'; endif; ?>>Januari</option>
                      <option value="2" <?php if(date('n')=='2'): echo 'selected'; endif; ?>>Februari</option>
                      <option value="3" <?php if(date('n')=='3'): echo 'selected'; endif; ?>>Maret</option>
                      <option value="4" <?php if(date('n')=='4'): echo 'selected'; endif; ?>>April</option>
                      <option value="5" <?php if(date('n')=='5'): echo 'selected'; endif; ?>>Mei</option>
                      <option value="6" <?php if(date('n')=='6'): echo 'selected'; endif; ?>>Juni</option>
                      <option value="7" <?php if(date('n')=='7'): echo 'selected'; endif; ?>>Juli</option>
                      <option value="8" <?php if(date('n')=='8'): echo 'selected'; endif; ?>>Agustus</option>
                      <option value="9" <?php if(date('n')=='9'): echo 'selected'; endif; ?>>September</option>
                      <option value="10" <?php if(date('n')=='10'): echo 'selected'; endif; ?>>Oktober</option>
                      <option value="11" <?php if(date('n')=='11'): echo 'selected'; endif; ?>>November</option>
                      <option value="12" <?php if(date('n')=='12'): echo 'selected'; endif; ?>>Desember</option>
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
          <div class="card-body">
            
            <div class="table-responsive">
              <table class="table table-striped" id="myTable" width="100%">
                <thead>
                  <tr class="bg-olive">
                    <th>No Transaksi</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>By Layanan</th>
                    <th>By Obat</th>
                    <th>Subtotal</th>
                    <th width="10%">Detail</th>
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