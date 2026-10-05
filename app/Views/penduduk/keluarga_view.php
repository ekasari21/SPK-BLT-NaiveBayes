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
              <h3>Data Keluarga</h3>
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
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKeluarga">
                    <i class="bi bi-plus"></i>
                  </button>
                </button>
              </div>
            </div>
          </div>
        </div>          
        <div class="card-body">
          <div class="table-responsive">
            <table id="tabelKeluarga" class="table table-bordered table-striped">
              <form>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor KK</th>
                    <th>Alamat</th>
                    <th>Wilayah</th>
                    <th>Anggota Keluarga</th>
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

  <!-- BATAS MODAL  -->
  <!-- ======================= MODAL TAMBAH KELUARGA ======================= -->
  <div class="modal fade" id="tambahKeluarga" tabindex="-1">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <form id="formKeluarga">

          <div class="modal-header bg-success text-white">

            <h5 class="modal-title">
              <i class="bi bi-person-plus-fill me-2"></i>
              Tambah Data Keluarga
            </h5>

            <button type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal">
          </button>

        </div>

        <div class="modal-body">

          <div class="row">

            <!-- Kolom Kiri -->
            <div class="col-md-6">

              <div class="mb-3">
                <label class="form-label fw-bold">
                  Nomor Kartu Keluarga
                </label>
                <input type="text"
                name="no_kk"
                class="form-control"
                maxlength="16" minlength="16" 
                placeholder="Masukkan Nomor KK"
                required>

                <small class="text-muted">
                  Nomor KK terdiri dari 16 digit.
                </small>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">
                  Jumlah Anggota Keluarga
                </label>

                <input type="number"
                name="jumlah_anggota"
                class="form-control"
                min="1"
                placeholder="Contoh : 4">
              </div>

            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">

              <div class="mb-3">
                <label class="form-label fw-bold">
                  Dusun
                </label>

                <select name="id_dusun"
                id="dusun"
                class="form-select"
                required>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">
                RW
              </label>

              <select name="id_rw"
              id="rw"
              class="form-select"
              required>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">
              RT
            </label>

            <select name="id_rt"
            id="rt"
            class="form-select"
            required>
          </select>
        </div>

      </div>

    </div>

    <div class="row">

      <div class="col-md-12">

        <div class="mb-3">

          <label class="form-label fw-bold">
            Alamat Lengkap
          </label>

          <textarea name="alamat"
          class="form-control"
          rows="3"
          placeholder="Masukkan alamat lengkap"></textarea>

        </div>

      </div>

    </div>

  </div>

  <div class="modal-footer">

    <button type="button"
    class="btn btn-secondary"
    data-bs-dismiss="modal">
    <i class="bi bi-x-circle"></i>
    Batal
  </button>

  <button type="submit"
  class="btn btn-success"
  id="simpanKeluarga">

  <i class="bi bi-save"></i>
  Simpan Data

</button>

</div>

</form>

</div>

</div>

</div>

<!-- ======================= MODAL EDIT KELUARGA ======================= -->
<div class="modal fade" id="modalKeluarga" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form id="formEdit" method="POST">

                <div class="modal-header bg-info text-dark">

                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Data Keluarga
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input type="hidden"
                           name="id_kk"
                           id="id_kk">

                    <div class="row">

                        <!-- Kolom Kiri -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Nomor Kartu Keluarga
                                </label>

                                <input type="text"
                                       name="no_kk"
                                       id="no_kk"
                                       class="form-control"
                                       maxlength="16"
                                       required>

                                <small class="text-muted">
                                    Nomor KK terdiri dari 16 digit.
                                </small>

                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Jumlah Anggota Keluarga
                                </label>

                                <input type="number"
                                       name="jumlah_anggota"
                                       id="jumlah_anggota"
                                       class="form-control"
                                       min="1"
                                       required>

                            </div>

                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Dusun
                                </label>

                                <select id="id_dusun"
                                        name="id_dusun"
                                        class="form-select"
                                        required>

                                </select>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label fw-bold">
                                            RW
                                        </label>

                                        <select id="id_rw"
                                                name="id_rw"
                                                class="form-select"
                                                required>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label fw-bold">
                                            RT
                                        </label>

                                        <select id="id_rt"
                                                name="id_rt"
                                                class="form-select"
                                                required>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Alamat Lengkap
                                </label>

                                <textarea name="alamat"
                                          id="alamat"
                                          rows="3"
                                          class="form-control"
                                          placeholder="Masukkan alamat lengkap"
                                          required></textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="bi bi-x-circle"></i>
                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-info text-dark">

                        <i class="bi bi-save"></i>
                        Update Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- ================= MODAL HAPUS ================= -->

<div class="modal fade" id="modalDeleteKeluarga">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-danger text-white">

        <h5 class="modal-title">
          <i class="bi bi-trash3-fill"></i>
          Hapus Data Keluarga
        </h5>

        <button class="btn-close btn-close-white"
        data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">

        <input type="hidden" id="delete_id_kk">

        <p>Apakah Anda yakin akan menghapus data berikut?</p>

        <table class="table table-bordered">

          <tr>
            <th width="35%">Nomor KK</th>
            <td id="delete_no_kk"></td>
          </tr>
        </table>

        <div class="alert alert-warning">

          Data yang telah dihapus tidak dapat dikembalikan.

        </div>

      </div>

      <div class="modal-footer">

        <button class="btn btn-secondary"
        data-bs-dismiss="modal">

        Batal

      </button>

      <button class="btn btn-danger"
      id="btnDeleteKeluarga">

      <i class="bi bi-trash3-fill"></i>

      Hapus

    </button>

  </div>

</div>

</div>

</div>

<div class="modal fade" id="modalDetailAnggota">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header bg-primary text-white">

        <h5 class="modal-title">

          <i class="bi bi-people-fill"></i>

          Detail Anggota Keluarga

        </h5>

        <button class="btn-close btn-close-white"
        data-bs-dismiss="modal">
      </button>

    </div>

    <div class="modal-body">

      <div class="row mb-3">

        <div class="col-md-4">

          <strong>No KK</strong>

          <div id="detail_no_kk"></div>

        </div>

        <div class="col-md-4">

          <strong>Jumlah Anggota</strong>

          <div id="detail_jumlah"></div>

        </div>

        <div class="col-md-4">

          <strong>Alamat</strong>

          <div id="detail_alamat"></div>

        </div>

      </div>

      <table class="table table-bordered table-striped">

        <thead class="table-success">

          <tr>

            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Tanggal Lahir</th>
            <th>Hubungan</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>Pendidikan</th>

          </tr>

        </thead>

        <tbody id="tbodyAnggota">

        </tbody>

      </table>

    </div>

  </div>

</div>

</div>
<script>
  $(document).ready(function () {
    let table = $('#tabelKeluarga').DataTable({
      processing: true,
      ajax: {
        url: "<?= base_url('keluarga/getData') ?>",
        type: "GET",
        dataSrc: function (json) {
                console.log(json); // 🔥 debug (wajib cek pertama kali)
                return json.data;
              }
            },
            columns: [
              {
                data: null,
                render: function (data, type, row, meta) {
                  return meta.row + 1;
                }
              },
              { data: 'no_kk' },
              { data: 'alamat' },
              {
                data: null,
                render: function (data) {
                  return `${data.nama_dusun} / RW ${data.nama_rw} / RT ${data.nama_rt}`;
                }
              },
              { data: 'jumlah_anggota' },
              {
                data: null,
                orderable: false,
                render: function (data) {
                  return `
              <a href="<?= base_url('tambahanggota') ?>?no_kk=${data.no_kk}"
               class="btn btn-success btn-sm text-white"
               style="text-decoration:none;"
               title="Tambah Detail Keluarga">
                Add Detail <i class="bi bi-person-plus"></i>
            </a>
                     <button class="btn btn-primary btn-sm btn-detail" title="Detail Anggota Keluarga">
                            <i class="bi bi-people-fill"></i>
                      </button>
                        <button class="btn btn-info btn-sm btn-edit" title="Edit Keluarga">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                      <button class="btn btn-warning btn-sm btn-delete"
                    title="Hapus Data Keluarga">
                <i class="bi bi-trash3-fill"></i>
            </button>
                  `;
                }
              }
            ]
          });

      // 🔹 load dusun
    $('#tambahKeluarga').on('shown.bs.modal', function () {
      $.get("<?= site_url('wilayah/getDusun') ?>", function(data){
        $('#dusun').html('<option value="">Pilih Dusun</option>');
        data.forEach(d => {
          $('#dusun').append(`<option value="${d.id_wilayah}">${d.nama_wilayah}</option>`);
        });
      });
    });

    // 🔹 dusun → rw
    $('#dusun').change(function(){
      let id = $(this).val();
      $.get("<?= site_url('wilayah/getRW') ?>/"+id, function(data){
        $('#rw').html('<option value="">Pilih RW</option>');
        data.forEach(d => {
          $('#rw').append(`<option value="${d.id_wilayah}">${d.nama_wilayah}</option>`);
        });
      });
    });

    // 🔹 rw → rt
    $('#rw').change(function(){
      let id = $(this).val();
      $.get("<?= site_url('wilayah/getRT') ?>/"+id, function(data){
        $('#rt').html('<option value="">Pilih RT</option>');
        data.forEach(d => {
          $('#rt').append(`<option value="${d.id_wilayah}">${d.nama_wilayah}</option>`);
        });
      });
    });

    // 🔥 SIMPAN DATA

    $(document).on('click', '#simpanKeluarga', function(e){
    e.preventDefault(); // 🔥 penting

    let form = $('#formKeluarga');

    // validasi sederhana (optional tapi bagus)
    if(form[0].checkValidity() === false){
      form[0].reportValidity();
      return;
    }

    let formData = form.serialize();

    $.ajax({
      url: "<?= base_url('keluarga/saveKeluarga?') ?>",
      type: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function(){
            $('#simpanKeluarga').prop('disabled', true); // 🔥 cegah klik 2x
          },
          success: function(res){
            console.log(res);

            if(res.status === 'success'){
              Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: res.message,
                timer: 1500,
                showConfirmButton: false
              }).then(function(){

            // menuju halaman tambah anggota keluarga
                window.location.href =
                "<?= base_url() ?>/tambahanggota?no_kk=" + res.no_kk;

              });

                $('#formKeluarga')[0].reset(); // 🔥 reset form
                $('#tambahKeluarga').modal('hide');

                // reload datatable
                $('#tabelKeluarga').DataTable().ajax.reload(null, false);

              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal!',
                  text: res.message
                });
              }
            },
            error: function(xhr){
              console.log(xhr.responseText);

              Swal.fire({
                icon: 'error',
                title: 'Error Server',
                text: 'Terjadi kesalahan di server!'
              });
            },
            complete: function(){
              $('#simpanKeluarga').prop('disabled', false);
            }
          });
  });


    function loadDusun(selected = null, callback = null){
      $.get("<?= base_url('wilayah/getDusun') ?>", function(data){

        let html = '<option value="">Pilih Dusun</option>';
        data.forEach(d => {
          html += `<option value="${d.id_wilayah}">${d.nama_wilayah}</option>`;
        });

        $('#id_dusun').html(html);

        if(selected) $('#id_dusun').val(selected);

        if(callback) callback();
      });
    }

    function loadRw(id_dusun, selected = null, callback = null){

      if(!id_dusun){
        console.log("ID DUSUN KOSONG!");
        return;
      }

      $.get("<?= base_url('wilayah/getRw') ?>/" + id_dusun, function(data){

        console.log("RW DATA:", data);

        let html = '<option value="">Pilih RW</option>';

        data.forEach(r => {
          html += `<option value="${r.id_wilayah}">${r.nama_wilayah}</option>`;
        });

        $('#id_rw').html(html);

        if(selected){
          $('#id_rw').val(selected);
        }

        if(callback) callback();
      });
    }

    function loadRt(id_rw, selected = null){
      if(!id_rw) return;

      $.get("<?= base_url('wilayah/getRt') ?>/" + id_rw, function(data){

        let html = '<option value="">Pilih RT</option>';
        data.forEach(r => {
          html += `<option value="${r.id_wilayah}">${r.nama_wilayah}</option>`;
        });

        $('#id_rt').html(html);

        if(selected) $('#id_rt').val(selected);
      });
    }

    $('#tabelKeluarga tbody').on('click', '.btn-edit', function(){

      let data = table.row($(this).parents('tr')).data();

    console.log(data); // debug

    // isi form
    $('#id_kk').val(data.id_kk);
    $('#no_kk').val(data.no_kk);
    $('#alamat').val(data.alamat);
    $('#jumlah_anggota').val(data.jumlah_anggota);

    loadDusun(data.id_dusun, function(){
      loadRw(data.id_dusun, data.id_rw, function(){
        loadRt(data.id_rw, data.id_rt);
      });
    });

    $('#modalKeluarga').modal('show');
  });
    $('#id_dusun').on('change', function(){
      let id = $(this).val();
      loadRw(id);
      $('#id_rt').html('<option value="">Pilih RT</option>');
    });

    $('#id_rw').on('change', function(){
      let id = $(this).val();
      loadRt(id);
    });

    $(document).ready(function(){

      $(document).on('submit', '#formEdit', function(e){
        e.preventDefault();

        console.log("SUBMIT JALAN"); // 🔥 wajib muncul

        let form = $(this);

        $.ajax({
          url: "<?= base_url('keluarga/updateKeluarga') ?>",
          type: "POST",
          data: form.serialize(),
          dataType: "json",

          success: function(res){
            console.log(res);

            if(res.status === 'success'){
              Swal.fire('Berhasil', res.message, 'success');

              $('#modalKeluarga').modal('hide');
              $('#tabelKeluarga').DataTable().ajax.reload(null, false);
            } else {
              Swal.fire('Gagal', res.message, 'error');
            }
          },

          error: function(xhr){
            console.log(xhr.responseText);

            Swal.fire({
              icon: 'error',
              title: 'Error Server!',
              text: 'Terjadi kesalahan saat menyimpan'
            });
          }
        });

      });

    });

    $('#tabelKeluarga tbody').on('click','.btn-delete',function(){

      let data = table.row($(this).closest('tr')).data();

      $('#delete_id_kk').val(data.id_kk);

      $('#delete_no_kk').text(data.no_kk);

      $('#modalDeleteKeluarga').modal('show');

    });


    $('#btnDeleteKeluarga').click(function(){

      $.ajax({

        url:"<?= base_url('keluarga/deleteKeluarga') ?>",

        type:"POST",

        dataType:"json",

        data:{
          id_kk:$('#delete_id_kk').val()
        },

        beforeSend:function(){

          $('#btnDeleteKeluarga').prop('disabled',true);

        },

        success:function(res){

          if(res.status=="success"){

            $('#modalDeleteKeluarga').modal('hide');

            Swal.fire({

              icon:'success',

              title:'Berhasil',

              text:res.message,

              timer:1200,

              showConfirmButton:false

            });

            table.ajax.reload(null,false);

          }else{

            Swal.fire({

              icon:'error',

              title:'Gagal',

              text:res.message

            });

          }

        },

        error:function(xhr){

          console.log(xhr.responseText);

          Swal.fire({

            icon:'error',

            title:'Error',

            text:'Terjadi kesalahan pada server.'

          });

        },

        complete:function(){

          $('#btnDeleteKeluarga').prop('disabled',false);

        }

      });

    });


    $('#tabelKeluarga tbody').on('click','.btn-detail',function(){

      let data = table.row($(this).closest('tr')).data();

      $.ajax({

        url:"<?= base_url('keluarga/getDetailAnggota')?>",

        type:"GET",

        data:{
          id:data.id_kk
        },

        dataType:"json",

        success:function(res){

          $('#detail_no_kk').text(res.keluarga.no_kk);

          $('#detail_jumlah').text(res.anggota.length+" Orang");

          let html='';

          $.each(res.anggota,function(i,item){
            let alamat= item.dusun+' / '+item.rt+' / '+item.rw;
            $('#detail_alamat').text(alamat);
            html+=`

                <tr>

                    <td>${i+1}</td>

                    <td>${item.nik}</td>

                    <td>${item.nama}</td>

                    <td>${item.jenis_kelamin}</td>

                    <td>${item.tanggal_lahir}</td>

                    <td>${item.hubungan_keluarga}</td>

                    <td>${item.nama_pekerjaan}</td>

                    <td>${Number(item.penghasilan_pribadi).toLocaleString('id-ID')}</td>

                    <td>${item.pendidikan}</td>

                </tr>

            `;

          });

          if(res.anggota.length==0){

            html=`

                <tr>

                    <td colspan="9"
                        class="text-center">

                        Belum ada anggota keluarga

                    </td>

                </tr>

            `;

          }

          $('#tbodyAnggota').html(html);

          $('#modalDetailAnggota').modal('show');

        }

      });

    });
//===================
  });
</script>
</main>
<?= view('dashboard/footer_view'); ?>