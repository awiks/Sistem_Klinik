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
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info">
                      <i class="fas fa-notes-medical"></i>
                    </span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Registrasi</span>
                      <span class="info-box-number">
                        <?= $jml_registrasi ?>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-user-injured"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Pasien</span>
                      <span class="info-box-number">
                        <?= $jml_pasien ?>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-procedures"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Rawat Inap</span>
                      <span class="info-box-number">13,648</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger">
                      <i class="fas fa-database"></i>
                    </span>

                    <div class="info-box-content">
                      <span class="info-box-text">Kapasitas Database</span>
                      <span class="info-box-number">
                        <?= $kapasitas_database ?>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>

           </div>
        </div>

      </div>

    </section>

</div>