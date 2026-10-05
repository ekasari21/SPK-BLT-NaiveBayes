<div class="card-body">
    <div class="col-md-12 mb-3">
        <div class="card h-100 border-primary">

            <div class="card-header">
                <span class="badge bg-primary">1</span>
                Nama Kriteria
            </div>

            <div class="card-body">

                <label class="form-label">
                    <strong>Keterangan</strong>
                </label>

                <!-- Radio Button -->
                <div class="mb-3">
                    <?php foreach($kriteria as $k): ?>
                    <?php foreach($k['nilai'] as $n): ?>
                        <input class="form-check-input"
                               type="radio"
                               name="kriteria1"
                               id="kriteria1_1"
                               value="1"
                               required>

                        <label class="form-check-label" for="kriteria1_1">
                            <strong><?= $n['skor']; ?> - <?= $n['kategori']; ?></strong>
                            <br>
                            <small class="text-muted">
                                <?= $n['keterangan']; ?>
                            </small>
                        </label>

                    <?php endforeach; ?>

                    <div class="form-check mb-2">
                        <input class="form-check-input"
                               type="radio"
                               name="kriteria1"
                               id="kriteria1_1"
                               value="1"
                               required>

                        <label class="form-check-label" for="kriteria1_1">
                            <strong>Kategori 1</strong>
                            <br>
                            <small class="text-muted">
                                Keterangan kategori 1
                            </small>
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input"
                               type="radio"
                               name="kriteria1"
                               id="kriteria1_2"
                               value="2">

                        <label class="form-check-label" for="kriteria1_2">
                            <strong>Kategori 2</strong>
                            <br>
                            <small class="text-muted">
                                Keterangan kategori 2
                            </small>
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input"
                               type="radio"
                               name="kriteria1"
                               id="kriteria1_3"
                               value="3">

                        <label class="form-check-label" for="kriteria1_3">
                            <strong>Kategori 3</strong>
                            <br>
                            <small class="text-muted">
                                Keterangan kategori 3
                            </small>
                        </label>
                    </div>

                </div>

                <small class="text-muted">
                    Pilih kondisi yang paling sesuai.
                </small>

                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="20%">Skor</th>
                                <th width="35%">Kategori</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data kategori -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>