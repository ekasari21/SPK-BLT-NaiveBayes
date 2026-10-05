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

              <h5>Set Data Training</h5>
              <br>

            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">
              <i class="bi bi-house-door"></i>
              Data Keluarga dan Anggota Keluarga
            </h5>
          </div>

          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <h5>Data Keluarga</h5>
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Nomor KK</td>
                      <td> : </td>
                      <td><?= $keluarga['no_kk']; ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Anggota Keluarga</td>
                      <td> : </td>
                      <td><?= $keluarga['jumlah_anggota']; ?></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td> : </td>
                      <td><?= $keluarga['alamat']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <h5>Data Anggota Keluarga</h5>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Anggota</th>
                      <th>Jenis Kelamin</th>
                      <th>Hubungan Keluarga</th>
                      <th>Pendidikan</th>
                      <th>Pekerjaan</th>
                      <th>Penghasilan</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $no=1; ?>

                    <?php foreach($anggotaKeluarga as $row){ ?>

                      <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['nik']; ?></td>

                        <td><?= $row['nama']; ?></td>

                        <td>
                          <?php if($row['hubungan_keluarga']=="Kepala Keluarga"){ ?>

                            <span class="badge bg-success">
                              Kepala Keluarga
                            </span>

                          <?php }else{ ?>

                            <?= $row['hubungan_keluarga']; ?>

                          <?php } ?>
                        </td>

                        <td><?= $row['pendidikan']; ?></td>

                        <td><?= $row['nama_pekerjaan']; ?></td>

                        <td>
                          Rp <?= number_format($row['penghasilan_pribadi'],0,',','.'); ?>
                        </td>

                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="card">
            <div class="card shadow-sm">
              <div class="card-body">

                <ul class="nav nav-pills mb-4 flex-nowrap overflow-auto"
                id="kriteriaTab"
                role="tablist"
                style="white-space: nowrap;">
                <?php foreach($kriteria as $i=>$k): ?>
                  <li class="nav-item me-2">

                    <button
                    class="nav-link <?= $i==0 ? 'active bg-success text-white' : 'bg-light text-secondary border'; ?>"
                    id="<?= esc($k['kode_kriteria']) ?>-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#<?= esc($k['kode_kriteria']) ?>"
                    type="button"
                    role="tab"
                    aria-controls="<?= esc($k['kode_kriteria']) ?>"
                    aria-selected="<?= $i==0 ? 'true' : 'false' ?>">

                    C<?= $i+1 ?> : <?= esc($k['nama_kriteria']) ?>

                  </button>

                </li>
              <?php endforeach; ?>

            </ul>
            <!--<form id="formTraining" method="post" action="<?= base_url('training/simpanSetKriteria') ?>"> -->
              <form id="formTraining" method="post" action="<?= base_url('training/simpanSetKriteria') ?>" novalidate>
                <input type="hidden" name="id_kk" value="<?= $keluarga['id_kk']; ?>">
                <div class="tab-content">
                  <?php foreach($kriteria as $i=>$k): ?>
                    <div class="tab-pane fade <?= $i==0 ? 'show active' : '' ?>" id="<?= esc($k['kode_kriteria']) ?>" data-nama="<?= esc($k['nama_kriteria']) ?>" role="tabpanel">

                      <!-- Batas Tabs-->

                      <div class="card-body">
                        <div class="col-md-12 mb-3">
                          <div class="card h-100 border-primary">

                            <div class="card-header">
                              <span class="badge bg-primary"><?= esc($k['kode_kriteria']) ?></span>
                              <?= esc($k['nama_kriteria']) ?>
                            </div>

                            <div class="card-body">

                              <label class="form-label">
                                <strong> <b><?= esc($k['keterangan']) ?></b></strong>
                              </label>
                              <?php foreach($k['nilai'] as $index => $n): 
                                $kepemilikan_kendaraan=$valueKriteria['kepemilikan_kendaraan'];
                                $kepemilikan_rumah=$valueKriteria['kepemilikan_rumah'];
                                $kondisi_rumah=$valueKriteria['kondisi_rumah'];
                                $kepemilikan_tanah=$valueKriteria['kepemilikan_tanah'];
                                $penghasilan=$valueKriteria['penghasilan'];
                                $tanggungan=$valueKriteria['tanggungan'];
                                $usia=$valueKriteria['usia'];
                                $pekerjaan= $valueKriteria['pekerjaan'];

                                switch ($k['kode_kriteria']) {
                                  case 'C1':
                                  $value = $valueKriteria['kepemilikan_kendaraan'] ?? '';
                                  break;

                                  case 'C2':
                                  $value = $valueKriteria['kepemilikan_rumah'] ?? '';
                                  break;

                                  case 'C3':
                                  $value = $valueKriteria['kondisi_rumah'] ?? '';
                                  break;

                                  case 'C4':
                                  $value = $valueKriteria['kepemilikan_tanah'] ?? '';
                                  break;

                                  case 'C5':
                                  $value = $valueKriteria['penghasilan'] ?? '';
                                  break;

                                  case 'C6':
                                  $value = $valueKriteria['tanggungan'] ?? '';
                                  break;

                                  case 'C7':
                                  $value = $valueKriteria['usia'] ?? '';
                                  break;

                                  case 'C8':
                                  $value = $valueKriteria['pekerjaan'] ?? '';
                                  break;

                                  default:
                                  $value = '';
                                }
                                ?>
                                <!-- Radio Button -->
                                <div class="mb-3">
                                  <div class="form-check mb-2">
                                    <input
                                    class="form-check-input"
                                    type="radio"
                                    name="<?= esc($k['kode_kriteria']) ?>"
                                    id="<?= $n['kategori'] ?>"
                                    value="<?= esc($n['kategori']) ?>"  <?= ($value == $n['kategori']) ? 'checked' : ''; ?>>

                                    <label class="form-check-label" for="kriteria1_1">
                                      <strong>Skor <?= esc($n['skor']); ?>-<?= esc($n['kategori']); ?></strong>
                                      <br>
                                      <small class="text-muted">
                                        <?= esc($n['keterangan']); ?>
                                      </small>
                                    </label>
                                  </div>
                                </div>
                              <?php endforeach; ?>
                              <small class="text-muted">
                                Pilih kondisi yang paling sesuai.
                              </small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-md-12 mb-8">
                  <div class="card h-100 border-primary">
                    <div class="card-header">
                      <label class="form-label fw-bold">
                        Label Kelayakan <span class="text-danger">*</span>
                      </label>
                    </div>
                    <?php $labelAktual = $valueKriteria['label_aktual'] ?? ''; ?>
                    <div class="card-body">
                      <select class="form-select" name="label" required>

                        <option value="" <?= $labelAktual == '' ? 'selected' : ''; ?>>
                          -- Pilih Label --
                        </option>
                        <option value="Layak"
                        <?= $labelAktual == 'Layak' ? 'selected' : ''; ?>>
                        Layak Menerima BLT-DD
                      </option>

                      <option value="Tidak Layak"
                      <?= $labelAktual == 'Tidak Layak' ? 'selected' : ''; ?>>
                      Tidak Layak Menerima BLT-DD
                    </option>

                  </select>

                  <small class="text-muted">
                    Label digunakan sebagai kelas pada proses pelatihan
                    algoritma Naive Bayes.
                  </small>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="col-md-12 mb-8">
                <div class="d-flex justify-content-between">
                  <a href="<?= base_url('calonTraining') ?>"
                   class="btn btn-secondary">
                   <i class="bi bi-arrow-left"></i>

                   Kembali

                 </a>

                 <button type="submit"
                 class="btn btn-success">

                 <i class="bi bi-save"></i>

                 Simpan Data Testing

               </button>

             </div>
           </div>
         </div>
       </form>
     </div>
   </div>
 </div>
 <div class="card">
 </div>
</div>
</div>
</div>
</div>
<script>

  const params = new URLSearchParams(window.location.search);
  const no_kk = params.get("no_kk");
  $(document).ready(function() {
    $("#cekKK").click(function () {

      let no_kk = $("#no_kk").val().trim();

      if (no_kk == "") {
        alert("Masukkan Nomor KK terlebih dahulu.");
        return;
      }

      window.location.href =
      "<?= base_url('tambahtraining') ?>?no_kk=" + encodeURIComponent(no_kk);

    });

    $("#resetKK").click(function () {

      window.location.href =
      "<?= base_url('detailanggota') ?>";

    })


    if (no_kk) {

        // Isi textbox pencarian
      $("#no_kk").val(no_kk);

      $.ajax({
        url: "<?= base_url('detailanggota/cekKK') ?>",
        type: "POST",
        dataType: "json",
        data: {
          no_kk: no_kk
        },

        success: function (res) {

          if (res.status) {

            $("#formKKReadOnly").slideDown();

            $("#info_no_kk").text(res.keluarga.no_kk);

            $("#info_wilayah").html(
              res.keluarga.alamat +
              "<br>" +
              res.keluarga.dusun +
              " / RW " + res.keluarga.rw +
              " / RT " + res.keluarga.rt
              );

            $("#info_jumlah_anggota").text(res.keluarga.jumlah_anggota);
            $("#info_kepala_keluarga").text(res.kepala.nama);

          } else {

            $("#formKKReadOnly").hide();
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: res.message
            });

          }

        },

        error: function (xhr, status, error) {

          console.error(xhr.responseText);
          alert("Terjadi kesalahan pada server.");

        }

      });

    }

  });


  document.addEventListener("DOMContentLoaded", function () {

    const tabs = document.querySelectorAll("#kriteriaTab .nav-link");

    tabs.forEach(tab => {

      tab.addEventListener("shown.bs.tab", function () {

        tabs.forEach(btn => {

          btn.classList.remove(
            "bg-success",
            "text-white"
            );

          btn.classList.add(
            "bg-light",
            "text-secondary",
            "border"
            );

        });

        this.classList.remove(
          "bg-light",
          "text-secondary",
          "border"
          );

        this.classList.add(
          "bg-success",
          "text-white"
          );

      });

    });

  });

  document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formTraining");

    form.addEventListener("submit", function (e) {

      const panes = document.querySelectorAll(".tab-pane");

      for (let pane of panes) {

        const radios = pane.querySelectorAll("input[type=radio]");

        if (radios.length === 0) continue;

        const name = radios[0].name;

        if (!document.querySelector("input[name='" + name + "']:checked")) {

          e.preventDefault();

          const btn = document.querySelector(
            '[data-bs-target="#' + pane.id + '"]'
            );

          new bootstrap.Tab(btn).show();

          const namaTab = btn.textContent.trim();

          Swal.fire({
            icon: "warning",
            title: "Data Belum Lengkap",
            text: "Silakan lengkapi: " + namaTab
          });

          return;
        }
      }

    });

  });
</script>
</main>
<?= view('dashboard/footer_view'); ?>