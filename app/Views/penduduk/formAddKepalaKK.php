 <div class="row">
              <!-- ================= DATA KEPALA KELUARGA ================= -->
              <div class="col-lg-12">
                <div class="card shadow-sm border-success h-100">
                  <div class="card shadow-sm border-0">

                    <div class="card-header bg-success text-white">
                      <h5 class="mb-0">
                        <i class="bi bi-person-fill"></i>
                        Data Kepala Keluarga
                      </h5>
                    </div>
                    <form id="formKepala">
                      <div class="card-body">

                        <input type="hidden" name="id_kk" value="<?= $keluarga['id_kk'] ?>">
                        
                        <div class="row">

                          <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                              NIK Kepala Keluarga <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nik" value="<?= $kepala['nik'] ?? '';  ?>" maxlength="16" minlength="16" class="form-control" placeholder="Masukkan NIK" required>
                            <small class="text-muted"> Nomor KK terdiri dari 16 digit.</small>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                              Nama Kepala Keluarga <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="<?= $kepala['nama'] ?? '';  ?>" required>
                            <input type="text"name="hubungan_keluarga" value="Kepala Keluarga" class="form-control" hidden>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                              Tanggal Lahir<span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tgl_lahir" value="<?=$kepala['tanggal_lahir'] ?? '';  ?>" class="form-control" required>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                              Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <?php $selectedJk = $kepala['jenis_kelamin'] ?? ''; ?>

                            <select name="jenis_kelamin" class="form-select" required>
                              <option value="">-- Pilih Jenis Kelamin --</option>

                              <?php foreach ($jenisKelamin as $jk): ?>
                                <option value="<?= $jk; ?>"
                                  <?= ($jk == $selectedJk) ? 'selected' : ''; ?>>

                                  <?= ($jk == 'L') ? 'Laki-Laki' : 'Perempuan'; ?>

                                </option>
                              <?php endforeach; ?>

                            </select>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                              Pekerjaan<span class="text-danger">*</span>
                            </label>
                            <select name="pekerjaan_kepala" id="pekerjaan_kepala" class="form-select" value=" <?= $kepala['id_pekerjaan'] ?? ''; ?>" required>

                              <option value="">-- Pilih Pekerjaan --</option>
                              <?php
                              $selectedPekerjaan = $kepala['id_pekerjaan'] ?? '';
                              ?>
                              <?php foreach($pekerjaan as $p): ?>
                                <option value="<?= $p['id_pekerjaan']; ?>"
                                  <?= ($p['id_pekerjaan'] == $selectedPekerjaan) ? 'selected' : ''; ?>>
                                  <?= esc($p['nama_pekerjaan']); ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                              Penghasilan <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="penghasilan" name="penghasilan" class="form-control"  placeholder="Masukkan Penghasilan" value="<?= !empty($kepala['penghasilan_pribadi']) ? number_format($kepala['penghasilan_pribadi'], 0, ',', '.') : ''; ?>" required>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">
                              Pendidikan <span class="text-danger">*</span>
                            </label>

                            <?php $selected = $kepala['pendidikan'] ?? ''; ?>

                            <select name="pendidikan" class="form-select" required>
                              <option value="">-- Pilih Pendidikan --</option>

                              <?php foreach ($pendidikan as $p): ?>
                                <option value="<?= esc($p); ?>"
                                  <?= ($p == $selected) ? 'selected' : ''; ?>>
                                  <?= esc($p); ?>
                                </option>
                              <?php endforeach; ?>

                            </select>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="card-footer bg-light">

                    <div class="d-flex justify-content-between align-items-center">

                      <small class="text-muted">
                        <span class="text-danger">*</span> Wajib diisi
                      </small>

                      <div>
                        <button type="submit" class="btn btn-primary" id="btnSimpanKepala">
                          <i class="bi bi-save"></i>
                          Perbaharui Kepala Keluarga
                        </button>
                      </div>

                    </div>

                  </div>

                </div>
              </div>
            </div>