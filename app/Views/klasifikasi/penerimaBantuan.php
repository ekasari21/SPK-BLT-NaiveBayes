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
              <h3>Data Penerima Bantuan</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">
          <div class="row mb-4">



            <!-- Data Testing -->
            <div class="col-md-6 mb-3">
              <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                  <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                    <i class="bi bi-check-circle-fill text-success"></i>
                  </div>

                  <div>
                    <h2 class="fw-bold mb-0"><?= $jmlDisetujui; ?></h2>
                    <h6 class="mb-1">Jumlah Disetujui</h6>
                    <small class="text-muted">
                      Rekapitulasi Penerima Bantuan
                    </small>
                  </div>

                </div>
              </div>
            </div>

            <!-- Data Training non Validasi -->
            <div class="col-md-6 mb-3">
              <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center">

                  <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                   <i class="bi bi-x-circle-fill text-danger"></i>
                 </div>

                 <div>
                  <h2 class="fw-bold mb-0"><?= $jmlDitolak; ?></h2>
                  <h6 class="mb-1">Jumlah Ditolak</h6>
                  <small class="text-muted">
                    Rekapitulasi Ditolak
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <span><b>Filter Rekapituliasi Penerima Bantuan</b></span>
            <div class="row g-3 align-items-end">

              <!-- Tanggal Awal -->
              <div class="col-md-3">
                <label class="form-label fw-semibold">
                  Tanggal Awal
                </label>
                <input type="date" class="form-control" id="tgl_awal">
              </div>

              <!-- Tanggal Akhir -->
              <div class="col-md-3">
                <label class="form-label fw-semibold">
                  Tanggal Akhir
                </label>
                <input type="date" class="form-control" id="tgl_akhir">
              </div>

              <!-- Status -->
              <div class="col-md-3">
                <label class="form-label fw-semibold">
                  Status Persetujuan
                </label>
                <select class="form-select" id="status">
                  <option value="">Semua Status</option>
                  <option value="Disetujui">Disetujui</option>
                  <option value="Ditolak">Ditolak</option>
                </select>
              </div>
              <!-- Tombol -->
              <div class="col-md-3">

                <button class="btn btn-primary w-100 mb-2" id="btnFilter">
                  <i class="bi bi-funnel-fill"></i> Terapkan Filter
                </button>

                <button class="btn btn-secondary w-100" id="btnReset">
                  <i class="bi bi-arrow-clockwise"></i> Reset
                </button>

              </div>
            </div>
            <br>
            <div class="col-12">
              <button class="btn btn-success w-100" id="btnDownload">
                <i class="bi bi-download"></i> Download Data
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelHasilPersetujuan" class="table table-bordered table-striped">
                <form>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nomor KK</th>
                      <th>Nama Kepala Keluarga</th>
                      <th>Kriteria</th>
                      <th>Status</th>
                      <th>Tgl Persetujuan</th>
                      <th>Keterangan</th>
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

        $("#btnFilter").click(function () {

          tglAwal = $("#tgl_awal").val();
          tglAkhir = $("#tgl_akhir").val();
          status = $("#status").val();
          console.log(tglAwal);
          console.log(tglAkhir);
          console.log(status);

          $('#tabelHasilPersetujuan').DataTable().ajax.reload();

        });
        $("#btnReset").click(function () {

          $("#tgl_awal").val('');
          $("#tgl_akhir").val('');
          $("#status").val('');

          tglAwal = '';
          tglAkhir = '';
          status = '';

          tabel.ajax.reload();

        });

        let tglAwal = '';
        let tglAkhir = '';
        let status = '';
        const userRole = "<?= session()->get('role') ?>";
        $('#tabelHasilPersetujuan').DataTable({
          processing: true,
          destroy: true,
          responsive: true,
          autoWidth: false,

          ajax: {
            url: "<?= base_url('getHasilPersetujuan') ?>",
            type: "GET",
            data: function (d) {

              d.tgl_awal = tglAwal;
              d.tgl_akhir = tglAkhir;
              d.status = status;

            },
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
              data: "kriteria",
              render: function (data) {

                return data == "" || data == null ? "-" : data;
              }
            },
            {
              data: "status"
            },
            {
              data: "tgl_persetujuan"
            },
            {
              data: "catatan"
            }
          ]
        });

        $("#btnDownload").click(function () {

          let tglAwal  = $("#tgl_awal").val();
          let tglAkhir = $("#tgl_akhir").val();
          let status   = $("#status").val();

          $.ajax({
            url: "<?= base_url('downloadHasilPersetujuan') ?>",
            type: "GET",
            data: {
              tgl_awal: tglAwal,
              tgl_akhir: tglAkhir,
              status: status
            },
            success: function () {

              let url = "<?= base_url('downloadHasilPersetujuan') ?>"
              + "?tgl_awal=" + encodeURIComponent(tglAwal)
              + "&tgl_akhir=" + encodeURIComponent(tglAkhir)
              + "&status=" + encodeURIComponent(status);

              window.open(url, "_blank");
            }
          });

        });
        
// Batas Akhir
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