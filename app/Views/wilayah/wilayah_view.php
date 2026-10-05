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
              <h3>Data Wilayah</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid px-4 py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">SPK BLTD</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Wilayah</li>
              </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Data Wilayah</h1>
          </div>
        </div>

        <div class="row g-3 mb-4">

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm" style="background-color: #e8f4fd; border-radius: 12px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="p-3 bg-white rounded-3 me-3 text-primary shadow-sm">
                    <i class="bi bi-geo-alt-fill fs-4"></i>
                  </div>
                  <div>
                    <h6 class="card-subtitle text-muted fw-semibold mb-1">Ringkasan Dusun</h6>
                    <h3 class="card-title mb-0 fw-bold text-dark">Total Dusun: <?= $jmlDusun ?></h3>
                  </div>
                </div>
                <p class="card-text text-secondary small mb-0">
                  <i class="bi bi-info-circle me-1"></i> Rekapitulasi Total Jumlah dusun</strong>
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm" style="background-color: #eef9f2; border-radius: 12px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="p-3 bg-white rounded-3 me-3 text-success shadow-sm">
                    <i class="bi bi-map-fill fs-4"></i>
                  </div>
                  <div>
                    <h6 class="card-subtitle text-muted fw-semibold mb-1">Ringkasan RW</h6>
                    <h3 class="card-title mb-0 fw-bold text-dark">Total RW: <?= $jmlRW ?></h3>
                  </div>
                </div>
                <p class="card-text text-secondary small mb-0">
                  <i class="bi bi-calculator me-1"></i>Rekapitulasi Total Jumlah RW</strong>
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm" style="background-color: #fff3cd; border-radius: 12px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="p-3 bg-white rounded-3 me-3 text-warning shadow-sm">
                    <i class="bi bi-house-door-fill fs-4"></i>
                  </div>
                  <div>
                    <h6 class="card-subtitle text-muted fw-semibold mb-1">Ringkasan RT</h6>
                    <h3 class="card-title mb-0 fw-bold text-dark">Total RT: <?= $jmlRT ?></h3>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                  <p class="card-text text-secondary small mb-0 me-2">
                    Rekapitulasi Jumlah RT
                  </p>
                  <div class="d-flex align-items-end" style="height: 24px;">
                    <div class="bg-warning opacity-50 rounded-top mx-1" style="width: 6px; height: 60%;"></div>
                    <div class="bg-warning rounded-top mx-1" style="width: 6px; height: 100%;"></div>
                    <div class="bg-warning opacity-75 rounded-top mx-1" style="width: 6px; height: 40%;"></div>
                    <div class="bg-warning opacity-50 rounded-top mx-1" style="width: 6px; height: 80%;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-body p-4">

            <div class="row g-3 align-items-center mb-4">
              <div class="col-12 col-md-auto d-flex gap-2">
                <button class="btn btn-primary px-3 rounded-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalImport">
                  <i class="bi bi-box-arrow-in-down"></i> Import
                </button>

                <div class="btn-group">
                  <button class="btn btn-info text-white px-3 rounded-start-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalWilayah">
                    <i class="bi bi-plus-lg"></i> Tambah
                  </button>
                </div>
                <div>
                  <?php if($isEditable): ?>
                    <a href="<?= base_url('wilayah') ?>" class="btn btn-danger">

                      <label class="form-label">🔒 Non Aktif</label>
                    </a>
                  <?php else: ?>
                    <a href="<?= base_url('wilayah?edit=on') ?>" class="btn btn-success">

                     <label  class="form-label">✏️ Aktifkan Edit</label>
                   </a>
                 <?php endif; 
                 ?>


               </div>
             </div>

             <div class="col-md"></div>
             <div class="col-12 col-md-auto">
              <div class="row g-2">
                <div class="col-12 col-sm-12">
                  <label>Filter berdasarkan Dusun</label>
                  <select class="form-select" onchange="filterDusun(this)">
                    <option value="all">-- Pilih Dusun --</option>
                    <?php 
// Mengambil data id dusun dari URL saat ini
                    $current_dusun = request()->getGet('dusun'); 
                    ?>

                    <?php foreach ($dusun as $ds): ?>
                      <option value="<?= esc($ds['id_wilayah']); ?>" <?= ($ds['id_wilayah'] == $current_dusun) ? 'selected' : ''; ?>>
                       <?= esc($ds['nama_wilayah']); ?>
                     </option>
                   <?php endforeach; ?>
                 </option>
               </select>
             </div>
           </div>
         </div>
       </div>
       <?php if($isEditable): ?>
        <div class="d-flex align-items-center my-2 text-secondary small">
          <i class="bi bi-info-circle-fill text-info me-2"></i>
          <span>Mode Edit Aktif: Ubah data langsung pada tabel lalu tekan <kbd class="bg-dark text-white px-1.5 py-0.5 rounded small" style="font-size: 0.75rem;">Enter</kbd> untuk menyimpan.</span>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table id="tabelWilayah" class="table table-hover align-middle border-top text-dark">
          <thead class="table-light">
            <tr>
              <th scope="col" class="py-3 px-3 text-secondary small" style="width: 80px;">No <i class="bi bi-caret-up-fill small text-muted ms-1"></i></th>
              <th scope="col" class="py-3 text-secondary small">Dusun <i class="bi bi-chevron-expand small text-muted ms-1"></i></th>
              <th scope="col" class="py-3 text-secondary small">RW <i class="bi bi-chevron-expand small text-muted ms-1"></i></th>
              <th scope="col" class="py-3 text-secondary small">RT <i class="bi bi-chevron-expand small text-muted ms-1"></i></th>
              <th scope="col" class="py-3 text-secondary small text-end px-3" style="width: 160px;">Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<!--------------------------------- Batas ----------------------->

</main>

<!--  BATAS MODAL TAMBA DATA WILAYAH-->

<div class="modal fade" id="modalWilayah">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5>Tambah Wilayah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal">
        </button>
      </div>

      <div class="modal-body">
        <form id="formWilayah">

          <!-- JENIS -->
          <div class="mb-2">
            <label>Jenis</label>
            <select name="jenis" id="jenis" class="form-control">
              <option value="">-- Pilih --</option>
           <!--   <option value="dusun">Dusun</option> -->
              <option value="rw">RW</option>
              <option value="rt">RT</option>
            </select>
          </div>

          <!-- DROPDOWN PARENT -->
          <div class="mb-2" id="parent_wrapper" style="display:none;">
            <label id="label_parent">Parent</label>
            <select name="parent_id" id="parent_id" class="form-control"></select>
          </div>
          <!-- INPUT Dusun -->
          <div id="wrapper_dusun" style="display:none;">
            <div class="mb-2">
              <label id="label_nama">Nama Dusun</label>
              <input type="text" class="form-control" name="nama_dusun">
            </div>
            <div class="mb-2">
              <label id="label_nama_RW">Nama RW</label>
              <input type="text" class="form-control"  name="nama_rw">
            </div>

            <div class="mb-2">
              <label id="label_nama_RT">Nama RT</label>
              <input type="text" class="form-control"  name="nama_rt">
            </div>
          </div>
          <!-- INPUT NAMA -->
          <div class="mb-2" id="nama_wrapper" style="display:none;">
            <label id="label_nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control">
          </div>

        </form>
      </div>

      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Cancel
      </button>
      <button type="button" class="btn btn-success" id="btnSave">Simpan</button>
    </div>

  </div>
</div>
</div>

<div class="modal fade" id="modalImport">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5>Import Data Wilayah</h5>
      </div>
      <div class="modal-body">
        <h5>Upload file dalam extensi .xls dengan format excel seperti pada link dibawah ini</h5>
        <div class="row">
          <div class="col">
            <a href="dist/assets/img/example-upload-wilayah1.png" target="_blank">Klik untuk Melihat</a>
          </div>
        </div>
      </div>
      <!-- <form  action="<?= base_url('wilayah/preview') ?>"enctype="multipart/form-data"  method="post">-->
        <form id="formImport" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Upload File Data Wilayah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Pilih File</label>
              <input type="file" name="file" class="form-control" required>
            </div>

            <div class="mb-3">
              <small class="text-muted">
                Format yang diperbolehkan: .xls, .xlsx
              </small>
            </div>

          </div>

        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success" id="btnImport" >
            <i class="bi bi-upload"></i> Upload
          </button>
        </div>
      </div>
    </div>
  </div>
<!-- MODAL EDIT -->

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">
          <i class="bi bi-trash3-fill"></i>
          Hapus Data Wilayah
        </h5>

        <button type="button"
        class="btn-close btn-close-white"
        data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" id="delete_id">

        <p>Apakah Anda yakin ingin menghapus data wilayah berikut?</p>

        <div class="alert alert-warning mb-0">
          <strong id="delete_nama"></strong>
        </div>

      </div>

      <div class="modal-footer">

        <button class="btn btn-secondary"
        data-bs-dismiss="modal">
        Batal
      </button>

      <button class="btn btn-danger"
      id="btnDelete">
      <i class="bi bi-trash3-fill"></i>
      Hapus
    </button>

  </div>

</div>
</div>
</div>

<script>
  function filterDusun(selectElement) {
    // 1. Ambil URL saat ini beserta parameter-parameternya
    let currentUrl = new URL(window.location.href);
    
    // 2. Ambil nilai id_dusun yang dipilih
    let selectedValue = selectElement.value;
    
    if (selectedValue !== 'all') {
      currentUrl.searchParams.set('dusun', selectedValue);
    } else {
      currentUrl.searchParams.delete('dusun');
    }
    
    // 3. Pindahkan halaman ke URL yang baru
    window.location.href = currentUrl.toString();
  }
  let isEditable = <?= $isEditable ? 'true' : 'false' ?>;

  function setInputState(state){
    $('#tabelWilayah input')
    .prop('disabled', !state)
    .prop('readonly', !state)
    .css({
      'background-color': state ? '' : '#e9ecef',
      'cursor': state ? 'text' : 'not-allowed'
    });
  }
  $(document).ready(function() {

        // saat pertama load
    setInputState(isEditable);

    // kalau pakai DataTables
    $('#tabelWilayah').on('draw.dt', function(){
      setInputState(isEditable);
    });


    $('#parent_wrapper').hide();
    $('#wrapper_dusun').hide();
    $('#nama_wrapper').hide();

    // 1. Ambil nilai parameter 'dusun' dari URL browser saat ini
    let urlParams = new URLSearchParams(window.location.search);
    let filterDusun = urlParams.get('dusun') || ''; // Jika tidak ada, biarkan kosong

    let table = $('#tabelWilayah').DataTable({
      ajax: {
        url: "<?= base_url('wilayah/getdata') ?>",
        type: "GET",
        data: function(d) {
            // Mengirimkan parameter 'dusun' ke Controller CodeIgniter
          d.dusun = filterDusun; 
        }
      },
      destroy: true,
      columns: [
        { data: 'no' },
        // 🔥 DUSUN + tombol edit
        {
          data: null,
          render: function(data) {

            if (data.dusun && data.dusun !== '-') {
              return `
                <input type="text" class="form-control input-edit_dsn" value="${data.dusun}"  data-id="${data.id_dusun}" data-field="nama_wilayah">`;
              }

              return data.rw;
            }
          },
        // 🔥 RW + tombol edit
          {
            data: null,
            render: function(data) {

              if (data.rw && data.rw !== '-') {
                return `
                  <input type="text" class="form-control input-edit_rw" value="${data.rw}"  data-id="${data.id_rw}" data-field="nama_wilayah">`;
                }

                return data.rw;
              }
            },
        // 🔥 RT + tombol edit
            {
              data: null,
              render: function(data) {

                if (data.rt && data.rt !== '-') {
                  return `
                    <input type="text" class="form-control input-edit_rw" value="${data.rt}"  data-id="${data.id_rt}" data-field="nama_wilayah">`;
                  }

                  return data.rt;
                }
              },
              {
                data: null,
                orderable: false,
                render: function (data) {
                  return `
                      <button class="btn btn-warning btn-sm btn-delete" data-id="${data.id_rt}" data-nama="Data : ${data.rt} Pada : ${data.dusun}- ${data.rw}" title="Hapus Data Wilayah">
                          <i class="bi bi-trash3-fill"></i>
                      </button>
                  `;
                }
              }
            ]
          });

// load jenis
    $('#jenis').on('change', function(){

      let jenis = $(this).val();

  // reset
      $('#parent_wrapper').hide();
      $('#wrapper_dusun').hide();
      $('#nama_wrapper').hide();

      if(jenis === 'dusun'){
        $('#label_nama').text('Nama Dusun');
        $('#label_nama_RW').text('Nama RW');
        $('#label_nama_RT').text('Nama RT');
        $('#wrapper_dusun').show();
      }

      else if(jenis === 'rw'){

        $('#label_parent').text('Pilih Dusun');
        $('#label_nama').text('Nama RW');

        $('#parent_wrapper').show();
        $('#wrapper_dusun').hide();
        $('#nama_wrapper').show();

        loadParent('rw');
      }

      else if(jenis === 'rt'){

        $('#label_parent').text('Pilih RW');
        $('#label_nama').text('Nama RT');

        $('#parent_wrapper').show();
        $('#nama_wrapper').show();
        $('#wrapper_dusun').hide();
        loadParent('rt');
      }

    });

// ======================
// LOAD PARENT AJAX
// ======================
    function loadParent(jenis){

      $('#parent_id').html('<option>Loading...</option>');

      $.get("<?= base_url('wilayah/getParent') ?>/" + jenis, function(data){

        let html = '<option value="">-- Pilih --</option>';

        data.forEach(function(item){
          html += `<option value="${item.id}">${item.nama}</option>`;
        });

        $('#parent_id').html(html);
      });
    }

    $(document).on('keypress', '.input-edit_dsn', function(e){

    if(e.which == 13){ // ENTER

      let input = $(this);
      let id    = input.data('id');
      let field = input.data('field');
      let value = input.val();

      $.ajax({
        url: "<?= base_url('wilayah/updateWil') ?>",
        type: "POST",
        data: {
          id: id,
          field: field,
          value: value
        },
        dataType: "json",

        success: function(res){

          if(res.status == 'success'){

            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: res.message,
              timer: 1000,
              showConfirmButton: false
            }).then(() => {
                        location.reload(); // 🔥 reload halaman
                      });

          } else {
            Swal.fire('Error', res.message, 'error');
          }
        },

        error: function(xhr){
          console.log(xhr.responseText);
          Swal.fire('Error', 'Server error', 'error');
        }
      });

    }

  });

    $(document).on('keypress', '.input-edit_rw', function(e){

    if(e.which == 13){ // ENTER

      let input = $(this);
      let id    = input.data('id');
      let field = input.data('field');
      let value = input.val();

      $.ajax({
        url: "<?= base_url('wilayah/updateWil') ?>",
        type: "POST",
        data: {
          id: id,
          field: field,
          value: value
        },
        dataType: "json",

        success: function(res){

          if(res.status == 'success'){

            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: res.message,
              timer: 1000,
              showConfirmButton: false
            }).then(() => {
                        location.reload(); // 🔥 reload halaman
                      });

          } else {
            Swal.fire('Error', res.message, 'error');
          }
        },

        error: function(xhr){
          console.log(xhr.responseText);
          Swal.fire('Error', 'Server error', 'error');
        }
      });

    }

  });

    $(document).on('keypress', '.input-edit_rt', function(e){

    if(e.which == 13){ // ENTER

      let input = $(this);
      let id    = input.data('id');
      let field = input.data('field');
      let value = input.val();

      $.ajax({
        url: "<?= base_url('wilayah/updateWil') ?>",
        type: "POST",
        data: {
          id: id,
          field: field,
          value: value
        },
        dataType: "json",

        success: function(res){

          if(res.status == 'success'){

            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: res.message,
              timer: 1000,
              showConfirmButton: false
            }).then(() => {
                        location.reload(); // 🔥 reload halaman
                      });

          } else {
            Swal.fire('Error', res.message, 'error');
          }
        },

        error: function(xhr){
          console.log(xhr.responseText);
          Swal.fire('Error', 'Server error', 'error');
        }
      });

    }

  });

// SAVE
    $('#btnSave').click(function(){

      let formData = $('#formWilayah').serialize();

      $.ajax({
        url: "<?= base_url('wilayah/save') ?>",
        type: "POST",
        data: formData,
    dataType: "json", // 🔥 penting
    success: function(res){

      console.log(res); // debug

      if(res.status === 'success'){

        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: res.message,
          timer: 1500,
          showConfirmButton: false
        });

        $('#modalWilayah').modal('hide');
        $('#tabelWilayah').DataTable().ajax.reload();
          // reset
        $('#parent_wrapper').hide();
        $('#wrapper_dusun').hide();
        $('#nama_wrapper').hide();


      } else {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: res.message
        });
      }
    }
  });
    });

// btn import data wilayah

    $('#btnImport').click(function(e){
      e.preventDefault();

      let form = document.getElementById('formImport');
    let formData = new FormData(form); // 🔥 wajib untuk upload file

    $.ajax({
      url: "<?= base_url('wilayah/import') ?>",
      type: "POST",
      data: formData,
        processData: false, // 🔥 WAJIB
        contentType: false, // 🔥 WAJIB
        dataType: "json",

        beforeSend: function(){
          Swal.fire({
            title: 'Uploading...',
            text: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });
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
            });

                // tutup modal (Bootstrap 5)
            let modal = bootstrap.Modal.getInstance(document.getElementById('modalWilayah'));
            modal.hide();

            $('#tabelWilayah').DataTable().ajax.reload();

                // reset form
            $('#formImport')[0].reset();

            $('#parent_wrapper').hide();
            $('#wrapper_dusun').hide();
            $('#nama_wrapper').hide();

          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: res.message
            });
          }
        },

        error: function(xhr){
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Server error: ' + xhr.status
          });
        }
      });
  });

    //ketika tombol delete diklik
    $(document).on('click','.btn-delete',function(){

      let id = $(this).data('id');
      let nama = $(this).data('nama');

      $('#delete_id').val(id);
      $('#delete_nama').text(nama);

      $('#modalDelete').modal('show');

    });

    $('#btnDelete').click(function () {

      let id = $('#delete_id').val();

      $.ajax({
        url: "<?= base_url('wilayah/delete') ?>/" + id,
        type: "POST",
        data: {
          <?= csrf_token() ?>: "<?= csrf_hash() ?>"
        },
        dataType: "json",
        success: function(response){

          if(response.status){

            $('#modalDelete').modal('hide');

            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: response.message,
              timer: 1500,
              showConfirmButton: false
            }).then(() => {
              location.reload();
            });

          }else{

            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: response.message
            });

          }

        },
        error: function(){
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan pada server.'
          });
        }
      });

    });

  });
</script>

<?= view('dashboard/footer_view'); ?>