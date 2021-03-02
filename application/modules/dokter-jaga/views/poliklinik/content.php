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
                <a class="nav-link" 
                   href="<?= site_url('dokter-jaga') ?>">
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
                <a class="nav-link active" 
                   href="#">
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
            
              <div class="row mb-3">
                <div class="col-md-6">
                  <button type="button" 
                    data-toggle="modal" 
                    data-target="#Modal-add" 
                    class="btn bg-olive add">
                    <i class="fas fa-plus-circle"></i> Tambah data</button>
                </div>
                <div class="col-md-6">
                  <div style="float: right;">
                    <div class="form-inline">
                      <label>Filter Urutan : </label>
                      <div class="form-group">
                        <select class="form-control urutan ml-2 mr-2"> 
                           <option value="desc">DESC</option>
                           <option value="asc">ASC</option> 
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="table-responsive">
                <table class="table table-striped" width="100%" id="myTable">
                  <thead>
                    <tr class="bg-olive">
                      <th width="5%">#</th>
                      <th>Poliklinik</th>
                      <th>Tanggal Input</th>
                      <th width="10%">Aksi</th>
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