<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" 
           data-widget="pushmenu" href="#" role="button">
           <i class="fas fa-bars"></i>
        </a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-hdd"></i>
          <span class="badge badge-warning navbar-badge">5</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">

          <span class="dropdown-item dropdown-header">Master data</span>
          
          <div class="dropdown-divider"></div>
          <a href="<?= site_url('supplier') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'supplier' ? 'active': '' ?>">
            <i class="fas fa-dolly mr-2"></i> Supplier
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('satuan') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'satuan' ? 'active': '' ?>">
            <i class="fas fa-cash-register mr-2"></i> Satuan
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('kategori-obat') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'kategori-obat' ? 'active': '' ?>">
            <i class="fas fa-th mr-2"></i> Kategori Obat
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('data-obat') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'data-obat' ? 'active': '' ?>">
            <i class="fas fa-prescription-bottle-alt mr-2"></i> Data Obat
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="<?= site_url('stok-obat') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'stok-obat' ? 'active': '' ?>">
            <i class="fas fa-truck mr-2"></i> Stok Obat
          </a>

        </div>

      </li>
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-database"></i>
          <span class="badge badge-warning navbar-badge">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">General</span>
          <div class="dropdown-divider"></div>
          <a href="<?= site_url('informasi-klinik') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'informasi-klinik' ? 'active': '' ?>">
            <i class="fas fa-building mr-2"></i> Informasi Klinik
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('metode-pembayaran') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'metode-pembayaran' ? 'active': '' ?>">
            <i class="fas fa-hand-holding-usd mr-2"></i> Metode Pembayaran
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('kategori-kamar') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'kategori-kamar' ? 'active': '' ?>">
            <i class="fas fa-restroom mr-2"></i> Kategori Kamar
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('kamar') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'kamar' ? 'active': '' ?>">
            <i class="fas fa-person-booth mr-2"></i> Kamar
          </a>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('administrator') ?>" class="dropdown-item <?= $this->uri->segment(1) == 'administrator' ? 'active': '' ?>">
            <i class="fas fa-users mr-2"></i> Administrator
          </a>
         
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->