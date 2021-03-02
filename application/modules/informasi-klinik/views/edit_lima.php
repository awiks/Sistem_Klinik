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
           
        <form id="perbarui" 
              action="<?= site_url('informasi-klinik/perbarui-lima') ?>" 
              method="post" 
              accept-charset="utf-8"
              enctype="multipart/form-data">

          <input type="hidden" 
                 value="<?= sha1($edit->id_informasi) ?>" 
                 name="id">
          
          <div class="card">
            <div class="card-body">
              
              <table class="table table-responsive" style="background-color: #F3FCF3;">
                <tbody>
                  <tr>
                    <td class="text-bold" width="20%">
                     <i class="fas fa-atom"></i>  Favicon
                    </td>
                    <td width="2%">:</td>
                    <td class="p-1">
                      <div class="form-group">
                      <input type="file" 
                             name="favicon" required>
                      </div>

                      <p class="text-red">Format png Size 35px x 35px</p>

                      <img src="<?= site_url('vendor/img/'.$edit->favicon.'') ?>" 
                           alt="logo"
                           class="img-fluid img-thumbnail" 
                           style="width:30px;">
                    </td>
                  </tr>
                  
                </tbody>
              </table>

            </div>

            <div class="card-footer">
              <a href="<?= site_url('informasi-klinik') ?>" 
                 class="btn btn-danger">
               <i class="fas fa-undo"></i>  Kembali
              </a>
              <button type="submit" 
                 class="btn btn-success">
               <i class="fas fa-check"></i>  Perbarui
              </button>
            </div>
            
          </div>

          </form>

      </div>
    </section>
</div>