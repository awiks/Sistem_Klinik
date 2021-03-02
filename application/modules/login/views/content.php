<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?></title>
  <link rel="icon" href="<?= site_url('vendor/img/'.$info->favicon.'') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('vendor/plugins/fontawesome-free/css/all.min.css') ?>">
  
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= site_url('vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('vendor/dist/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .bg-login {
      /*background: #dfe0e2 url(asset/img/pattern.jpg) repeat;*/
      background: #33abc2 url(vendor/img/<?= $info->bg_login ?>);
      background-position: center;
      background-repeat: repeat;
      background-size: cover;
      background-color:#33abc2;
    }
  </style>

</head>
<body class="hold-transition bg-login login-page" style="height: 70vh;">
<div class="login-box mt-5">
  <div class="login-logo">
    <img src="vendor/img/<?= $info->logo ?>" alt="loggo" width="50px">
    <a><b>e-</b>Klinik</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?= $this->session->flashdata('message'); ?>
      <form id="proses" action="<?= site_url('login') ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" 
                 name="username" 
                 class="form-control" 
                 placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password"
                name="password" 
                 class="form-control" 
                 placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Show password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->

    <div class="p-3">
      <p class="text-center mt-1 mb-1"><?= $info->nama_klinik ?> &copy;</p>
      <p class="text-center mt-1 mb-1">Right Reserved <?= $info->nama_klinik ?> 2021</p>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= site_url('vendor/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= site_url('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- jquery-validation -->
<script src="<?= site_url('vendor/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= site_url('vendor/plugins/jquery-validation/additional-methods.min.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?= site_url('vendor/dist/js/adminlte.min.js') ?>"></script>

<script type="text/javascript" charset="utf-8" async defer>
  $(function(){

    $('[name=email]').val('');
    $('[name=password]').val('');

    $('#remember').click(function(){
      if($(this).is(':checked')){
        $('[name=password]').attr('type','text');
      }else{
        $('[name=password]').attr('type','password');
      }
    });

    $('#proses').validate({
      errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    })
  });
</script>

</body>
</html>
