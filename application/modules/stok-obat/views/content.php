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
                  <a class="nav-link active" href="#">
                    <i class="fas fa-pallet"></i> Stok Obat
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('stok-obat/stok-masuk') ?>">
                   <i class="fas fa-dolly-flatbed"></i> Stok Masuk
                  </a>
                </li>
            </ul>
              </div>
              <div class="col-md-6">
                <div class="card-tools float-right">
                    
                    <div class="form-inline">
                        <label>Filter Kategori : </label>
                        <div class="form-group">

                          <select class="form-control kategori ml-2"> 
                             <option value="all">Semua Kategori</option> 
                             <?php
                              foreach ( $kategori as $rows ) {

                                 echo '<option value="'.$rows->id_kategori.'">'.$rows->nama_kategori.'</option> ';

                              }
                             ?>
                          </select>

                          <select class="form-control urutan ml-2 mr-2"> 
                             <option value="desc">DESC</option>
                             <option value="asc">ASC</option> 
                          </select>

                        </div>
                       
                      </div>

                </div>
              </div>
            </div>

          </div>
          <div class="card-body">
               
            
            <div class="table-responsive">
                  <table class="table table-striped" id="myTable">
                    <thead>
                      <tr class="bg-olive">
                        <th width="5%">#</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Stok</th>
                        <th>Satuan</th>
                        <th>Total harga jual</th>
                        <th width="5%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
          </div>
        </div>

      </div>
    </section>
</div>