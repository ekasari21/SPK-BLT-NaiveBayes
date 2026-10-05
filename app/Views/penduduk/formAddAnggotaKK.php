<form action="<?= base_url('detailAnggota/simpanAnggotaKeluarga') ?>" method="post">
<div class="row">
    <!-- ================= KOLOM KIRI ================= -->
    <div class="col-md-6">
        <input type="hidden"
        name="id_kk"
        value="<?= $keluarga['id_kk']; ?>">
           <input type="hidden"
        name="no_kk"
        value="<?= $keluarga['no_kk']; ?>">

        <div class="mb-3">
            <label class="form-label fw-semibold">
                NIK <span class="text-danger">*</span>
            </label>

            <input type="text" name="nik" maxlength="16" minlength="16" class="form-control">
            <small class="text-muted">
                  Nomor KK terdiri dari 16 digit.
                </small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Lengkap <span class="text-danger">*</span>
            </label>

            <input type="text"
            name="nama"
            class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                Jenis Kelamin
            </label>

            <select name="jenis_kelamin"
            class="form-select">
            <option value="">-- Pilih --</option>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">
            Tanggal Lahir
        </label>

        <input type="date"
        name="tanggal_lahir"
        class="form-control">
    </div>
</div>

<!-- ================= KOLOM KANAN ================= -->
<div class="col-md-6">
    <div class="mb-3">
        <label class="form-label fw-semibold">
            Hubungan Keluarga
        </label>
        <select name="hubungan_keluarga" class="form-select" required>
            <option value="">-- Pilih Hubungan Keluarga --</option>

            <?php $selected_hub = $kepala['hubungan_keluarga'] ?? ''; ?>

            <?php foreach ($hubungan as $p): ?>
                <?php if ($p == 'Kepala Keluarga') continue; ?>

                <option value="<?= esc($p); ?>"
                    <?= ($p == $selected_hub) ? 'selected' : ''; ?>>
                    <?= esc($p); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">
            Pekerjaan
        </label>

        <select name="pekerjaan"
        class="form-select">

        <option value="">-- Pilih Pekerjaan --</option>

        <?php foreach($pekerjaan as $p): ?>

            <option value="<?= $p['id_pekerjaan']; ?>">
                <?= esc($p['nama_pekerjaan']); ?>
            </option>

        <?php endforeach; ?>

    </select>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">
        Penghasilan Pribadi
    </label>

    <input type="text"
    id="penghasilan"
    name="penghasilan"
    class="form-control">
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">
        Pendidikan Terakhir
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

<div class="text-end">

    <a href="<?= base_url('tambahanggota?no_kk='.$keluarga['no_kk']) ?>"
       class="btn btn-secondary">

       <i class="bi bi-arrow-left"></i>
       Kembali

   </a>

   <button type="submit"
   class="btn btn-success">

   <i class="bi bi-save"></i>
   Simpan Data Anggota

</button>
</div>
</form>