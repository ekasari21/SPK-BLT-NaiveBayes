<?= view('dashboard/header_view'); ?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

     <?= view('dashboard/sidebar_view'); ?>
     <!--end::Sidebar-->
     <!--begin::App Main-->
     <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <?php if(session()->get('role') == 'admin') { ?>
                <h3 class="mb-0">Dashboard Administrator</h3>

              <?php }else{?>
               <h3 class="mb-0">Dashboard Kepala Desa</h3>
             <?php } ?>
           </div>
           <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard </li>
            </ol>
          </div>
        </div>
        <!--end::Row-->
      </div>
      <!--end::Container-->
    </div>
    <div class="app-content">
      <!--begin::Container-->
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-geo-alt-fill"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Dusun</span>
                <span class="info-box-number">
                 <h5><b> <?= $jmlDusun ?></b></h5>
               </span>
             </div>
             <!-- /.info-box-content -->
           </div>
           <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-danger shadow-sm">
              <i class="bi bi-house-fill"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah RW</span>
              <span class="info-box-number">
                <h5><b> <?= $jmlRW ?></b></h5>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-success shadow-sm">
              <i class="bi bi-house-door-fill"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah RT</span>
              <span class="info-box-number">
                <h5><b> <?= $jmlRT ?></b></h5>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon text-bg-warning shadow-sm">
              <i class="bi bi-person-fill"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah KK</span>
              <span class="info-box-number">
                <h5><b> <?= $jmlKK ?></b></h5>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!--begin::Row-->
      <div class="row">
        <div class="card shadow-sm">

          <div class="card-body">

            <div class="row align-items-center">

              <div class="col-md-8">

                <h2 class="fw-bold text-success">
                  Selamat Datang
                </h2>

                <h5 class="mb-3">
                  Sistem Rekomendasi Penerimaan Bantuan BLT-DD
                  Menggunakan Algoritma Naive Bayes
                </h5>

                <p class="text-muted">

                  Sistem ini digunakan untuk membantu pemerintah desa
                  dalam menentukan calon penerima Bantuan Langsung Tunai Dana Desa
                  secara objektif berdasarkan kriteria yang telah ditentukan.

                </p>

                <div class="mt-3">

                  <span class="badge bg-success p-2 me-2">
                    <i class="bi bi-check-circle"></i>
                    Objektif
                  </span>

                  <span class="badge bg-primary p-2 me-2">
                    <i class="bi bi-check-circle"></i>
                    Transparan
                  </span>

                  <span class="badge bg-warning text-dark p-2">
                    <i class="bi bi-check-circle"></i>
                    Tepat Sasaran
                  </span>

                </div>

              </div>

              <div class="col-md-4 text-center">

                <img src="<?= base_url('dist/assets/img/dashboard.png') ?>"
                class="img-fluid"
                style="max-height:280px;">

              </div>

            </div>

          </div>

        </div>
      </div>
      <!--end::Row-->

      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->
<?= view('dashboard/footer_view'); ?>