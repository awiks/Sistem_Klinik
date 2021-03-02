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

        <div class="card mb-2">

           <div class="card-header pt-1 pb-1">
            <div class="card-title">
              <div class="mt-1"><i class="far fa-clock"></i>  <span id="ct"></span></div>
            </div>
            <div class="card-tools">
              <div class="form-inline">
                <label>Filter Tanggal : </label>
                <div class="form-group">

                 <input type="text"
                        value="<?= date('d-m-Y') ?>" 
                        class="form-control tanggal ml-2"
                        style="max-width: 150px;">

                 <select class="form-control urutan ml-2"> 
                     <option value="desc">DESC</option>
                     <option value="asc">ASC</option> 
                  </select>

                </div>
               
              </div>
            </div>
          </div>

          <div class="card-body p-2">

            <div class="text-center load" 
                   style="display:block;
                          position:absolute;
                          z-index: 9999999;
                          margin-left:40%;
                          top:50%;
                          background-color:#fff;
                          padding:10px;
                          min-width: 150px;
                          border: 0 solid rgba(0,0,0,.125);
                          box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
                          border-radius:10px;">
                    <i class="fa fa-spinner fa-spin default"></i> Memuat...
              </div>
            
            <div id="tampil_antrian"></div>

          </div>
        </div>

        <div class="card">

          <div class="card-header p-2">
            
            <button type="button"
                    class="btn btn-primary add_lama"
                    data-toggle="modal"
                    data-target="#Modal-add">
                    <i class="fas fa-procedures"></i> PASIEN LAMA</button>
            <button type="button"
                    class="btn btn-success add_baru"
                    data-toggle="modal"
                    data-target="#Modal-lg">
                  <i class="fas fa-hospital-user"></i> PASIEN BARU</button>

            <div class="card-tools">
              <div class="form-inline">
                <label>Filter Jadwal dokter : </label>
                <select class="form-control jadwal ml-2 mr-2"> 
                   <option value="all">All Schedule</option>
                </select>
              </div>
            </div>
          </div>
         
          <div class="card-body p-2">

          <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped" id="myTable" width="100%">
              <thead>
                <tr class="bg-olive">
                  <th width="5%">#</th>
                  <th>No Registrasi</th>
                  <th>No RM</th>
                  <th>Nama Pasien</th>
                  <th>Jam Registrasi</th>
                  <th width="10%">No.Antrian</th>
                  <th>Status</th>
                  <th width="15%">Aksi</th>
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