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
              <h3>Hasil Klasifikasi</h3>
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
                    <h2 class="fw-bold mb-0"><?= $jmlKlasifikasiLayak; ?></h2>
                    <h6 class="mb-1">Jumlah Kelas Layak</h6>
                    <small class="text-muted">
                      Hasil Klasifikasi Kelas Layak
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
                  <h2 class="fw-bold mb-0"><?= $jmlKlasifiasiTidakLayak; ?></h2>
                  <h6 class="mb-1">Jumlah Kelas Tidak Layak</h6>
                  <small class="text-muted">
                    Hasil Klasifikasi Kelas Tidak Layak
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
         <?php if(session()->get('role') == 'admin') : ?>
         <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="d-flex justify-content-end">
                <!-- <button id="btnTambah" class="btn btn-primary"> -->
                  <button type="button" id="btnGenerate" class="btn btn-success">
                    <i class="bi bi-gear"></i>
                    Generate Hasil Klasifikasi
                  </button>
                  <button type="button" id="btnResetGenerate" class="btn btn-warning">
                    <i class="bi bi-x-circle"></i>
                    Reset Hasil Klasifikasi
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if(session()->get('role') == 'kepala_desa') : ?>
        <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="d-flex justify-content-end">
                <!-- <button id="btnTambah" class="btn btn-primary"> -->
                  <button type="button"
                  id="btnSetujuiMasal"
                  class="btn btn-success"
                  onclick="window.location.href='<?= base_url('setujuiMasal') ?>'">
                   <i class="bi bi-check-circle-fill"></i>
                  Setujui Masal
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="card-body">
       <?php if(session()->get('role') == 'admin') : ?>
       <div class="alert alert-info mb-3">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Petunjuk:</strong> Jika ingin memperbaharui hasil klasifikasi, silahkan klik tombol <b>Generate Hasil Klasifikasi</b>
      </div>
    <?php endif; ?>
    <div class="table-responsive">
      <table id="tabelHasilKlasifikasi" class="table table-bordered table-striped">
        <form>
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor KK</th>
              <th>Nama Kepala Keluarga</th>
              <th>Kriteria</th>
              <th>Posterior Layak</th>
              <th>Posterior Tidak Layak</th>
              <th>Label Hasil</th>
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
  <?php if(session()->get('role') == 'admin'): ?>

        let urlHasil = "<?= base_url('getHasilKlasifikasiAdmin') ?>";

    <?php elseif(session()->get('role') == 'kepala_desa'): ?>

        let urlHasil = "<?= base_url('getHasilKlasifikasi') ?>";

    <?php endif; ?>
  $(document).ready(function () {
   const userRole = "<?= session()->get('role') ?>";
   $('#tabelHasilKlasifikasi').DataTable({
    processing: true,
    destroy: true,
    responsive: true,
    autoWidth: false,

    ajax: {
      url:  urlHasil,
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
        data: "kriteria",
        render: function (data) {

          return data == "" || data == null ? "-" : data;
        }
      },
      {
        data: "probabilitas_layak"
      },
      {
        data: "probabilitas_tidak_layak"
      },
      {
        data: "hasil"
      },

      {
        data: null,
        className: "text-center",
        render: function (data) {

          let tombol = '';

          if (userRole === 'admin') {

            tombol += `
                <button class="btn btn-warning btn-sm btnHapus"
                    data-id="${data.id_hasil}">
                    <i class="bi bi-trash"></i> Hapus Hasil
                </button>
            `;

          } else if (userRole === 'kepala_desa' && data.hasil =='Layak' ) {
            if(data.persetujuan.id_persetujuan == null){

              tombol += `
                <button class="btn btn-success btn-sm btnSetujui"
                    data-id="${data.id_hasil}">
                    <i class="bi bi-check-circle-fill"></i> Setujui Bantuan 
                </button>

              <button class="btn btn-danger btn-sm btnTolak" data-id="${data.id_hasil}">
                        <i class="bi bi-x-circle-fill"></i> Tolak Bantuan
              </button>
              `;
            }else{
              if(data.persetujuan.status == 'Disetujui'){
                tombol += `
              <button class="btn btn-warning btn-sm btnTolak"
                    data-id="${data.id_hasil}">
                    <i class="bi-x-circle-fill"></i> Batalkan Persetujuan  
                </button>
                `;
              }else{
                tombol += `
                  
                   <button class="btn btn-success btn-sm btnSetujui"
                    data-id="${data.id_hasil}">
                    <i class="bi bi-check-circle-fill"></i> Setujui Bantuan 
                </button>
                `;
              }
            }

          }

          return tombol;
        }
      }
    ]
  });

   $("#btnGenerate").click(function () {

    Swal.fire({
      title: 'Generate Hasil Klasifikasi?',
      text: 'Proses ini akan menghitung seluruh data testing menggunakan Naive Bayes.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, Generate',
      cancelButtonText: 'Batal'
    }).then((result) => {

      if (result.isConfirmed) {

        $.ajax({

          url: "<?= base_url('HasilPrediksi/HitungHasilKlasifikasi') ?>",
          type: "POST",
          dataType: "json",

          beforeSend: function () {

            $("#btnGenerate")
            .prop("disabled", true)
            .html('<span class="spinner-border spinner-border-sm"></span> Memproses...');

          },

          success: function (response) {

            if (response.status) {

              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message
              }).then(() => {
                location.reload();
              });

            } else {

              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: response.message
              });

            }

          },

          error: function () {

            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Terjadi kesalahan pada server.'
            });

          },

          complete: function () {

            $("#btnGenerate")
            .prop("disabled", false)
            .html('<i class="bi bi-gear"></i> Generate Hasil Klasifikasi');

          }

        });

      }

    });

  });

   $(document).on("click", ".btnHapus", function(){

    let id = $(this).data("id");

    Swal.fire({
      title: 'Hapus Hasil?',
      text: 'Data hasil klasifikasi akan dihapus.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result)=>{

      if(result.isConfirmed){

        $.ajax({

          url: "<?= base_url('result/hapusHasilPrediksi') ?>",
          type: "POST",
          data: {
            id_hasil:id
          },
          dataType:"JSON",

          success:function(res){

            if(res.status){

              Swal.fire({
                icon:'success',
                title:'Berhasil',
                text:res.message,
                timer:1500,
                showConfirmButton:false
              });

              $('#tabelHasilKlasifikasi').DataTable().ajax.reload(null,false);

            }else{

              Swal.fire({
                icon:'error',
                title:'Gagal',
                text:res.message
              });

            }

          }

        });

      }

    });

  });

   $("#btnResetGenerate").click(function () {

    Swal.fire({
      title: "Reset Hasil Klasifikasi?",
      text: "Seluruh hasil klasifikasi akan dihapus, kecuali yang sudah dilakukan persetujuan. Tindakan ini tidak dapat dibatalkan.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Ya, Reset",
      cancelButtonText: "Batal"

    }).then((result) => {

      if (result.isConfirmed) {

        $.ajax({

          url: "<?= base_url('result/resetHasilKlasifikasi') ?>",
          type: "POST",
          dataType: "JSON",

          beforeSend: function () {

            Swal.fire({
              title: "Memproses...",
              text: "Sedang menghapus seluruh hasil klasifikasi.",
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });

          },

          success: function (response) {

            Swal.close();

            if (response.status) {

              Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: response.message,
                timer: 1800,
                showConfirmButton: false
              }).then(() => {
                location.reload();
              });

              $('#tabelHasilKlasifikasi')
              .DataTable()
              .ajax.reload(null, false);

            } else {

              Swal.fire({
                icon: "error",
                title: "Gagal",
                text: response.message
              });

            }

          },

          error: function () {

            Swal.close();

            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Terjadi kesalahan pada server."
            });

          }

        });

      }

    });

  });


   $(document).on("click", ".btnSetujui", function () {

    let id = $(this).data("id");

    Swal.fire({
      title: "Setujui Bantuan?",
      text: "Penerima akan ditetapkan sebagai penerima bantuan.",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#198754",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Ya, Setujui",
      cancelButtonText: "Batal"
    }).then((result) => {

      if(result.isConfirmed){

        $.ajax({

          url : "<?= base_url('persetujuan/setujui') ?>",
          type : "POST",
          data : {
            id_hasil : id
          },
          dataType : "json",

          success:function(res){

            if(res.status){

              Swal.fire({
                icon:'success',
                title:'Berhasil',
                text:res.message,
                timer:1500,
                showConfirmButton:false
              }).then(() => {
                location.reload();
              });

            }else{

              Swal.fire({
                icon:'error',
                title:'Gagal',
                text:res.message
              });

            }

          },

          error:function(){

            Swal.fire({
              icon:'error',
              title:'Error',
              text:'Terjadi kesalahan pada server.'
            });

          }

        });

      }

    });

  });

   $(document).on("click", ".btnTolak", function () {

    let id = $(this).data("id");

    Swal.fire({
      title: "Tolak Bantuan",
      input: "textarea",
      inputLabel: "Alasan Penolakan",
      inputPlaceholder: "Masukkan alasan penolakan...",
      inputAttributes: {
        maxlength: 255
      },
      inputValidator: (value) => {
        if (!value) {
          return "Alasan penolakan wajib diisi!";
        }
      },
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Tolak",
      cancelButtonText: "Batal",
      confirmButtonColor: "#dc3545"
    }).then((result) => {

      if(result.isConfirmed){

        $.ajax({

          url: "<?= base_url('persetujuan/tolak') ?>",
          type: "POST",
          dataType: "json",
          data: {
            id_hasil: id,
            catatan: result.value
          },

          success:function(response){

            if(response.status){

              Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: response.message,
                timer:1500,
                showConfirmButton:false
              }).then(() => {
                location.reload();
              });

            }else{

              Swal.fire({
                icon: "error",
                title: "Gagal",
                text: response.message
              });

            }

          },

          error:function(){

            Swal.fire({
              icon:"error",
              title:"Error",
              text:"Terjadi kesalahan pada server."
            });

          }

        });

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