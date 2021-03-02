<!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-1 sidebar-white-lightblue">
    <!-- Brand Logo -->
    <a href="<?= site_url() ?>" 
       class="brand-link navbar-white">
      <img src="<?= site_url('vendor/img/'.$info->logo.'') ?>" 
           alt="logo brand" 
           class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">
        <?= $info->nama_klinik ?>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-2 mb-2 d-flex">
        <div class="image">
          <img src="<?= site_url('vendor/img/user.png') ?>" 
               class="img-circle elevation-2" 
               alt="User Image"
               style="width: 40px;">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php
              if ( $this->session->userdata('jenis_kelamin') == 'L' ){
                $call='Tn.'.$this->session->userdata('nama_admin');
              }
              else{
                $call='Ny.'.$this->session->userdata('nama_admin');
              }
            ?>
            <?= $call; ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            if ( $this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard'  ){
              $active_dashboard = 'active';
            }
            else{
              $active_dashboard = '';
            }

          ?>
          <li class="nav-item">
            <a href="<?= site_url() ?>" class="nav-link <?= $active_dashboard ?>">
              <i class="nav-icon fas fa-clinic-medical"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= site_url('dokter-jaga') ?>" class="nav-link <?= $this->uri->segment(1) == 'dokter-jaga' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Dokter Jaga
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= site_url('registrasi-periksa-pasien') ?>" class="nav-link <?= $this->uri->segment(1) == 'registrasi-periksa-pasien' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Registrasi Periksa Pasien
              </p>
            </a>
          </li>
          

          <li class="nav-item">
            <a href="<?= site_url('daftar-pasien') ?>" class="nav-link <?= $this->uri->segment(1) == 'daftar-pasien' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Daftar Pasien
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="<?= site_url('pasien-rawat-inap') ?>" class="nav-link <?= $this->uri->segment(1) == 'pasien-rawat-inap' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-procedures"></i>
              <p>
                Pasien Rawat Inap 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-hospital-user"></i>
              <p>
                Pasien Rawat Jalan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= site_url('transaksi-periksa-pasien') ?>" class="nav-link <?= $this->uri->segment(1) == 'transaksi-periksa-pasien' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Transaksi Periksa Pasien
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Transaksi Rawat Inap
              </p>
            </a>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dropdown satu</p>
                </a>
              </li>
            </ul>
          </li> 
         
          

          <li class="nav-item">
            <a href="<?= site_url('login/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>