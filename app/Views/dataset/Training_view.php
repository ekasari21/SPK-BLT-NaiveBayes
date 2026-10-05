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
              <h3>Pehitungan Naive Bayes</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">

          <div class="card">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-9">
                  <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                      <i class="bi bi-list-check"></i>
                      Keterangan Kriteria
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <?php foreach($kriteriaShow as $k):?>
                        <div class="col-md-3 mb-2">
                          <span class="badge bg-primary"><?= $k['kode_kriteria'];?></span>
                          <?= $k['nama_kriteria'];?>
                        </div>
                         <?php endforeach;?>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                      <i class="bi bi-tags"></i>
                      Label
                    </div>
                    <div class="card-body">
                      <span class="badge bg-success mb-2">
                        <?= $probPrior['jumlah_layak']; ?>  Layak 
                      </span>
                      <br>
                      <span class="badge bg-danger">
                        <?= $probPrior['jumlah_tidak_layak']; ?> Tidak Layak
                      </span>
                      <hr>
                      <small class="text-muted">
                        Label digunakan sebagai data training pada proses klasifikasi Naive Bayes.
                      </small>
                    </div>
                  </div>  
                </div>
              </div>
              <div class="row mb-12">
                <div class="col-md-6">
                  <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                      <i class="bi bi-tags"></i>
                      Probabilitas Prior
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered table-striped">
                        <tr>
                          <td> Probabilitas Layak</td>
                          <td> 
                           <span class="badge bg-success mb-2">
                             <h6> <?= $probPrior['prior_layak']; ?> </h6>
                           </span>
                         </td>
                       </tr>
                       <tr>
                        <td> Probabilitas Tidak Layak</td>
                        <td>
                         <span class="badge bg-danger">
                           <h6> <?= $probPrior['prior_tidak_layak']; ?></h6>
                         </span>
                       </td>
                     </tr>
                   </table>
                 </div>
               </div>  
             </div>
           </div>
           <br>
           <div class="row mb-12">
             <div class="col-md-12">
               <div class="card shadow">

                <div class="card-header bg-success text-white">
                  Probabilitas Kondisional
                </div>

                <div class="card-body">

                  <table class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Kriteria</th>

                        <th>Nilai</th>

                        <th>Frek. Layak</th>

                        <th>P(X|Layak)</th>

                        <th>Frek. Tidak Layak</th>

                        <th>P(X|Tidak Layak)</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php foreach($probabilitas as $p):?>

                        <tr>

                          <td><?= $p['kode_kriteria'];?> - <?= $p['kriteria'];?></td>

                          <td><?= $p['kategori'];?></td>

                          <td><?= $p['jumlah_layak'];?></td>

                          <td><?= number_format($p['prob_layak'],4);?></td>

                          <td><?= $p['jumlah_tidak'];?></td>

                          <td><?= number_format($p['prob_tidak'],4);?></td>

                        </tr>

                      <?php endforeach;?>

                    </tbody>

                  </table>

                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tabelDataTraining" class="table table-bordered table-striped">
              <form>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor KK</th>
                    <th>Nama Kepala Keluarga</th>
                    <th data-bs-toggle="tooltip" title="Kepemilikan Kendaraan">K1</th>
                    <th data-bs-toggle="tooltip" title="Kepemilikan Rumah">K2</th>
                    <th data-bs-toggle="tooltip" title="Kondisi Rumah">K3</th>
                    <th data-bs-toggle="tooltip" title="Kepemilikan Tanah">K4</th>
                    <th data-bs-toggle="tooltip" title="Penghasilan">K5</th>
                    <th data-bs-toggle="tooltip" title="Tanggungan">K6</th>
                    <th data-bs-toggle="tooltip" title="usia">K7</th>
                    <th data-bs-toggle="tooltip" title="Pekerjaan">K8</th>
                    <th data-bs-toggle="tooltip" title="Label Data Training">Label</th>
                    <th>aksi</th>
                  </tr>
                </thead>
              </form>
            </table>
          </div>
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
          url: "<?= base_url('calonTraining/getDataTrainingSetKriteria') ?>",
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
            data: "nama"
          },
          {
            data: "kepemilikan_kendaraan",
            className: "text-center"
          },
          {
            data: "kepemilikan_rumah",
            className: "text-center"
          },
          {
            data: "kondisi_rumah",
            className: "text-center"
          },
          {
            data: "kepemilikan_tanah",
            className: "text-center"
          },
          {
            data: "penghasilan",
            className: "text-center"
          },
          {
            data: "tanggungan",
            className: "text-center"
          },
          {
            data: "usia",
            className: "text-center"
          },
          {
            data: "pekerjaan",
            className: "text-center"
          },
          {
            data: "label_aktual",
            render: function (data) {

              return data == "" || data == null ? "-" : data;
            }
          },
          {
            data: null,
            className: "text-center",
            render: function (data) {

              return `
                       <button type="button"
                            class="btn btn-danger btn-sm btn-hapus"
                            data-id="${data.id_kk}"
                            data-nama="${data.no_kk}">
                            <i class="bi bi-trash"></i> Hapus
                          </button>
              `;
            }
          }
        ]
      });

    });
  </script>
</main>
<?= view('dashboard/footer_view'); ?>