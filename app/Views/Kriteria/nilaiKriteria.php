<?= view('dashboard/header_view'); ?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div id="alertBox"></div>
  <div class="app-wrapper">

    <?= view('dashboard/sidebar_view'); ?>

    <main class="app-main">
      <div class="app-content">
        <div class="container-fluid">

          <div class="card">
            <div class="card-header">
              <h4>Daftar Nilai Kriteria</h4>
            </div>          
            <div class="card-body">
              <div class="tab-content mt-3">
                <div class="row">
                  <div class="col">
                    <div class="card"> 
                      <div class="card-header">
                        <div class="row">
                          <div class="col">
                            <div class="d-flex justify-content-end">
                              <a href="<?= base_url('tambahNilaiKriteria'); ?>">
                                <!-- <button id="btnTambah" class="btn btn-primary"> -->
                                  <button class="btn btn-success">
                                    Tambah Nilai Kriteria<i class="bi bi-plus"></i>
                                  </button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <table id="tabelNilaiKriteria" class="table table-bordered table-striped">
                            <form method="POST">
                              <tbody>
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Kategori</th>
                                    <th>Nilai</th>
                                    <th>Skor</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                              </tbody>
                            </form>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!--- Batas Div class card- Body -->
            </div>
          </div>
        </div>
<!--BATAS MODLAL BOOTSTRAP -->
<div class="modal fade" id="modalEditNilaiKriteria" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
       <h5 class="modal-title">
        <i class="bi bi-pencil-square me-2"></i>
        Edit Nilai Kriteria
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal">
      </button>
    </div>
    <div class="modal-body">
      <div class="mb-3">
        <label>Nama Kriteria</label>
        <input type="text" class="form-control" id="nama_kriteria" disabled>
      </div>
      <input type="hidden" id="id_nilai">
      <div class="mb-3">
       <label>Kategori</label>
       <input type="text" class="form-control" id="kategori" >
     </div>
     <div class="mb-3">
      <label>Nilai</label>
      <input type="text" class="form-control" id="nilai">
    </div>
    <div class="mb-3">
      <label>Skor</label>
      <input type="number" class="form-control" id="skor">
    </div>
    <div class="mb-3">
      <label>Keterangan</label>
      <textarea class="form-control" id="keterangan"></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">
      Batal
    </button>
    <button class="btn btn-primary" id="btnUpdate">
      Simpan
    </button>
  </div>
</div>
</div>
</div>
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
          <select class="form-select" id="tambah_id_kriteria">
            <option value="">-- Pilih Kriteria --</option>
          </select>
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
  <div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog">

      <input type="hidden" id="delete_id">

      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Hapus Kriteria</h5>

          <button type="button"
          class="btn-close"
          data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <p>
            Apakah yakin akan menghapus data Nilai Kriteria
            <strong id="delete_nilai"></strong> ?
          </p>
        </div>

        <div class="modal-footer">
          <button type="button"
          id="btnHapus"
          class="btn btn-danger">
          Ya
        </button>
        <button type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">
        Batal
      </button>

    </div>

  </div>

</div>
</div>
</main>
<?= view('dashboard/footer_view'); ?>
<script>
  let table;
  $(document).ready(function(){

/*$('#btnTambah').click(function(){
    $.ajax({

        url:"<?= base_url('kriteria/getDataKriteria') ?>",

        type:"GET",

        dataType:"json",

        success:function(res){

            let option = '<option value="">-- Pilih Kriteria --</option>';

            $.each(res,function(i,item){

                option += `
                    <option value="${item.id_kriteria}">
                        ${item.nama_kriteria}
                    </option>
                `;

            });

            $('#tambah_id_kriteria').html(option);

            $('#modalTambahNilaiKriteria').modal('show');

        }

    });

}); */

    if (!$.fn.DataTable.isDataTable('#tabelNilaiKriteria')) {

      table = $('#tabelNilaiKriteria').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
          url: "<?= base_url('kriteria/getNilaiKriteria') ?>", 
          type: "GET",
          dataSrc: ''
        },
        columns: [
          {
            data: null,
            render: function(data, type, row, meta){
              return meta.row + 1;
            }
          },
               // { data: 'nilai' },
          {
            data: null,
            render: function(data) {
              return data.nama_kriteria;
            }
          },
                  //{ data: 'nama kriteria' },
          {
            data: null,
            render: function(data) {

             return data.kategori;

           }
         },
                  //{ data: 'nilai' }
         {
          data: null,
          render: function(data) {
            return data.nilai;
          }
        },
               //{ data: 'skor' }
        {
          data: null,
          render: function(data) {
            return data.skor;
          }
        },
               //{ data: 'Keterangan' }
        {
          data: null,
          render: function(data) {
            return data.keterangan;
          }
        },
        {
          data: null,
          orderable: false,
          render: function (data) {
            return `
<button type="button"
                class="btn btn-info btn-sm btn-edit"
                data-id="${data.id_nilai}">
            <i class="bi bi-pencil-square"></i>
        </button>        
<button class="btn btn-warning btn-sm btn-delete" data-id="${data.id_nilai}" title="Hapus Data Nilai Kriteria"> <i class="bi bi-trash3-fill"></i> </button>
            `;
          }
        }
      ]
    });

    }


    $(document).on('click','.btn-edit',function(){

      let id = $(this).data('id');

      $.ajax({

        url:"<?= base_url('kriteria/getDetailNilaiKriteria') ?>",

        type:"GET",

        data:{
          id:id
        },

        dataType:"json",

        success:function(res){
          $('#nama_kriteria').val(res.nama_kriteria);

          $('#id_nilai').val(res.id_nilai);

          $('#kategori').val(res.kategori);

          $('#nilai').val(res.nilai);

          $('#skor').val(res.skor);

          $('#keterangan').val(res.keterangan); 

          $('#modalEditNilaiKriteria').modal('show');


        }

      });

    });


    $('#btnUpdate').click(function(){

      $.ajax({

        url:"<?= base_url('kriteria/updateNilaiKriteria') ?>",

        type:"POST",

        dataType:"json",

        data:{

          id_nilai:$('#id_nilai').val(),

          kategori:$('#kategori').val(),

          nilai:$('#nilai').val(),

          skor:$('#skor').val(),

          keterangan:$('#keterangan').val()

        },
        success: function(res){

          if(res.status === 'success'){

           $('#modalEditNilaiKriteria').modal('hide');

        // Bersihkan backdrop jika masih ada
           $('.modal-backdrop').remove();
           $('body').removeClass('modal-open');
           $('body').css('padding-right','');

           Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: res.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {

            table.ajax.reload(null,false);
          });

        }else{

          Swal.fire({
            icon:'error',
            title:'Gagal',
            text:res.message
          });

        }

      },
    });

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

    let rowDelete = null;

    $(document).on('click', '.btn-delete', function () {

      rowDelete = $(this).closest('tr');

      $('#delete_id').val($(this).data('id'));

      $('#delete_nilai').text($(this).data('nilai'));

      const modal = new bootstrap.Modal(document.getElementById('modalDelete'));

      modal.show();

    });

    $('#btnHapus').click(function () {

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

            setTimeout(function(){

              window.location.href = "<?= base_url('nilaiKriteria') ?>";

            },1500);

          }

        }

      });

    });

  });
</script>