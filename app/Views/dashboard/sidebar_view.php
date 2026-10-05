<nav class="app-header navbar navbar-expand bg-primary" data-bs-theme="dark">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
  </div>
  <!--end::Container-->
</nav>

<!--begin::Sidebar-->
<aside class="app-sidebar bg-white" data-bs-theme="light">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="dist/index.html" class="brand-link">
      <!--begin::Brand Image-->
      <img
      src="dist/assets/img/logo.png"
      alt="Sistem Rekomendasi BLT-DD"
      class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">SPK BLTD</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
      class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="navigation"
      aria-label="Main navigation"
      data-accordion="false"
      id="navigation"
      >
      <li class="nav-item">
        <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= active_menu('dashboard') ?>">
          <i class="bi bi-speedometer2"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <?php if(session()->get('role') == 'admin') : ?>
      <li class="nav-item">
        <a href="#" class="nav-link <?= active_parentmenu(['wilayah','keluarga','detailanggota']) ?>">
          <i class="nav-icon bi bi-table"></i>
          <p>
            Kelola Dataset Master
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('wilayah'); ?>" class="nav-link <?= active_menu('wilayah') ?>">
              <i class="nav-icon bi bi-circle"></i>
              <p>Wilayah</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('keluarga'); ?>" class="nav-link <?= active_menu('keluarga') ?>">
              <i class="nav-icon bi bi-circle"></i>
              <p>Data Keluarga (KK)</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('detailanggota'); ?>" class="nav-link <?= active_menu('detailanggota') ?>">
              <i class="nav-icon bi bi-circle"></i>
              <p>Detail Anggota Keluarga</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link <?= active_parentmenu(['kriteria','nilaiKriteria']) ?>">
          <i class="bi bi-list-check"></i>
          <p>
            Data Kriteria Master
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('kriteria'); ?>" class="nav-link <?= active_menu('kriteria') ?>">
              <i class="nav-icon bi bi-circle"></i>
              <p>Kelola Kriteria</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('nilaiKriteria'); ?>" class="nav-link <?= active_menu('nilaiKriteria') ?>">
              <i class="nav-icon bi bi-circle"></i>
              <p>Kelola Nilai Kriteria</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
       <a href="<?= base_url('calonTraining'); ?>" class="nav-link <?= active_menu('calonTraining') ?>">
        <i class="bi bi-folder2-open"></i>
        <p>Kelola Dataset Training</p>
      </a>
    </li>
    <li class="nav-item">
     <a href="<?= base_url('hitungNaiveBayes'); ?>" class="nav-link <?= active_menu('hitungNaiveBayes') ?>">
      <i class="bi bi-calculator"></i>
      <p>Perhitungan Naive Bayes</p>
    </a>
  </li>
  <li class="nav-item">
   <a href="<?= base_url('calonKlasifikasi'); ?>" class="nav-link <?= active_menu('calonKlasifikasi') ?>">
    <i class="bi bi-list-check"></i>
    <p>Kelola Dataset Klasifikasi</p>
  </a>
</li> 
<li class="nav-item">
  <a href="<?= base_url('result'); ?>" class="nav-link <?= active_menu('result') ?>">
    <i class="bi bi-bar-chart-line-fill"></i>
    <p>Hasil Klasifikasi</p>
  </a>
</li> 
<?php endif; ?>
<?php if(session()->get('role') == 'kepala_desa') : ?>
<li class="nav-item">
  <a href="<?= base_url('hasilKlasifikasi'); ?>" class="nav-link <?= active_menu('dashboard') ?>">
    <i class="bi bi-bar-chart-line-fill"></i>
    <p>Validasi Bantuan BLT-DD</p>
  </a>
</li>
<li class="nav-item">
  <a href="<?= base_url('penerimaBantuan'); ?>" class="nav-link <?= active_menu('dashboard') ?>">
    <i class="bi-clipboard-check"></i>
    <p>Rekap Penerima Bantuan</p>
  </a>
</li>
<?php endif; ?>
</ul>
<!--end::Sidebar Menu-->
</nav>
<?php if(session()->get('role') == 'admin') : ?>
<div class="border-top p-3">

  <a href="<?= base_url('user'); ?>"
   class="btn btn-secondary text-light w-100">

   <i class="bi bi-people-fill"></i>
   Kelola Data Pengguna

 </a>

</div>
<?php endif; ?>    
<!-- ================= Logout ================= -->
<div class="border-top p-3">

  <a href="<?= base_url('logout'); ?>"
   class="btn btn-success text-light w-100">

   <i class="bi bi-box-arrow-right"></i>

   Logout

 </a>

</div>
</div>
<!--end::Sidebar Wrapper-->
</aside>