<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Penerimaan BLT-DD Desa Ngrancah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .bg-success-gradient {
            background: linear-gradient(135deg, #198754 0%, #0f5132 100%);
        }
        .card-custom {
            border: none;
            border-radius: 15px;  
        }
    </style>
</head>
<body>

    <div class="bg-success-gradient text-white py-4 mb-5 shadow-sm">
        <div class="container text-center">
            <a href="<?= base_url('/index'); ?>" class="text-white text-decoration-none d-inline-flex align-items-center mb-2">
                <i class="bi bi-arrow-left-circle me-2 fs-5"></i> Kembali ke Beranda
            </a>
            <h2 class="fw-bold m-0">Pencarian Status KPM BLT-DD</h2>
            <p class="lead small mb-0">Desa Ngrancah - Pengambilan Keputusan Berbasis Naïve Bayes Classifier</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">

                <div class="card card-custom shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-search-heart fs-3"></i>
                            </div>
                            <h4 class="fw-bold">Periksa Kelayakan Anda</h4>
                            <p class="text-muted small">Masukkan 16 digit Nomor Kartu Keluarga (KK) yang terdaftar secara sah pada basis data desa.</p>
                        </div>
                        <form id="formCekStatus" class="needs-validation" novalidate>

                            <div class="mb-4">
                                <label for="no_kk" class="form-label fw-bold text-secondary">
                                    Nomor Kartu Keluarga (KK)
                                </label>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light text-muted border-end-0">
                                        <i class="bi bi-card-list"></i>
                                    </span>

                                    <input
                                    type="text"
                                    class="form-control bg-light border-start-0 fs-5 text-center fw-bold"
                                    id="no_kk"
                                    name="no_kk"
                                    placeholder="340xxxxxxxxxxxxx"
                                    maxlength="16"
                                    pattern="[0-9]{16}"
                                    required>

                                    <div class="invalid-feedback text-center">
                                        Nomor KK harus terdiri dari 16 digit angka.
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                            class="btn btn-success btn-lg w-100 fw-bold shadow-sm py-3"
                            id="btnCekStatus">
                            <i class="bi bi-shield-shaded me-2"></i>
                            Cek Status Kelayakan
                        </button>

                    </form>
                </div>
            </div>

            <div id="sectionHasil" class="d-none">

                <div class="card shadow">

                    <div class="card-body">

                        <h4 id="judulStatus"></h4>

                        <hr>

                        <p>
                            Nomor KK :
                            <strong id="hasilKK"></strong>
                        </p>

                        <p>
                            Status :
                            <strong id="hasilKelayakan"></strong>
                        </p>

                        <p>
                            Probabilitas Layak :
                            <strong id="probLayak"></strong>
                        </p>

                        <p>
                            Probabilitas Tidak Layak :
                            <strong id="probTidakLayak"></strong>
                        </p>

                        <div id="statusPersetujuan"></div>

                    </div>

                </div>

            </div>

            <div class="text-center text-muted small mt-4 mb-5">
                <p><i class="bi bi-lock-fill text-success me-1"></i> Data Anda dienkripsi aman. Sistem ini hanya mencocokkan parameter klasifikasi internal desa.</p>
            </div>

        </div>
    </div>
</div>

<script
src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
crossorigin="anonymous"
></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
        // Validasi Form Bootstrap
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    $(document).ready(function () {

        $("#formCekStatus").submit(function (e) {

            e.preventDefault();

            let noKK = $("#no_kk").val().trim();

        // Validasi
            if (noKK == "") {
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Masukkan Nomor KK."
                });
                return;
            }

            if (noKK.length != 16) {
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Nomor KK harus terdiri dari 16 digit."
                });
                return;
            }

            $.ajax({

                url: "<?= base_url('cekStatusKelayakan') ?>",

                type: "POST",

                dataType: "json",

                data: {
                    no_kk: noKK
                },

                beforeSend: function () {

                    $("#btnCekStatus")
                    .prop("disabled", true)
                    .html('<span class="spinner-border spinner-border-sm me-2"></span>Memproses...');

                },

                success: function (res) {

                    if (!res.status) {

                        $("#sectionHasil").addClass("d-none");

                        Swal.fire({
                            icon: "error",
                            title: "Data Tidak Ditemukan",
                            text: res.message
                        });

                        return;
                    }

                    let data = res.data;

                    $("#sectionHasil").removeClass("d-none");

                    $("#hasilKK").text(data.no_kk);

                    $("#probLayak").text(data.probabilitas_layak ?? "-");

                    $("#probTidakLayak").text(data.probabilitas_tidak_layak ?? "-");

                //-------------------------------------------------------
                // STATUS KELAYAKAN
                //-------------------------------------------------------

                    if (data.hasil == "Layak" && data.status_persetujuan=="Ditolak") {
                         $("#probLayak").text("-");

                    $("#probTidakLayak").text("-");
                        $("#judulStatus")
                        .removeClass()
                        .addClass("fw-bold text-danger")
                        .html('<i class="bi bi-check-circle-fill"></i> TIDAK TEREKOMENDASIKAN MENDAPAT BANTUAN');

                        $("#hasilKelayakan")
                        .html('<span class="badge bg-danger">TIDAK DIREKOMENDASIKAN LAYAK MENERIMA BANTUAN</span>');

                    } else if (data.hasil == "Layak" && data.status_persetujuan=="Disetujui") {

                        $("#judulStatus")
                        .removeClass()
                        .addClass("fw-bold text-Success")
                        .html('<i class="bi bi-check-circle-fill"></i> TEREKOMENDASIKAN LAYAK');

                        $("#hasilKelayakan")
                        .html('<span class="badge bg-success">LAYAK</span>');

                    }else if (data.hasil == "Tidak Layak") {

                        $("#judulStatus")
                        .removeClass()
                        .addClass("fw-bold text-danger")
                        .html('<i class="bi bi-x-circle-fill"></i> BELUM MEMENUHI KRITERIA');

                        $("#hasilKelayakan")
                        .html('<span class="badge bg-danger">TIDAK LAYAK</span>');

                    } else {

                        $("#judulStatus")
                        .removeClass()
                        .addClass("fw-bold text-warning")
                        .html('<i class="bi bi-hourglass-split"></i> BELUM DIPROSES');

                        $("#hasilKelayakan")
                        .html('<span class="badge bg-warning text-dark">BELUM DIPROSES</span>');
                    }

                //-------------------------------------------------------
                // STATUS PERSETUJUAN
                //-------------------------------------------------------

                    if (data.status_persetujuan == "Disetujui") {

                        $("#statusPersetujuan").html(`
                        <div class="alert alert-success mt-3">
                            <i class="bi bi-patch-check-fill me-2"></i>
                            Data telah <strong>ditetapkan sebagai penerima BLT-DD</strong>.
                        </div>
                        `);

                    } else if(data.status_persetujuan=="Ditolak"){

                        $("#statusPersetujuan").html(`
                        <div class="alert alert-danger mt-3">
                            <i class="bi bi-patch-check-fill me-2"></i>
                            Data anda <strong> ditolak sebagai penerima BLT-DD</strong>.
                            <br>
                            <strong>Catatan:</strong> Informasi lebih lanjut mengenai hasil rekomendasi dan status penerimaan BLT-DD, silakan menghubungi Pemerintah Desa Ngrancah melalui perangkat desa atau pihak yang berwenang.
                        </div>
                        `);
                    }else {

                        $("#statusPersetujuan").html(`
                        <div class="alert alert-warning mt-3">
                            <i class="bi bi-hourglass me-2"></i>
                            Data <strong>belum mendapatkan persetujuan</strong> dari Kepala Desa.
                        </div>
                        `);

                    }

                    $("html, body").animate({

                        scrollTop: $("#sectionHasil").offset().top - 80

                    }, 500);

                },

                error: function (xhr) {

                    console.log(xhr.responseText);

                    Swal.fire({
                        icon: "error",
                        title: "Terjadi Kesalahan",
                        text: "Gagal mengambil data dari server."
                    });

                },

                complete: function () {

                    $("#btnCekStatus")
                    .prop("disabled", false)
                    .html('<i class="bi bi-shield-shaded me-2"></i>Cek Status Kelayakan');

                }

            });

});

});
</script>
</body>
</html>