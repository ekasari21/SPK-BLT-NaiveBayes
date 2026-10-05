                   <div class="card-body">
                    <?php foreach($kriteria as $k): ?>
                      <div class="col-md-12 mb-8">
                        <div class="card h-100 border-primary">
                          <div class="card-header">
                            <span class="badge bg-primary">
                              <?= esc($k['kode_kriteria']) ?>
                            </span>
                            <?= esc($k['nama_kriteria']) ?>
                            <br>
                          </div>
                          <div class="card-body">
                            <label class="form-label">

                              <b><?= esc($k['keterangan']) ?></b>
                            </label>
                            <select
                            class="form-select"
                            name="<?= strtolower($k['nama_kriteria']) ?>"
                            required>
                            <option value="">
                              -- Pilih <?= esc($k['nama_kriteria']) ?> --
                            </option>
                            <?php foreach($k['nilai'] as $n): ?>
                              <option value="<?= $n['skor']; ?>">
                                <?= $n['kategori']; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <small class="text-muted">

                            Pilih kondisi yang paling sesuai.
                          </small>
                          <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped mb-0">
                              <thead class="table-light">
                                <tr>
                                  <th width="20%">Skor</th>
                                  <th width="35%">Kategori</th>
                                  <th>Keterangan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($k['nilai'] as $n): ?>
                                  <tr>
                                    <td class="text-center">
                                      <span class="badge bg-primary">
                                        <?= $n['skor']; ?>
                                      </span>
                                    </td>
                                    <td>
                                      <?= esc($n['kategori']); ?>
                                    </td>
                                    <td>
                                      <?= esc($n['keterangan']); ?>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  <?php endforeach; ?>
                  <div class="col-md-12 mb-8">
                    <div class="card h-100 border-primary">
                      <div class="card-header">
                        <label class="form-label fw-bold">
                          Label Kelayakan <span class="text-danger">*</span>
                        </label>
                      </div>
                      <div class="card-body">
                        <select class="form-select" name="label" required>

                          <option value="">
                            -- Pilih Label --
                          </option>

                          <option value="Layak">
                            Layak Menerima BLT-DD
                          </option>

                          <option value="Tidak Layak">
                            Tidak Layak Menerima BLT-DD
                          </option>

                        </select>

                        <small class="text-muted">
                          Label digunakan sebagai kelas pada proses pelatihan
                          algoritma Naive Bayes.
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="card-footer">
                  <div class="col-md-12 mb-8">
                    <div class="d-flex justify-content-between">

                      <a href="<?= base_url('training') ?>"
                       class="btn btn-secondary">

                       <i class="bi bi-arrow-left"></i>

                       Kembali

                     </a>

                     <button type="submit"
                     class="btn btn-success">

                     <i class="bi bi-save"></i>

                     Simpan Data Training

                   </button>

                 </div>
               </div>
             </div>