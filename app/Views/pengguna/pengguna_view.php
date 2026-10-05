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
              <h3>Kelola Data Pengguna</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="card shadow">

          <div class="card-header">

            <h5 class="mb-0">
              <i class="bi bi-people-fill"></i>
              Kelola User
            </h5>

            <div class="d-flex justify-content-end">
              <!-- <button id="btnTambah" class="btn btn-primary"> -->
                <button type="button" id="btnTambahUser" class="btn btn-success">
                  <i class="bi bi-person-fill"></i>
                  Tambah User
                </button>
              </div>
            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped" id="tabelUser">

                <thead class="table-success">

                  <tr>

                    <th width="5%">No</th>

                    <th>Username</th>

                    <th>Role</th>

                    <th width="20%">Aksi</th>

                  </tr>

                </thead>

              </table>

            </div>

          </div>

        </div>

        <!---MODAL TAMBAH --->
        <div class="modal fade" id="modalUser" tabindex="-1">

          <div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                  <i class="bi bi-person-plus"></i>
                  Tambah Pengguna
                </h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>

              </div>

              <div class="modal-body">

                <form id="formUser">

                  <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                  </div>

                  <div class="mb-3">
                    <label>Password</label>
                    <div class="input-group">

                      <input type="password"
                      class="form-control"
                      id="password"
                      name="password"
                      autocomplete="new-password">

                      <button class="btn btn-outline-secondary"
                      type="button"
                      id="togglePassword">

                      <i class="bi bi-eye"></i>

                    </button>

                  </div>
                </div>

                <div class="mb-3">
                  <label>Role</label>

                  <select name="role" class="form-select">

                    <option value="">-- Pilih Role --</option>

                    <option value="admin">Admin</option>

                    <option value="kepala_desa">Kepala Desa</option>

                  </select>

                </div>

              </form>

            </div>

            <div class="modal-footer">

              <button class="btn btn-secondary"
              data-bs-dismiss="modal">
              Batal
            </button>

            <button class="btn btn-success"
            id="btnSimpanUser">

            <i class="bi bi-save"></i>
            Simpan

          </button>

        </div>

      </div>

    </div>

  </div>

  <div class="modal fade" id="modalEditUser" tabindex="-1">
    <div class="modal-dialog">
      <form id="formEditUser">

        <input type="hidden" name="id_user" id="edit_id_user">

        <div class="modal-content">

          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">
              Edit Pengguna
            </h5>

            <button type="button"
            class="btn-close"
            data-bs-dismiss="modal">
          </button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <label>Username</label>
            <input
            type="text"
            class="form-control"
            name="username"
            id="edit_username"
            required>
          </div>

          <div class="mb-3">
            <label>Password Baru</label>

            <div class="input-group">

              <input
              type="password"
              class="form-control"
              name="password"
              id="edit_password">

              <button class="btn btn-outline-secondary"
              type="button"
              id="togglePasswordEdit">

              <i class="bi bi-eye"></i>

            </button>

          </div>

          <small class="text-muted">
            Kosongkan jika password tidak diganti.
          </small>

        </div>

        <div class="mb-3">
          <label>Role</label>

          <select
          class="form-control"
          name="role"
          id="edit_role">

          <option value="admin">Admin</option>
          <option value="kepala_desa">Kepala Desa</option>

        </select>

      </div>

    </div>

    <div class="modal-footer">

      <button
      class="btn btn-secondary"
      data-bs-dismiss="modal"
      type="button">
      Batal
    </button>

    <button
    class="btn btn-info"
    type="submit">
    Simpan
  </button>

</div>

</div>

</form>
</div>
</div>

<script>
  $('#tabelUser').DataTable({

    processing: true,
    destroy: true,
    responsive: true,
    autoWidth: false,

    ajax: {
      url: "<?= base_url('pengguna/getDataUser') ?>",
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
        data: "username"
      },

      {
        data: "role",
        className: "text-center",
        render: function(data){

          if(data == "admin"){
            return '<span class="badge bg-danger">Admin</span>';
          }

          if(data == "kepala_desa"){
            return '<span class="badge bg-success">Kepala Desa</span>';
          }

          return '<span class="badge bg-secondary">'+data+'</span>';
        }
      },

      {
        data: null,
        className: "text-center",
        render: function(data){

          return `
                    <button class="btn btn-info btn-sm btnEdit"
                        data-id="${data.id_user}">
                        Edit <i class="bi bi-pencil-square"></i>
                    </button>


                    <button class="btn btn-warning btn-sm btnHapus"
                        data-id="${data.id_user}">
                        Hapus <i class="bi bi-trash"></i>
                    </button>
          `;
        }
      }

    ]

  });
  $("#btnSimpanUser").click(function(){

    $.ajax({

      url : "<?= base_url('pengguna/simpanPengguna') ?>",

      type : "POST",

      data : $("#formUser").serialize(),

      dataType : "json",

      success:function(res){

        if(res.status){

          $("#modalUser").modal("hide");

          Swal.fire({

            icon:'success',

            title:'Berhasil',

            text:res.message

          });

          $("#tabelUser").DataTable().ajax.reload(null,false);

        }else{

          Swal.fire({

            icon:'warning',

            title:'Peringatan',

            text:res.message

          });

        }

      },

      error:function(){

        Swal.fire({

          icon:'error',

          title:'Error',

          text:'Terjadi kesalahan server'

        });

      }

    });

  });
  $("#btnTambahUser").click(function(){

    $("#formUser")[0].reset();

    $("#modalUser").modal("show");

  });

  $("#togglePassword").click(function () {

    const password = $("#password");
    const icon = $(this).find("i");

    if (password.attr("type") === "password") {

      password.attr("type", "text");

      icon.removeClass("bi-eye");
      icon.addClass("bi-eye-slash");

    } else {

      password.attr("type", "password");

      icon.removeClass("bi-eye-slash");
      icon.addClass("bi-eye");

    }

  });


  $(document).on("click", ".btnEdit", function () {

    let id = $(this).data("id");

    $.ajax({

      url: "<?= base_url('pengguna/getUser') ?>/" + id,
      type: "GET",
      dataType: "json",

      success: function(res){

        $("#edit_id_user").val(res.id_user);
        $("#edit_username").val(res.username);
        $("#edit_role").val(res.role);
        $("#edit_password").val("");

        $("#modalEditUser").modal("show");

      }

    });

  });

  $("#formEditUser").submit(function(e){

    e.preventDefault();

    $.ajax({

      url:"<?= base_url('pengguna/update') ?>",

      type:"POST",

      data:$(this).serialize(),

      dataType:"json",

      success:function(res){

        if(res.status){

          $("#modalEditUser").modal("hide");

          Swal.fire({
            icon:"success",
            title:"Berhasil",
            text:res.message,
            timer:1500,
            showConfirmButton:false
          });

          $("#tabelUser").DataTable().ajax.reload(null,false);

        }

      },

      error:function(){

        Swal.fire(
          "Error",
          "Terjadi kesalahan.",
          "error"
          );

      }

    });

  });

  $("#togglePasswordEdit").click(function(){

    let input=$("#edit_password");

    let type=input.attr("type")=="password"
    ? "text"
    : "password";

    input.attr("type",type);

    $(this).find("i")
    .toggleClass("bi-eye bi-eye-slash");

  });

  // Hapus User
  $(document).on("click", ".btnHapus", function () {

    let id = $(this).data("id");

    Swal.fire({
      title: "Yakin?",
      text: "Data pengguna akan dihapus!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Ya, Hapus!",
      cancelButtonText: "Batal"
    }).then((result) => {

      if (result.isConfirmed) {

        $.ajax({
          url: "<?= base_url('pengguna/hapus') ?>",
          type: "POST",
          data: {
            id_user: id
          },
          dataType: "json",
          success: function(response){

            if(response.status){

              Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: response.message,
                timer: 1500,
                showConfirmButton: false
              }).then(() => {
                location.reload();
              });

                        // Reload DataTable
              tabelUser.ajax.reload(null, false);

            }else{

              Swal.fire(
                "Gagal",
                response.message,
                "error"
                );

            }

          },
          error:function(){

            Swal.fire(
              "Error",
              "Terjadi kesalahan pada server.",
              "error"
              );

          }
        });

      }

    });

  });
</script>
</main>
<?= view('dashboard/footer_view'); ?>