<?= view('dashboard/header_view'); ?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div id="alertBox"></div>
  <div class="app-wrapper">

    <?= view('dashboard/sidebar_view'); ?>

    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3>Data Kriteria</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">

          <div class="card">
            <div class="card-header">
              <h4>Daftar Kriteria</h4>
            </div>          
            <div class="card-body">
              <div class="tab-content mt-3">
                  <?= view('Kriteria/datakriteria'); ?>
              </div>
            </div> <!--- Batas Div class card- Body -->
          </div>
        </div>
      </div>

    </main>
    <?= view('dashboard/footer_view'); ?>