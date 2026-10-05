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
              <h3>Tambah Calon Data Training</h3>
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
                  <a href="<?= base_url('calonTraining'); ?>">
                    <!-- <button id="btnTambah" class="btn btn-primary"> -->
                      <button class="btn btn-secondary">
                        Kembali<i class="bi bi-arrow-left"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Card Filter -->
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="bi bi-search"></i>
            Pencarian Data Keluarga
        </h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <input type="text"
                class="form-control"
                id="keyword"
                placeholder="Masukkan Nama atau No KK">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100" id="btnCari">
                    <i class="bi bi-search"></i>
                    Cari
                </button>
            </div>

            <div class="col-md-2">
                <button class="btn btn-danger w-100" id="btnResetCheckbox">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset checkbox
                </button>
            </div>
        </div>
    </div>

</div>
<div class="card-body">
 
    <div class="alert alert-info mb-3">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Petunjuk:</strong> Untuk memilih dataset training, silakan centang (<i>check</i>) pada data yang akan digunakan sebagai data training.
    </div>
    <div class="table-responsive"><br>
        <table id="tabelCalonTraining" class="table table-bordered table-striped">
          <form>
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Jumlah Anggota</th>
                <th>Anggota Keluarga</th>
                <th>Alamat</th>
                <th>aksi</th>
            </tr>
        </thead>

    </form>
</table>
</div>
<!-- Label Training -->
<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Label Data Training
        </h5>

    </div>

    <div class="card-body">

        <div class="text-end">

            <button class="btn btn-secondary">

                <i class="bi bi-x-circle"></i>

                Batal

            </button>

            <button class="btn btn-primary" id="btnSimpanTraining">
                <i class="bi bi-save"></i>
                Simpan Data Training
            </button>

        </div>

    </div>

</div>
</div>
<div class="card-footer">

</div>
</div>
</div>
</div>


<script>
  $(document).ready(function () {
    let selectedKK = [];
    let table = $('#tabelCalonTraining').DataTable({

        processing: true,
        destroy: true,
        searching: false,

        ajax: {
            url: "<?= base_url('tambahCalonTraining/getCalonTraining') ?>",
            type: "GET",

            data: function(d){

                d.keyword = $("#keyword").val();

            },

            dataSrc: "data"
        },

        columns: [

            {
                data: null,
                render: function(data,type,row,meta){
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
                data: "jumlah_anggota"
            },


            {
                data: "anggota",
                render: function(data){

                    return data.join("<br>");

                }
            },
            {
                data: "alamat"
            },
            {
                data: "id_kk",
                render: function(data){
                    let checked = selectedKK.includes(data.toString()) ? "checked" : "";
                    return `
                    <input type="checkbox"
                           class="form-check-input chkKK"
                           value="${data}" ${checked}>
                    `;

                }
            }

        ]

    });
    $("#btnCari").click(function(){

        table.ajax.reload();

    });
    $("#keyword").keypress(function(e){

        if(e.which == 13){

            table.ajax.reload();

        }

    });
    $(document).on("change", ".chkKK", function(){

        let id = $(this).val();

        if($(this).is(":checked")){

            if(!selectedKK.includes(id)){
                selectedKK.push(id);
            }

        }else{

            selectedKK = selectedKK.filter(x => x != id);

        }

        console.log(selectedKK);

    });
    $("#btnResetCheckbox").click(function(){

        if(!confirm("Reset semua data yang dipilih?")){
            return;
        }

    // kosongkan array
        selectedKK = [];

    // hilangkan centang yang sedang tampil
        $(".chkKK").prop("checked", false);

    });

    $("#btnResetCheckbox").click(function(){

        if(!confirm("Reset semua data yang dipilih?")){
            return;
        }

    // kosongkan array
        selectedKK = [];

    // hilangkan centang yang sedang tampil
        $(".chkKK").prop("checked", false);

    });

    $("#btnSimpanTraining").click(function(){


        if(selectedKK.length == 0){

            Swal.fire({
                icon:"warning",
                title:"Peringatan",
                text:"Pilih minimal satu data."
            });

            return;
        }

        $.ajax({

            url:"<?= base_url('tambahCalonTraining/simpanTraining') ?>",
            type:"POST",

            data:{
                id_kk: selectedKK
            },

            dataType:"json",

            success:function(res){

                if(res.status){

                    Swal.fire({
                        icon:"success",
                        title:"Berhasil",
                        text:res.message
                    });

                    selectedKK = [];

                    table.ajax.reload(null,false);

                }else{

                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:res.message
                    });

                }

            }

        });

    });

//===================
});
</script>
</main>
<?= view('dashboard/footer_view'); ?>




