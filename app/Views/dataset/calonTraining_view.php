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
              <h3>Daftar Calon Training</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">
          <div class="row mb-4">



            <!-- Data Training -->
            <div class="col-md-4 mb-3">
              <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                  <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                    <i class="bi bi-check2-circle fs-2"></i>
                  </div>

                  <div>
                    <h2 class="fw-bold mb-0"><?= $jmlTraining; ?></h2>
                    <h6 class="mb-1">Jumlah Data Training</h6>
                    <small class="text-muted">
                      Dataset yang digunakan untuk training
                    </small>
                  </div>

                </div>
              </div>
            </div>

            <!-- Data Training non Validasi -->
            <div class="col-md-4 mb-3">
              <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                  <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                    <i class="bi bi-clipboard-check-fill fs-2"></i>
                  </div>

                  <div>
                    <h2 class="fw-bold mb-0"><?= $jmlSudahSetTraining; ?></h2>
                    <h6 class="mb-1">Data Training sudah Set Kriteria</h6>
                    <small class="text-muted">
                      Dataset training yang sudah Set Kriteria
                    </small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                  <div class="icon-box bg-danger bg-opacity-10 text-warning me-3">
                    <i class="bi bi-clipboard-data fs-2" style="color: #dc3545;"></i>
                  </div>

                  <div>
                    <h2 class="fw-bold mb-0"><?= $jmlNotSetTraining; ?></h2>
                    <h6 class="mb-1">Data training belum Set Kriteria</h6>
                    <small class="text-muted">
                      Dataset training yang belum dilakukan Set Kriteria
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col">
                  <div class="d-flex justify-content-end">
                    <a href="<?= base_url('tambahCalonTraining'); ?>">
                      <!-- <button id="btnTambah" class="btn btn-primary"> -->
                        <button class="btn btn-primary">
                          Tambah Calon Data Training<i class="bi bi-plus"></i>
                        </button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="alert alert-info mb-3">
                  <i class="fas fa-info-circle me-2"></i>
                  <strong>Petunjuk:</strong> Set kriteria terlebih dahulu agar dataset dapat digunakan sebagai Data Training.
                </div>
                <div class="table-responsive">
                  <table id="tabelDataTraining" class="table table-bordered table-striped">
                    <form>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nomor KK</th>
                          <th>Nama Kepala Keluarga</th>
                          <th>Jumlah Anggota</th>
                          <th>Anggota Keluarga</th>
                          <th>Kriteria</th>
                          <th>Label</th>
                          <th>Status</th>
                          <th>aksi</th>
                        </tr>
                      </thead>
                    </form>
                  </table>
                </div>
              </div>
              <div class="card-footer">

              </div>
            </div>
          </div>
        </div>
        <script>

          $(document).ready(function () {

            $('#tabelDataTraining').DataTable({
              processing: true,
              destroy: true,
              responsive: true,
              autoWidth: false,

              ajax: {
                url: "<?= base_url('calonTraining/getDataTraining') ?>",
                type: "GET",
                dataSrc: "data"
              },

              columns: [
                {
                  data: null,
                  className: "text-center",
                  render: function (data, type, row, meta) {
                    return meta.row + 1;
                  }
                },
                {
                  data: "no_kk"
                },
                {
                  data: "kepala_keluarga"
                },
                {
                  data: "jumlah_anggota",
                  className: "text-center"
                },
                {
                  data: "anggota",
                  render: function (data) {

                    if (!data || data.length == 0)
                      return "-";

                    return data.join("<br>");
                  }
                },
                {
                  data: "kriteria",
                  render: function (data) {

                    return data == "" || data == null ? "-" : data;
                  }
                },
                {
                  data: "label_aktual",
                  render: function (data) {

                    return data == "" || data == null ? "-" : data;
                  }
                },
                {
                  data: "status",
                  className: "text-center",
                  render: function(data){

                    if(data == "Sudah Set Kriteria"){
                      return '<span class="badge bg-success">'+data+'</span>';
                    }

                    return '<span class="badge bg-danger text-light">'+data+'</span>';
                  }
                },
                {
                  data: null,
                  className: "text-center",
                  render: function (data) {

                    return `
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='<?= base_url('setKriteria') ?>?id_kk=${data.id_kk}'">
                            <i class="bi bi-sliders"></i> Set Kriteria
                        </button>
                    `;
                  }
                }
              ]
            });

          });
        </script>
        <?php if (session()->getFlashdata('success')) : ?>
        <script>
          document.addEventListener("DOMContentLoaded", function () {

            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: '<?= session()->getFlashdata('success'); ?>',
              confirmButtonText: 'OK',
              confirmButtonColor: '#198754'
            });

          });
        </script>
      <?php endif; ?>
    </main>
    <?= view('dashboard/footer_view'); ?>