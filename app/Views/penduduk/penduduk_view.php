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
              <h3>Data Detail Anggota Keluarga</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
             <!-- <button class="btn btn-primary" id="btnTambahPenduduk">
              <i class="bi bi-database-up"></i>Tambah Penduduk
            </button> -->

            <div class="card shadow">

              <form id="formPenduduk">

                <div class="card-body">

                 <!-- ================================================= -->
                 <!-- PENCARIAN KK -->
                 <!-- ================================================= -->

                 <div class="card shadow-sm mb-3">

                  <div class="card-header bg-light fw-bold">
                    <i class="bi bi-search"></i>
                    Pencarian Data Detail Anggota Keluarga
                  </div>

                  <div class="card-body">

                    <div class="row align-items-end">
                      <div class="col-8">
                       <label class="form-label fw-bold">
                        Nomor Kartu Keluarga
                      </label>

                      <input type="text"
                      id="no_kk"
                      name="no_kk"
                      class="form-control input-cekNoKK"
                      maxlength="16"
                      placeholder="Masukkan Nomor KK">
                    </div>
                    <div class="col-4">
                      <button type="button"
                      class="btn btn-primary"
                      id="cekKK">

                      <i class="bi bi-search"></i>

                      Cek KK

                    </button>
                    <button type="button"
                    class="btn btn-secondary"
                    id="resetKK">

                    <i class="bi bi-arrow-clockwise"></i>

                    Reset

                  </button>
                </div>
                <div class="col-12">
                  <small class="text-muted">
                    Masukkan Nomor KK terlebih dahulu.
                  </small>
                </div>
              </div>
            </div>
          </div>
        </form>
        <!--Form Informasi KK Read Only -->
        <div class="card shadow-sm mb-4" id="formKKReadOnly" style="display:none;">
          <div class="card-header bg-success text-white">
            <i class="bi bi-house-door-fill"></i>
            Informasi Keluarga
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped align-middle mb-0">
              <tbody>
                <tr>
                  <th width="30%" class="bg-light">
                    Nomor Kartu Keluarga
                  </th>
                  <td id="info_no_kk">-</td>
                </tr>
                <th class="bg-light">
                  Alamat <br>Dusun / RW / RT
                </th>
                <td id="info_wilayah">-</td>
              </tr>
              <tr>
                <th class="bg-light">
                  Jumlah Anggota
                </th>
                <td id="info_jumlah_anggota">-</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <button type="button" id="btnTambahAnggota" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Anggota Keluarga
          </button>
        </div>
      </div><!-- Card Data Penduduk -->
    </div>

  </div>
</div> 

<div class="card-body">
  <div class="table-responsive">
    <table id="tabelDetailKeluarga" class="table table-bordered table-striped" width="100%">
      <form>
        <thead>
          <tr>
            <th>No</th>
            <th>Nomor KK</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>Jenis Kelamin</th>
            <th>tanggal_lahir</th>
            <th>hubungan_keluarga</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>Pendidikan</th>
            <th>Action</th>
          </tr>
        </thead>

      </form>
    </table>
  </div>
</div> <!-- div card body-->
</div><!-- div card -->
</div><!-- div container fluid -->
</div><!-- div app-content-->

<!---- MODAL EDIT ----->
<div class="modal fade" id="modalEditAnggota" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">
          Edit Anggota Keluarga
        </h5>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditAnggota">
        <div class="modal-body">
          <input type="hidden" name="id_anggota" id="edit_id">
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" id="edit_nama">
          </div>
          <div class="mb-3">
            <label>NIK</label>
            <input type="text" class="form-control" name="nik" id="edit_nik" maxlength="16">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">
              Jenis Kelamin 
            </label>

            <select name="jenis_kelamin" class="form-select"  name="jk"
            id="edit_jk">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <?php foreach ($jenisKelamin as $jk): ?>
              <option value="<?= $jk; ?>">
                <?= ($jk == 'L') ? 'Laki-Laki' : 'Perempuan'; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Tanggal Lahir</label>
          <input type="date" class="form-control" name="tanggal_lahir" id="edit_tgl_lahir">
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            Hubungan Keluarga
          </label>

          <select name="hubungan_keluarga" class="form-select"  name="jk"
          id="edit_hub_keluarga">
          <option value="">-- Pilih Hubungan Keluarga  --</option>
          <?php foreach ($hubungan as $h): ?>
            <option value="<?= $h; ?>">
              <?= esc($h); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label>Pekerjaan</label>
        <select name="id_pekerjaan" class="form-select" id="edit_pekerjaan">
          <option value="">-- Pilih Pekerjaan --</option>
          <?php foreach($pekerjaan as $p): ?>

            <option value="<?= $p['id_pekerjaan']; ?>">
              <?= esc($p['nama_pekerjaan']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label>Penghasilan</label>
        <input type="text" id="edit_penghasilan" name="penghasilan" class="form-control">
      </div>
      <div class="mb-3">
        <label>
          Pendidikan Terakhir
        </label>

        <?php $selected = $kepala['pendidikan'] ?? ''; ?>

        <select name="pendidikan" class="form-select" required id="edit_pendidikan">
          <option value="">-- Pilih Pendidikan --</option>

          <?php foreach ($pendidikan as $p): ?>
            <option value="<?= esc($p); ?>"
              <?= ($p == $selected) ? 'selected' : ''; ?>>
              <?= esc($p); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary"
      data-bs-dismiss="modal"
      type="button">
      Batal
    </button>
    <button class="btn btn-primary" type="submit">
      Simpan Perubahan
    </button>
  </div>
</form>
</div>
</div>
</div>


<!--- Modal Hapus -->

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
  $(document).ready(function() {

    const params = new URLSearchParams(window.location.search);
    const no_kk = params.get("no_kk");
    let table = $('#tabelDetailKeluarga').DataTable({
      processing: true,
      destroy: true,
      ajax: {
        url: "<?= base_url('detailanggota/getdata') ?>",
        type: "GET",
        data: function (d) {
          if (no_kk) {
            d.no_kk = no_kk;
          }
        }
      },
      columns: [
        { data: 'no' },
        { data: 'no_kk' },
        { data: 'nik' },
        { data: 'nama' },
        { data: 'jenis_kelamin' },
        { data: 'tanggal_lahir' },
        { data: 'hubungan_keluarga' },
        { data: 'nama_pekerjaan' },
        { data: 'penghasilan_pribadi' },
        { data: 'pendidikan' },
        {
          data: null,
          orderable: false,
          render: function (data) {
            return `
                       <button class="btn btn-info btn-sm btn-edit" data-id="${data.id_anggota}" title="Edit Anggota Keluarga">
                            <i class="bi bi-pencil-square"></i> 
                        </button>
                    <button type="button" class="btn btn-danger btn-sm btnDelete" data-id="${data.id_anggota}" data-nama="NIK : ${data.nik} Nama : ${data.nama}">
                              <i class="bi bi-trash"></i>
                    </button>
            `;
          }
        }
      ]
    });

    $('#btnTambahPenduduk').click(function(){
      $('#modalPenduduk').modal('show');
    });


      // mengatur format form input rupiah
    function formatRupiah(angka){
      let number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   = number_string.split(','),
      sisa    = split[0].length % 3,
      rupiah  = split[0].substr(0, sisa),
      ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

      if(ribuan){
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      return rupiah ? 'Rp ' + rupiah : '';
    }

    $('#rupiah').on('keyup', function(){

      let value = $(this).val();

    // tampilkan format Rp
      $(this).val(formatRupiah(value));

    // simpan angka asli ke hidden input
      let angka = value.replace(/[^0-9]/g, '');
      $('#penghasilan').val(angka);
    });


    $("#cekKK").click(function () {

      let no_kk = $("#no_kk").val().trim();

      if (no_kk == "") {
        alert("Masukkan Nomor KK terlebih dahulu.");
        return;
      }

      window.location.href =
      "<?= base_url('detailanggota') ?>?no_kk=" + encodeURIComponent(no_kk);

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
              res.keluarga.alamat + "<br>" +
              res.keluarga.dusun +
              " / RW " + res.keluarga.rw +
              " / RT " + res.keluarga.rt
              );

            $("#info_jumlah_anggota").text(res.keluarga.jumlah_anggota);

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


    $(document).on('click', '.btn-edit', function () {

      let id = $(this).data('id');

      $.ajax({

        url: "<?= base_url('detailanggota/edit') ?>/" + id,
        type: "GET",
        dataType: "json",

        success: function(res){

          if(res.status){

            $('#edit_id').val(res.data.id_anggota);
            $('#edit_nama').val(res.data.nama);
            $('#edit_nik').val(res.data.nik);
            $('#edit_jk').val(res.data.jenis_kelamin);
            $('#edit_tgl_lahir').val(res.data.tanggal_lahir);
            $('#edit_hub_keluarga').val(res.data.hubungan_keluarga);
            $('#edit_pekerjaan').val(res.data.id_pekerjaan);
            $("#edit_penghasilan").val(formatRupiah(res.data.penghasilan_pribadi.toString()));
            $('#edit_pendidikan').val(res.data.pendidikan);

            $('#modalEditAnggota').modal('show');

          }else{

            Swal.fire({
              icon:'error',
              title:'Gagal',
              text:res.message
            });

          }

        }

      });

    });

    function formatRupiah(angka) {
      angka = angka.replace(/\D/g, '');

      return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#edit_penghasilan").on("input", function () {
      $(this).val(formatRupiah($(this).val()));
    });


    $('#formEditAnggota').submit(function(e){

      e.preventDefault();

    // Hilangkan titik ribuan
      let penghasilan = $("#edit_penghasilan").val().replace(/\./g,'');
      $("#edit_penghasilan").val(penghasilan);

      $.ajax({

        url : "<?= site_url('detailanggota/update') ?>",
        type : "POST",
        data : $(this).serialize(),
        dataType : "json",

        success:function(res){

          if(res.status){

            $("#modalEditAnggota").modal("hide");

            Swal.fire({
              icon:'success',
              title:'Berhasil',
              text:res.message
            }).then(()=>{
              location.reload();
            });

          }else{

            Swal.fire({
              icon:'error',
              title:'Gagal',
              html:res.message
            });

          }

        }

      });

    });

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


    $('#btnTambahAnggota').click(function () {

      const params = new URLSearchParams(window.location.search);
      const no_kk = params.get('no_kk');

      if (no_kk) {
        window.location.href = "<?= base_url('tambahanggota') ?>?no_kk=" + encodeURIComponent(no_kk);
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Peringatan',
          text: 'Nomor KK tidak ditemukan pada URL.'
        });
      }

    });

  });
</script>
</main>
</div>
<?= view('dashboard/footer_view'); ?>