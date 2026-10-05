  <div class="row">
    <div class="col">
      <div class="card"> 
        <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="d-flex justify-content-end">
               <!-- <button id="btnAddKriteria" class="btn btn-primary">
                <i class="bi bi-plus"></i>
              </button>-->
                              <button id="btnTambahKriteria" class="btn btn-primary">
                                Tambah Kriteria<i class="bi bi-plus"></i>
                              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="tabelKriteria" class="table table-bordered table-striped">
          <form method="POST">
            <tbody>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kriteria</th>
                  <th>Nama Kriteria</th>
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

<!-- BATASAN MODEL--->
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
                    Apakah yakin akan menghapus data Kriteria
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

<!--Modal tambah kriteria -->
<div class="modal fade" id="modalTambahKriteria" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Data Kriteria
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label">
                        Kode Kriteria
                    </label>

                    <input type="text"
                           class="form-control"
                           id="kode_kriteria"
                           placeholder="Contoh : C1">

                    <div class="invalid-feedback">
                        Kode kriteria wajib diisi.
                    </div>

                    <small class="text-muted">
                        Contoh: C1, C2, C3.
                    </small>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kriteria
                    </label>

                    <input type="text"
                           class="form-control"
                           id="nama_kriteria"
                           placeholder="Contoh : Penghasilan">

                    <div class="invalid-feedback">
                        Nama kriteria wajib diisi.
                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        class="form-control"
                        id="keterangan"
                        rows="3"
                        placeholder="Masukkan deskripsi kriteria"></textarea>

                    <div class="invalid-feedback">
                        Keterangan wajib diisi.
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <button class="btn btn-success"
                        id="btnSimpanKriteria">

                    <i class="bi bi-save"></i>
                    Simpan

                </button>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalEditKriteria" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Data Kriteria
                </h5>

                <button class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="edit_id_kriteria">

                <div class="mb-3">

                    <label class="form-label">Kode Kriteria</label>

                    <input type="text"
                           class="form-control"
                           id="edit_kode_kriteria">

                    <div class="invalid-feedback">
                        Kode kriteria wajib diisi.
                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">Nama Kriteria</label>

                    <input type="text"
                           class="form-control"
                           id="edit_nama_kriteria">

                    <div class="invalid-feedback">
                        Nama kriteria wajib diisi.
                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">Keterangan</label>

                    <textarea class="form-control"
                              id="edit_keterangan"
                              rows="3"></textarea>

                    <div class="invalid-feedback">
                        Keterangan wajib diisi.
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <button class="btn btn-warning"
                        id="btnUpdateKriteria">

                    <i class="bi bi-save"></i>
                    Update

                </button>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modalDeleteKriteria" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title">
                    <i class="bi bi-trash3-fill me-2"></i>
                    Hapus Data Kriteria
                </h5>

                <button class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="delete_id_kriteria">

                <p class="mb-2">
                    Apakah Anda yakin ingin menghapus data berikut?
                </p>

                <table class="table table-bordered">

                    <tr>
                        <th width="35%">Kode</th>
                        <td id="delete_kode"></td>
                    </tr>

                    <tr>
                        <th>Nama Kriteria</th>
                        <td id="delete_nama"></td>
                    </tr>

                </table>

                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Data yang dihapus tidak dapat dikembalikan.
                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button class="btn btn-danger"
                        id="btnDeleteKriteria">
                    <i class="bi bi-trash3-fill"></i>
                    Hapus
                </button>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modalDetailKriteria" tabindex="-1">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">

                    <i class="bi bi-eye-fill me-2"></i>

                    Detail Nilai Kriteria

                </h5>

                <button class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="alert alert-info">

                    <strong>Kriteria :</strong>

                    <span id="namaKriteria"></span>

                </div>

                <table class="table table-bordered table-striped">

                    <thead class="table-success">

                        <tr>

                            <th width="5%">No</th>

                            <th width="20%">Kategori</th>

                            <th width="25%">Nilai</th>

                            <th width="10%">Skor</th>

                            <th>Keterangan</th>

                        </tr>

                    </thead>

                    <tbody id="detailNilaiKriteria">

                    </tbody>

                </table>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>
<script>
  $(document).ready(function(){


    if (!$.fn.DataTable.isDataTable('#tabelKriteria')) {

      $('#tabelKriteria').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
          url: "<?= base_url('kriteria/getdata') ?>", 
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

              return data.kode_kriteria;
            }
          },
                  //{ data: 'nama kriteria' },
          {
            data: null,
            render: function(data) {

              return data.nama_kriteria;
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
                  <button class="btn btn-primary btn-sm btn-detail" data-id="${data.id_kriteria}" data-nama="${data.nama_kriteria}" title="Lihat Detail Kriteria">
                            <i class="bi bi-eye-fill"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm btn-edit" data-id="${data.id_kriteria}" title="Edit Kriteria"> 
                            <i class="bi bi-pencil-square"></i>
                    </button> 

                    <button class="btn btn-warning btn-sm btn-delete" data-id="${data.id_kriteria}" data-kode="${data.kode_kriteria}"
                    data-nama="${data.nama_kriteria}" title="Hapus Kriteria">
                            <i class="bi bi-trash3-fill"></i>
                    </button>
                `;
              }
            }
          ]
        });

    }
    $('#btnTambahKriteria').click(function(){

      $('#nama_kriteria').val('');
      $('#nama_kriteria').removeClass('is-invalid');

      $('#modalTambahKriteria').modal('show');

    });
   

   $('#btnSimpanKriteria').click(function(){

    $('.form-control').removeClass('is-invalid');

    let valid = true;

    if($('#kode_kriteria').val().trim() == ''){

        $('#kode_kriteria').addClass('is-invalid');
        valid = false;

    }

    if($('#nama_kriteria').val().trim() == ''){

        $('#nama_kriteria').addClass('is-invalid');
        valid = false;

    }

    if($('#keterangan').val().trim() == ''){

        $('#keterangan').addClass('is-invalid');
        valid = false;

    }

    if(!valid){

        Swal.fire({
            icon:'warning',
            title:'Perhatian',
            text:'Silakan lengkapi semua data.'
        });

        return;

    }

    $.ajax({

        url:"<?= base_url('kriteria/insertKriteria') ?>",

        type:"POST",

        dataType:"json",

        data:{

            kode_kriteria:$('#kode_kriteria').val(),

            nama_kriteria:$('#nama_kriteria').val(),

            keterangan:$('#keterangan').val()

        },

        success:function(res){

            if(res.status=='success'){

                $('#modalTambahKriteria').modal('hide');

                Swal.fire({

                    icon:'success',

                    title:'Berhasil',

                    text:res.message,

                    timer:1200,

                    showConfirmButton:false

                }).then(function(){

                    $('#tabelKriteria').DataTable().ajax.reload(null,false);

                    $('#kode_kriteria').val('');
                    $('#nama_kriteria').val('');
                    $('#keterangan').val('');

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

        }

    });

});

   $(document).on('click','.btn-edit',function(){

    let id = $(this).data('id');

    $.ajax({

        url:"<?= base_url('kriteria/getKriteriaById') ?>",

        type:"GET",

        data:{
            id:id
        },

        dataType:"json",

        success:function(res){

            $('#edit_id_kriteria').val(res.id_kriteria);
            $('#edit_kode_kriteria').val(res.kode_kriteria);
            $('#edit_nama_kriteria').val(res.nama_kriteria);
            $('#edit_keterangan').val(res.keterangan);

            $('#modalEditKriteria').modal('show');

        }

    });

});

   $('#btnUpdateKriteria').click(function(){

    $('.form-control').removeClass('is-invalid');

    let valid = true;

    if($('#edit_kode_kriteria').val().trim()==''){

        $('#edit_kode_kriteria').addClass('is-invalid');
        valid=false;

    }

    if($('#edit_nama_kriteria').val().trim()==''){

        $('#edit_nama_kriteria').addClass('is-invalid');
        valid=false;

    }

    if($('#edit_keterangan').val().trim()==''){

        $('#edit_keterangan').addClass('is-invalid');
        valid=false;

    }

    if(!valid){

        Swal.fire({
            icon:'warning',
            title:'Perhatian',
            text:'Lengkapi seluruh data.'
        });

        return;

    }

    $.ajax({

        url:"<?= base_url('kriteria/updateKriteria') ?>",

        type:"POST",

        dataType:"json",

        data:{

            id_kriteria:$('#edit_id_kriteria').val(),

            kode_kriteria:$('#edit_kode_kriteria').val(),

            nama_kriteria:$('#edit_nama_kriteria').val(),

            keterangan:$('#edit_keterangan').val()

        },

        success:function(res){

            if(res.status=='success'){

                $('#modalEditKriteria').modal('hide');

                Swal.fire({

                    icon:'success',

                    title:'Berhasil',

                    text:res.message,

                    timer:1200,

                    showConfirmButton:false

                }).then(function(){

                    $('#tabelKriteria').DataTable().ajax.reload(null,false);

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

        }

    });

});

   $(document).on('click','.btn-delete',function(){

    $('#delete_id_kriteria').val($(this).data('id'));

    $('#delete_kode').text($(this).data('kode'));

    $('#delete_nama').text($(this).data('nama'));

    $('#modalDeleteKriteria').modal('show');

});

   $('#btnDeleteKriteria').click(function(){

    $.ajax({

        url:"<?= base_url('kriteria/deleteKriteria') ?>",

        type:"POST",

        dataType:"json",

        data:{
            id_kriteria:$('#delete_id_kriteria').val()
        },

        success:function(res){

            if(res.status=='success'){

                $('#modalDeleteKriteria').modal('hide');

                Swal.fire({

                    icon:'success',

                    title:'Berhasil',

                    text:res.message,

                    timer:1200,

                    showConfirmButton:false

                }).then(function(){

                    $('#tabelKriteria').DataTable().ajax.reload(null,false);

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

   $(document).on('click','.btn-detail',function(){

    let id = $(this).data('id');

    let nama = $(this).data('nama');

    $('#namaKriteria').text(nama);

    $.ajax({

        url:"<?= base_url('kriteria/getDetailKriteria')?>",

        type:"GET",

        data:{
            id:id
        },

        dataType:"json",

        success:function(res){

            let html='';

            $.each(res,function(i,item){

                html += `

                    <tr>

                        <td>${i+1}</td>

                        <td>${item.kategori}</td>

                        <td>${item.nilai}</td>

                        <td class="text-center">
                            <span class="badge bg-success">
                                ${item.skor}
                            </span>
                        </td>

                        <td>${item.keterangan}</td>

                    </tr>

                `;

            });

            if(res.length==0){

                html=`
                <tr>

                    <td colspan="5"
                        class="text-center text-danger">

                        Belum ada data Nilai Kriteria.

                    </td>

                </tr>`;

            }

            $('#detailNilaiKriteria').html(html);

            $('#modalDetailKriteria').modal('show');

        }

    });

});
  //batas akhir
  });
</script>