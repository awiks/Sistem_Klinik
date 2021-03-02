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

            <button type="button"
                    class="btn bg-olive add_baru"
                    data-toggle="modal"
                    data-target="#Modal-lg">
                  <i class="fas fa-plus-circle"></i>
                PASIEN BARU</button>

            <div class="card-tools">
              <div class="form-inline">
                <label>Filter Urutan : </label>
                <div class="form-group">

                 <select class="form-control urutan ml-2"> 
                     <option value="desc">DESC</option>
                     <option value="asc">ASC</option> 
                  </select>

                </div>
               
              </div>
            </div>
          </div>
          <div class="card-body">
            
            <table class="table table-striped" 
                   id="myTable" width="100%">
              <thead class="bg-olive">
                <tr>
                  <th>No RM</th>
                  <th>Nama Pasien</th>
                  <th>JK</th>
                  <th>Tgl Lahir</th>
                  <th>Umur</th>
                  <th>No Telp</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>

          </div>
        </div>

      </div>
    </section>
</div>