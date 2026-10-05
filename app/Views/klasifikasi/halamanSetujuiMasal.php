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
              <h3>Daftar Calon Layak Menerima Bantuan</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">
          <div class="card">
           <div class="card-header">
            <div class="row">
              <div class="col">
                <div class="d-flex justify-content-end">
                  <a href="<?= base_url('hasilKlasifikasi'); ?>">
                    <!-- <button id="btnTambah" class="btn btn-primary"> -->
                      <button class="btn btn-secondary">
                        Kembali<i class="bi bi-arrow-left"></i>
                      </button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Petunjuk:</strong> klik check pada checkbox pada datatable yang akan dipilih.
              </div>
              <div class="table-responsive">
                <table id="tabelDataPersetujuan" class="table table-bordered table-striped">
                  <form>
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor KK</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Jumlah Anggota</th>
                        <th>Anggota Keluarga</th>
                        <th>Kriteria</th>
                        <th>Status</th>
                        <th>aksi</th>
                      </tr>
                    </thead>
                  </form>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <div class="card shadow-sm border-0 mt-4">

                <div class="card-body">

                  <div class="text-end">

                    <button class="btn btn-secondary">

                      <i class="bi bi-x-circle"></i>

                      Batal

                    </button>

                    <button class="btn btn-success" id="btnSetujuiSemua">
                     <i class="bi bi-check2-all"></i>
                     Setujui Semua 
                   </button>

                 </div>

               </div>

             </div>
           </div>
         </div>
       </div>
     </div>
     <script>  

      $(document).ready(function () {
        

        $('#tabelDataPersetujuan').DataTable({
          processing: true,
          destroy: true,
          responsive: true,
          autoWidth: false,

          ajax: {
            url: "<?= base_url('getDataPersetujuan') ?>",
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
              data: "anggota_keluarga",
              render: function (data) {
                return data == null ? "-" : data;
              }
            },
            {
              data: null,
              render: function (data) {

                return `
                        <b>Kepemilikan Kendaraan</b> : ${data.kepemilikan_kendaraan}<br>
                        <b>Kepemilikan Rumah</b> : ${data.kepemilikan_rumah}<br>
                        <b>Kondisi Rumah</b> : ${data.kondisi_rumah}<br>
                        <b>Kepemilikan Tanah</b> : ${data.kepemilikan_tanah}<br>
                        <b>Penghasilan</b> : ${data.penghasilan}<br>
                        <b>Tanggungan</b> : ${data.tanggungan}<br>
                        <b>Usia</b> : ${data.usia}<br>
                        <b>Pekerjaan</b> : ${data.pekerjaan}
                `;
              }
            },
            {
              data: "hasil_persetujuan",
              className: "text-center",
              render: function (data) {

                if (data == "Disetujui") {
                  return '<span class="badge bg-success">Disetujui</span>';
                } else if (data == "Ditolak") {
                  return '<span class="badge bg-danger">Ditolak</span>';
                }

                return '<span class="badge bg-secondary">Belum Diproses</span>';
              }
            },
            {
              data: null,
              className: "text-center",
              orderable: false,
              render: function (data) {
                return `
            <input type="checkbox"
                   class="form-check-input chkPersetujuan"
                   value="${data.id_hasil}"
                   data-id="${data.id_hasil}">
                `;
              }
            }

          ]

        });

        $("#btnSetujuiSemua").click(function(){

          let idHasil = [];

          $(".chkPersetujuan:checked").each(function(){

            idHasil.push($(this).val());

          });

          if(idHasil.length==0){

            Swal.fire({
              icon:'warning',
              title:'Peringatan',
              text:'Pilih minimal satu data.'
            });

            return;

          }

          Swal.fire({

            title:'Setujui Semua?',
            text:'Data yang dipilih akan disetujui.',
            icon:'question',
            showCancelButton:true,
            confirmButtonText:'Ya',
            cancelButtonText:'Batal'

          }).then((result)=>{

            if(result.isConfirmed){

              $.ajax({

                url:"<?= base_url('persetujuan/setujuiMasal') ?>",
                type:"POST",
                dataType:"json",
                data:{
                  id_hasil:idHasil
                },

                success:function(res){

                  if(res.status){

                    Swal.fire({

                      icon:'success',
                      title:'Berhasil',
                      text:res.message

                    });

                    $("#checkAll").prop("checked",false);

                    $('#tabelDataPersetujuan').DataTable().ajax.reload(null,false);

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
                    text:'Terjadi kesalahan server.'
                  });

                }

              });

            }

          });

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