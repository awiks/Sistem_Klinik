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
        <div class="card-header p-2">

          <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active" 
                   href="#">
                  <i class="fas fa-user-nurse"></i> Dokter Jaga
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" 
                   href="<?= site_url('dokter-jaga/dokter') ?>">
                 <i class="fas fa-stethoscope"></i> Dokter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" 
                   href="<?= site_url('dokter-jaga/poliklinik') ?>">
                  <i class="fas fa-hospital-user"></i> Poliklinik
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" 
                   href="<?= site_url('dokter-jaga/layanan') ?>">
                  <i class="fas fa-headset"></i> Layanan
                </a>
              </li>
          </ul>

        </div>
        <div class="card-body">

          <div class="mb-2">
           <button type="button" 
                    data-toggle="modal" 
                    data-target="#Modal-add" 
                    class="btn bg-olive add">
                    <i class="fas fa-calendar-plus"></i> Buat Jadwal</button>
          </div>
     
            <div style="float:right;"> 
              <div class="form-inline mb-2">
                <label>Filter Tanggal : </label>
                <div class="form-group">
                 <input type="text" value="<?= date('d-m-Y') ?>" class="form-control tanggal ml-2" style="max-width: 200px;">
                </div>
              </div>
            </div>

                
              <div class="text-center load" 
                   style="display:block;
                          position:absolute;
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
                
              <div id="tampil_data"></div>
              
        </div>

      </div>
    </div>
  </section>
</div>