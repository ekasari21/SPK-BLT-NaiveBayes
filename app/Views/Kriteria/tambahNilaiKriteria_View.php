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
              <h3>Tambah Nilai Kriteria</h3>
          </div>
      </div>
  </div>
</div>

<div class="app-content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card shadow">
            <form action="<?= base_url('tambahNilaiKriteria'); ?>" method="get">
              <div class="card-body">
               <div class="card shadow-sm mb-3">
                <div class="card-header bg-light fw-bold">
                  <i class="bi bi-search"></i>
                  Pencarian Data Kriteria
              </div>

              <div class="card-body">

                  <div class="row align-items-end">
                    <div class="col-8">
                     <label class="form-label fw-bold">
                      Kode Kriteria / Nama Kriteria
                  </label>
                  <select  name="id_kriteria" id="id_kriteria" class="form-select" required>
                      <option value="">-- Pilih Kriteria --</option>
                      <?php foreach($listKriteria as $k): ?>
                        <option value="<?= $k['id_kriteria']; ?>"
                          <?= ($id_kriteria == $k['id_kriteria']) ? 'selected' : ''; ?>>
                          <?= $k['kode_kriteria']; ?>
                          -
                          <?= $k['nama_kriteria']; ?>
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div class="col-4">
            <button type="button" class="btn btn-primary" id="cekKriteria">
                <i class="bi bi-search"></i>
                Cek Kriteria
            </button>
            <a href="<?= base_url('tambahNilaiKriteria');?>" class="btn btn-secondary">Reset</a>
        </div>
        <div class="col-12">
          <small class="text-muted">
            Masukkan Kode Kriteria / Nama Kriteria terlebih dahulu.
        </small>
    </div>
</div>
</div>
</div>
</form>
</div>
</div> 
<div class="card-body">
    <div class="row">
        <div class="col">
          <div class="d-flex justify-content-end">
               <!-- <button id="btnAddKriteria" class="btn btn-primary">
                <i class="bi bi-plus"></i>
              </button>-->
              <button class="btn btn-success mb-3" id="btnTambah">
                <i class="bi bi-plus-circle"></i> Tambah Nilai Kriteria
            </button>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="tabelNilaiKriteria" class="table table-bordered table-striped" width="100%">
      <form>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nilai</th>
                <th>Skor</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </form>
</table>
</div>
</div> <!-- div card body-->
</div><!-- div card -->
</div><!-- div container fluid -->
</div><!-- div app-content-->

<!----  Batas Modal Edit Nilai kriteri -->
<div class="modal fade" id="modalEditNilai" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">
                    Edit Nilai Kriteria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditNilai">
                <input type="hidden" name="id_nilai" id="edit_id_nilai">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="edit_kategori" required>
                    </div>
                    <div class="mb-3">
                        <label>Nilai</label>
                        <input type="text" class="form-control" name="nilai" id="edit_nilai" required>
                    </div>
                    <div class="mb-3">
                        <label>Skor</label>
                        <input type="number" class="form-control" name="skor" id="edit_skor" required>
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>

                        <textarea class="form-control" name="keterangan" id="edit_keterangan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    type="button">
                    Batal
                </button>
                <button type="submit"
                class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
</div>
</div>



<!---Modal HAPUS---->
<div class="modal fade" id="modalDelete">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5>Konfirmasi Hapus</h5>
            </div>

            <div class="modal-body">

                <input type="hidden" id="delete_id">

                <p>
                    Apakah Anda yakin ingin menghapus data Nilai Kriteria berikut : <br>
                    <strong id="namaDelete"></strong>?
                </p>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>

                <button class="btn btn-danger" id="btnDelete">
                    Hapus
                </button>
            </div>

        </div>
    </div>
</div>
<!--Modal Tambah--->
<div class="modal fade" id="modalTambahNilaiKriteria" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">
          <i class="bi bi-plus-circle"></i>
          Tambah Nilai Kriteria
      </h5>
      <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">
    <div class="mb-3">
      <label class="form-label">Kriteria</label>
      <input type="hidden" id="tambah_id_kriteria" name="id_kriteria"> 
      <input type="text" id="tambah_nama_kriteria"  class="form-control" disabled> 
  </div>
  <div class="mb-3">
      <label>Kategori</label>
      <input type="text" class="form-control" id="tambah_kategori">
      <div class="form-text text-muted">
        <i>Masukkan nama kategori yang akan digunakan pada kriteria. <br>Contoh:
          <strong>Sangat Layak</strong>, <strong>Layak</strong>,
          <strong>Kurang Layak</strong>, atau <strong>Tidak Layak</strong>.</i>
      </div>
  </div>
  <div class="mb-3">
    <label>Nilai</label>
    <input type="text" class="form-control" id="tambah_nilai">
    <i>Masukkan label nilai yang akan digunakan pada kategori.</i>
</div>
<div class="mb-3">
    <label>Skor</label>
    <input type="number" class="form-control" id="tambah_skor">
    <i>Masukkan skor nilai pada rentang 1-10 yang akan digunakan pada kategori.</i>
</div>
<div class="mb-3">
    <label>Keterangan</label>
    <textarea class="form-control" id="tambah_keterangan"></textarea>
</div>
</div>
<div class="modal-footer">
  <button class="btn btn-secondary" data-bs-dismiss="modal">
    Batal
</button>
<button class="btn btn-success" id="btnSimpanTambah">
    Simpan
</button>
</div>
</div>
</div>
</div>
<script>

    $(document).ready(function () {

    // Ambil parameter idKriteria dari URL
        let params = new URLSearchParams(window.location.search);
        let id_kriteria = params.get('id_kriteria');

    // Set dropdown jika parameter ada
        if (id_kriteria) {
            $('#id_kriteria').val(id_kriteria);
            $('#btnTambahKriteria').prop('disabled', false);
        }else {
        // Tidak ada parameter, tombol nonaktif
            $('#btnTambahKriteria').prop('disabled', true);
        }

    // Inisialisasi DataTable
        let table = $('#tabelNilaiKriteria').DataTable({
            processing: true,
            destroy: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "<?= base_url('kriteria/getNilaiKriteriabyid'); ?>",
                type: "GET",
                data: function (d) {
                    d.id_kriteria = $('#id_kriteria').val();
                }
            },
            columns: [
                { data: 'no' },
                { data: 'kategori' },
                { data: 'nilai' },
                { data: 'skor' },
                { data: 'keterangan' },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function (data, type, row) {
                        return `
                        <button class="btn btn-info btn-sm btn-edit" data-id="${row.id_nilai}" data-name="Kategori : ${row.kategori} Nilai : ${row.nilai}"" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-warning btn-sm btn-delete" data-id="${row.id_nilai}" data-nama="kategori : ${row.kategori} - ${row.keterangan}" title="Hapus">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                        `;
                    }
                }
            ]

        });

    // Jika URL sudah memiliki idKriteria, langsung load data
        if (id_kriteria) {
            table.ajax.reload();
        }

    // Tombol Cek Kriteria
        $('#cekKriteria').click(function () {

            let id = $('#id_kriteria').val();

            if (id == "") {
                alert('Pilih kriteria terlebih dahulu.');
                return;
            }

        // Ubah URL
            let url = "<?= base_url('tambahNilaiKriteria'); ?>?id_kriteria=" + id;
            history.pushState({}, '', url);

        // Reload DataTable
            table.ajax.reload();
            $('#btnTambahKriteria').prop('disabled', false);
        });


        $(document).on("click",".btn-edit",function(){

            let id = $(this).data("id");

            $.ajax({

                url:"<?= site_url('kriteria/getNilai') ?>/"+id,
                type:"GET",
                dataType:"json",

                success:function(res){

                    if(res.status){

                        $("#edit_id_nilai").val(res.data.id_nilai);
                        $("#edit_kategori").val(res.data.kategori);
                        $("#edit_nilai").val(res.data.nilai);
                        $("#edit_skor").val(res.data.skor);
                        $("#edit_keterangan").val(res.data.keterangan);

                        $("#modalEditNilai").modal("show");

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


        $(document).on("submit","#formEditNilai",function(e){

            e.preventDefault();

            $.ajax({

                url:"<?= site_url('kriteria/updateNilaiKriteria') ?>",
                type:"POST",
                data:$(this).serialize(),
                dataType:"json",

                success:function(res){

                    if(res.status=="success"){

                        $("#modalEditNilai").modal("hide");

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

                error:function(xhr){

                    console.log(xhr.responseText);

                    Swal.fire({
                        icon:'error',
                        title:'Error',
                        text:'Terjadi kesalahan pada server.'
                    });

                }

            });

        });


// Proses Hapus nilai kriteria

        $(document).on("click", ".btn-delete", function () {

            let id = $(this).data("id");
            let nama = $(this).data("nama");

            $("#delete_id").val(id);
            $("#namaDelete").text(id);

            $("#modalDelete").modal("show");

        });

        //Proses hapus
        $('#btnDelete').click(function () {

          let id = $('#delete_id').val();

          $.ajax({

            url: "<?= base_url('kriteria/deleteNilaiKriteria') ?>",

            type: "POST",

            data: {
              id: id
          },

          dataType: "json",
          success: function(res){

              if(res.status == 'success'){

                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: res.message,
                  timer: 1500,
                  showConfirmButton: false
              });
                setTimeout(function () {
                    location.reload();
                }, 1500);

            }

        }

    });

      });

        $("#btnTambah").click(function () {
              // Ambil parameter dari URL
            const params = new URLSearchParams(window.location.search);
            const idKriteria = params.get("id_kriteria");
            let namaKriteria = $(this).data("nama");

    // Isi value select
            $("#tambah_id_kriteria").val(idKriteria);
            $("#tambah_nama_kriteria").val(namaKriteria);


            $("#modalTambahNilaiKriteria").modal("show");

        });

        $('#btnSimpanTambah').click(function(){

          $.ajax({

            url:"<?= base_url('kriteria/simpanNilaiKriteria') ?>",

            type:"POST",

            dataType:"json",

            data:{

              id_kriteria:$('#tambah_id_kriteria').val(),

              kategori:$('#tambah_kategori').val(),

              nilai:$('#tambah_nilai').val(),

              skor:$('#tambah_skor').val(),

              keterangan:$('#tambah_keterangan').val()

          },

          success:function(res){

              if(res.status=='success'){

                $('#modalTambahNilaiKriteria').modal('hide');

                $('#tambah_nilai').val('');
                $('#tambah_skor').val('');
                $('#tambah_keterangan').val('');
                $('#tambah_kategori').prop('selectedIndex',0);
                $('#tambah_id_kriteria').prop('selectedIndex',0);

                Swal.fire({

                  icon:'success',

                  title:'Berhasil',

                  text:res.message,

                  timer:1200,

                  showConfirmButton:false

              }).then(() => {

                  table.ajax.reload(null, false);
              });;
          }

          else{

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

  // Batasan      

    });

</script>
</main>
</div>
<?= view('dashboard/footer_view'); ?>