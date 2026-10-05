<?= view('dashboard/header_view'); ?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div id="alertBox"></div>

    <div class="app-wrapper">

        <?= view('dashboard/sidebar_view'); ?>

        <main class="app-main">

            <!-- Header -->
            <div class="app-content-header">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-sm-12">
                            <h2 class="text-danger mb-3">
                                Akses Ditolak
                            </h2>
                        </div>
                        <div class="col-sm-12">
                           <p class="lead">
                            Data keluarga yang dipilih <strong>tidak dapat dilakukan Set Kriteria</strong>.
                        </p>

                        <div class="alert alert-warning mt-4">
                            Kemungkinan penyebab:
                            <ul class="text-start mb-0 mt-2">
                                <li>Data bukan merupakan Dataset Training.</li>
                                <li>Data telah dihapus dari Dataset Training.</li>
                                <li>Data tidak ditemukan.</li>
                            </ul>
                        </div>

                        <a href="<?= base_url('calonTraining') ?>" class="btn btn-primary mt-3">
                            ← Kembali ke Daftar Data Training
                        </a>
                    </div>

                </div>

            </div>

        </div>


    </main>

    <?= view('dashboard/footer_view'); ?>

</div>

