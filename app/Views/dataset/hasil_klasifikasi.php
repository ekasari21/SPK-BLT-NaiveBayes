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

                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            <i class="bi bi-bar-chart-line-fill"></i>
                            Hasil Klasifikasi Naive Bayes
                        </h3>
                    </div>

                    <div class="col-sm-6 text-end">

                        <a href="<?= base_url('prosesklasifikasi'); ?>" class="btn btn-success">

                            <i class="bi bi-play-circle"></i>

                            Proses Klasifikasi

                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- Content -->

        <div class="app-content">

            <div class="container-fluid">

                <!-- Ringkasan -->

                <div class="row">

                    <div class="col-lg-3 col-md-6">

                        <div class="card text-bg-primary">

                            <div class="card-body text-center">

                                <h2 id="totalData">0</h2>

                                <h6>Total Data</h6>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="card text-bg-success">

                            <div class="card-body text-center">

                                <h2 id="totalLayak">0</h2>

                                <h6>Layak</h6>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="card text-bg-danger">

                            <div class="card-body text-center">

                                <h2 id="totalTidakLayak">0</h2>

                                <h6>Tidak Layak</h6>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="card text-bg-warning">

                            <div class="card-body text-center">

                                <h2 id="akurasi">-</h2>

                                <h6>Akurasi</h6>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Filter -->

                <div class="card shadow-sm mt-3">

                    <div class="card-header">

                        <i class="bi bi-search"></i>

                        Pencarian Data

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">

                                <label class="form-label">

                                    Nomor KK

                                </label>

                                <input type="text"
                                       id="cariKK"
                                       class="form-control"
                                       placeholder="Masukkan Nomor KK">

                            </div>

                            <div class="col-md-3">

                                <label class="form-label">

                                    Hasil Prediksi

                                </label>

                                <select
                                    id="filterHasil"
                                    class="form-select">

                                    <option value="">
                                        Semua
                                    </option>

                                    <option value="Layak">
                                        Layak
                                    </option>

                                    <option value="Tidak Layak">
                                        Tidak Layak
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-5 d-flex align-items-end">

                                <button
                                    id="btnCari"
                                    class="btn btn-primary me-2">

                                    <i class="bi bi-search"></i>

                                    Cari

                                </button>

                                <button
                                    id="btnRefresh"
                                    class="btn btn-secondary me-2">

                                    <i class="bi bi-arrow-clockwise"></i>

                                    Refresh

                                </button>

                                <button
                                    class="btn btn-success">

                                    <i class="bi bi-file-earmark-excel"></i>

                                    Export Excel

                                </button>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Data -->

                <div class="card shadow-sm mt-3">

                    <div class="card-header">

                        <i class="bi bi-table"></i>

                        Data Hasil Klasifikasi

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table
                                id="tblHasil"
                                class="table table-bordered table-striped align-middle">

                                <thead class="table-success">

                                <tr>

                                    <th>No</th>

                                    <th>Nomor KK</th>

                                    <th>Kepala Keluarga</th>

                                    <th>Label Aktual</th>

                                    <th>Hasil Prediksi</th>

                                    <th>Status</th>

                                    <th width="120">Aksi</th>

                                </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

    <?= view('dashboard/footer_view'); ?>

</div>

