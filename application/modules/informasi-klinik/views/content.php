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
              <div class="table-responsive">
              <table class="table" style="background-color: #F3FCF3;">
                <tbody>
                  <tr>
                    <td class="text-bold" width="20%">
                     <i class="fas fa-clinic-medical"></i> Nama Klinik
                    </td>
                    <td width="2%">:</td>
                    <td><?= $info->nama_klinik ?></td>
                    <td class="text-center" width="10%">
                      <a href="<?= site_url('informasi-klinik/edit-satu/'.sha1($info->id_informasi).'') ?>" 
                         class="btn btn-info btn-xs">
                       <i class="fas fa-edit"></i>  Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-bold" width="20%">
                    <i class="fas fa-map-marker-alt"></i> Alamat
                    </td>
                    <td width="2%">:</td>
                    <td><?= $info->alamat_klinik ?></td>
                    <td class="text-center" width="10%">
                      <a href="<?= site_url('informasi-klinik/edit-dua/'.sha1($info->id_informasi).'') ?>" 
                         class="btn btn-info btn-xs">
                       <i class="fas fa-edit"></i>  Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-bold" width="20%">
                      <i class="fas fa-phone-square"></i>  No telepon
                    </td>
                    <td width="2%">:</td>
                    <td><?= $info->no_telpon ?></td>
                    <td class="text-center" width="10%">
                      <a href="<?= site_url('informasi-klinik/edit-tiga/'.sha1($info->id_informasi).'') ?>" 
                         class="btn btn-info btn-xs">
                       <i class="fas fa-edit"></i>  Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-bold" width="20%">
                      <i class="fas fa-laptop-medical"></i>  Logo
                    </td>
                    <td width="2%">:</td>
                    <td>
                      <img src="<?= site_url('vendor/img/'.$info->logo.'') ?>" 
                           alt="logo"
                           class="img-fluid img-thumbnail" 
                           style="width:150px;">
                    </td>
                    <td class="text-center" width="10%">
                      <a href="<?= site_url('informasi-klinik/edit-empat/'.sha1($info->id_informasi).'') ?>" 
                         class="btn btn-info btn-xs">
                       <i class="fas fa-edit"></i>  Edit
                      </a>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-bold" width="20%">
                      <i class="fas fa-atom"></i>  Favicon
                    </td>
                    <td width="2%">:</td>
                    <td>
                      <img src="<?= site_url('vendor/img/'.$info->favicon.'') ?>" 
                           alt="logo"
                           class="img-fluid" 
                           style="width:30px;">
                    </td>
                    <td class="text-center" width="10%">
                      <a href="<?= site_url('informasi-klinik/edit-lima/'.sha1($info->id_informasi).'') ?>" 
                         class="btn btn-info btn-xs">
                       <i class="fas fa-edit"></i>  Edit
                      </a>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-bold" width="20%">
                      <i class="fas fa-image"></i>  Background
                    </td>
                    <td width="2%">:</td>
                    <td>
                      <a href="<?= base_url('vendor/img/' . $info->bg_login . '') ?>" 
                         data-toggle="lightbox"
                         data-title="Background Login">
                        <img class="img-fluid img-thumbnail" 
                             src="<?= base_url('vendor/img/' . $info->bg_login . '') ?>"
                             style="width:250px;height:auto;"/>
                      </a>
                    </td>
                    <td class="text-center" width="10%">
                      <a href="<?= site_url('informasi-klinik/edit-enam/'.sha1($info->id_informasi).'') ?>" 
                         class="btn btn-info btn-xs">
                       <i class="fas fa-edit"></i>  Edit
                      </a>
                    </td>
                  </tr>

                </tbody>
              </table>
              </div>
            </div>
    
          </div>

      </div>
    </section>
</div>