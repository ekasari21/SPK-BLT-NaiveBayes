<?= view('dashboard/header_view'); ?>
<?php $disableTombolTambah = empty($kepala); 
$cekKepalaKeluarga =empty($kepala);
$cekDataKeluarga= empty($anggotaKeluarga);
$statusadd = service('request')->getGet('Add');

?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div id="alertBox"></div>
  <div class="app-wrapper">

    <?= view('dashboard/sidebar_view'); ?>

    <main class="app-main">


      <div class="app-content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
             <!-- <button class="btn btn-primary" id="btnTambahPenduduk">
              <i class="bi bi-database-up"></i>Tambah Penduduk
            </button> -->
            <div class="card shadow">
              <div class="card-header bg-success text-white">
                <h4>
                 <i class="bi bi-house-door-fill"></i>
                 Informasi Keluarga
               </h4>
             </div>
           </div>
         </div>          
         <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">

              <tr>
                <th width="25%">Nomor KK</th>
                <td><?= $keluarga['no_kk']; ?></td>
              </tr>
              <tr>
                <th>Wilayah</th>
                <td>
                  <?= $keluarga['dusun']; ?> / <?= $keluarga['rw']; ?> / <?= $keluarga['rt']; ?>

                </td>
              </tr>
              <tr>
                <th>Jumlah Anggota</th>
                <td>
                  <?= $keluarga['jumlah_anggota']; ?> Orang
                </td>
              </tr>
            </table>
          </div><!-- div card -->
          <div class="d-flex align-items-center my-2 text-secondary small">
            <i class="bi bi-info-circle-fill text-info me-2"></i>
            <span>Jika ingin merubah kepala keluarga, lakukan penghapusan data kepala keluarga terlebih dahulu dengan klik tombol <kbd class="bg-danger text-white px-1.5 py-0.5 rounded small" style="font-size: 0.75rem;">Hapus</kbd> untuk menghapus.</span>
          </div>
          <hr>
          <?php if ($cekKepalaKeluarga){ ?>
            <?= view('penduduk/formAddKepalaKK'); ?>
          <?php } ?>
          <!-- ================= DATA ANGGOTA ================= -->
          <?php
          if (!$cekDataKeluarga) 
            { ?>
              <div class="row">
                <div class="col-6">
                  <div class="card shadow-sm border-success h-100">
                    <div class="card-header bg-success text-white ">
                      <div class="d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">
                          <i class="bi bi-people-fill me-1"></i>
                          Data Anggota Keluarga
                        </h5>

                      </div>
                      <?= $disableTombolTambah ? '<i><span class="text-light">Form Tambah Anggota belum aktif, silahkan isi Kepala Keluarga Terlebih Dahulu</span> </i>' : ''; ?>

                    </div>
                    <div class="card-body">
                      <?= view('penduduk/formAddAnggotaKK'); ?>
                    </div>

                  </div>
                </div>
                <div class="col-6">
                  <div class="table-responsive">
                   <table class="table table-bordered table-striped table-hover" id="tabelKeluarga">

                    <thead class="table-success">
                      <tr>
                        <th colspan="10">
                          <h5> Detail Anggota Keluarga</h5>
                        </th>
                      </tr>
                      <tr>

                        <th width="5%">No</th>

                        <th>NIK</th>

                        <th>Nama</th>

                        <th>Hubungan</th>

                        <th>Jenis Kelamin</th>

                        <th>Tanggal Lahir</th>

                        <th>Pekerjaan</th>

                        <th>Pendidikan</th>

                        <th>Penghasilan</th>

                        <th width="12%">Aksi</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 
                      $no=1;
                      foreach($anggotaKeluarga as $a): ?>

                        <tr>

                          <td><?= $no++; ?></td>

                          <td><?= esc($a['nik']); ?></td>

                          <td><?= esc($a['nama']); ?></td>

                          <td><?= esc($a['hubungan_keluarga']); ?></td>

                          <td>

                            <?= $a['jenis_kelamin']=='L'
                            ? 'Laki-laki'
                            : 'Perempuan'; ?>

                          </td>

                          <td>

                            <?= date('d-m-Y',
                            strtotime($a['tanggal_lahir'])); ?>

                          </td>

                          <td><?= esc($a['nama_pekerjaan']); ?></td>

                          <td><?= esc($a['pendidikan']); ?></td>

                          <td class="text-end">

                            Rp <?= number_format(
                              $a['penghasilan_pribadi'],
                              0,
                              ',',
                              '.'
                            ); ?>

                          </td>

                          <td class="text-center">
                          <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="<?= $a['id_anggota']; ?>" data-nama="<?= "NIK : ".esc($a['nik'])." Nama :".esc($a['nama']); ?>">
                                <i class="bi bi-trash"></i>
                          </button>
                        </td>

                      </tr>

                    <?php endforeach; ?>
                  </tbody>

                </table>

              </div>   
            </div>
          </div>     

        <?php } ?>

      </div>

    </div><!-- div container fluid -->
  </div><!-- div app-content-->
</div>
</div>
</main>
<!-- ================= MODAL HAPUS ================= -->
<div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-trash"></i>
                    Hapus Anggota Keluarga
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="delete_id">

                <p>Apakah Anda yakin ingin menghapus anggota keluarga berikut?</p>

                <div class="alert alert-warning">
                    <strong id="delete_nama"></strong>
                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="button"
                        class="btn btn-danger"
                        id="btnHapus">
                    Ya, Hapus
                </button>

            </div>

        </div>
    </div>
</div>
<script>

  $('#btnSimpanKepala').click(function(e){

    e.preventDefault();

    let form = $('#formKepala');

    if(form[0].checkValidity() === false){
      form[0].reportValidity();
      return;
    }

    // Simpan tampilan asli
    let penghasilanFormat = $('#penghasilan').val();

    // Hilangkan titik sebelum dikirim
    $('#penghasilan').val(
      penghasilanFormat.replace(/\./g,'')
      );

    $.ajax({

      url:"<?= base_url('detailanggota/simpanKepalaKeluarga') ?>",

      type:"POST",

      data:form.serialize(),

      dataType:"json",

      beforeSend:function(){

        $('#btnSimpanKepala')
        .prop('disabled',true)
        .html('<i class="bi bi-hourglass"></i> Menyimpan...');

      },

      success:function(res){

        if(res.status=="success"){

          Swal.fire({

            icon:'success',

            title:'Berhasil',

            text:res.message,

            timer:1500,

            showConfirmButton:false

          }).then(()=>{

            location.reload();

          });

        }else{

                // kembalikan format rupiah
          $('#penghasilan').val(penghasilanFormat);

          Swal.fire({

            icon:'error',

            title:'Gagal',

            text:res.message

          });

        }

      },

      error:function(xhr){

            // kembalikan format rupiah
        $('#penghasilan').val(penghasilanFormat);

        console.log(xhr.responseText);

        Swal.fire({

          icon:'error',

          title:'Error',

          text:'Terjadi kesalahan pada server.'

        });

      },

      complete:function(){

        $('#btnSimpanKepala')
        .prop('disabled',false)
        .html('<i class="bi bi-save"></i> Simpan Data Kepala Keluarga');

      }

    });

  });

  //Atur Mata Uang Rupiah pada form
  const penghasilan = document.getElementById('penghasilan');

  penghasilan.addEventListener('input', function () {

    let angka = this.value.replace(/\D/g, '');

    this.value = angka
    ? new Intl.NumberFormat('id-ID').format(angka)
    : '';
  });

  document.querySelector('form').addEventListener('submit', function () {

    // ubah menjadi angka murni tanpa titik
    penghasilan.value = penghasilan.value.replace(/\./g, '');

  });

  <?php if(session()->getFlashdata('success')) : ?>

  Swal.fire({
    icon:'success',
    title:'Berhasil',
    text:'<?= session()->getFlashdata('success'); ?>'
  });

<?php endif; ?>
$(document).on("click", ".btnDelete", function () {

    let id = $(this).data("id");
    let nama = $(this).data("nama");

    $("#delete_id").val(id);
    $("#delete_nama").text(nama);

    $("#modalDelete").modal("show");

});

$("#btnHapus").click(function(){

    let id = $("#delete_id").val();

    $.ajax({

        url : "<?= site_url('DetailAnggota/hapusAnggota'); ?>/" + id,
        type : "POST",
        dataType : "json",

        success:function(res){

            if(res.status){

                $("#modalDelete").modal("hide");

                Swal.fire({
                    icon:'success',
                    title:'Berhasil',
                    text:res.message
                }).then(function(){

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

});


</script>
</div>
<?= view('dashboard/footer_view'); ?>

