<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Masuk – SPK Bantuan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
:root{
  --ink:#0d2640; --blue:#0b4a94; --blue-d:#08376f; --orange:#f29400;
  --paper:#f5f8fc; --line:#dbe4ee; --muted:#52667d; --bad:#b4372f;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Figtree',system-ui,sans-serif;color:var(--ink);background:#fff;font-size:17px;line-height:1.6;min-height:100vh}
h1,h2{font-family:'Bricolage Grotesque',sans-serif;line-height:1.1;letter-spacing:-.02em}
a{color:inherit}
:focus-visible{outline:3px solid var(--orange);outline-offset:3px;border-radius:6px}

.page{display:grid;grid-template-columns:1fr 1fr;min-height:100vh}

/* kiri: identitas */
.side{background:var(--ink);color:#fff;padding:48px 56px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
.side::after{content:"";position:absolute;right:-120px;bottom:-120px;width:380px;height:380px;border-radius:50%;border:56px solid #12365a}
.brand{display:flex;align-items:center;gap:10px;text-decoration:none;font:800 1.3rem 'Bricolage Grotesque'}
.brand img{height:44px;width:44px;object-fit:contain;background:#fff;border-radius:12px;padding:4px}
.brand span{color:var(--orange)}
.side h1{font-size:clamp(2rem,3.4vw,3rem);font-weight:800;max-width:11em;margin-bottom:16px;position:relative;z-index:1}
.side p{color:#a9bbd0;max-width:28em;position:relative;z-index:1}

/* kanan: form */
.main{display:flex;align-items:center;justify-content:center;padding:40px 24px;background:linear-gradient(180deg,var(--paper),#fff)}
.box{width:100%;max-width:400px}
.mobile-brand{display:none;margin-bottom:28px;color:var(--blue)}
.box h2{font-size:2rem;font-weight:800;margin-bottom:6px}
.box .sub{color:var(--muted);margin-bottom:28px}

.alert{display:flex;gap:10px;align-items:flex-start;background:#fdecea;color:var(--bad);border:1px solid #f3c4bf;border-radius:12px;padding:12px 14px;margin-bottom:20px;font-size:.95rem}

.field{margin-bottom:18px}
label{display:block;font-weight:600;font-size:.95rem;margin-bottom:6px}
.control{position:relative}
.control>i.lead{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);pointer-events:none}
input,select{width:100%;height:50px;padding:0 14px 0 42px;border:1.5px solid var(--line);border-radius:12px;background:#fff;font:500 1rem 'Figtree',sans-serif;color:var(--ink);transition:border-color .2s,box-shadow .2s;appearance:none;-webkit-appearance:none}
select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%2352667d' viewBox='0 0 16 16'%3E%3Cpath d='M1.6 5.1a.8.8 0 0 1 1.1 0L8 10.4l5.3-5.3a.8.8 0 1 1 1.1 1.1l-5.9 5.9a.8.8 0 0 1-1.1 0L1.6 6.2a.8.8 0 0 1 0-1.1z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:40px}
select:invalid{color:var(--muted)}
input:hover,select:hover{border-color:#b9c8d9}
input:focus,select:focus{outline:0;border-color:var(--blue);box-shadow:0 0 0 4px rgba(11,74,148,.14)}
.eye{position:absolute;right:6px;top:50%;transform:translateY(-50%);width:40px;height:40px;border:0;background:none;color:var(--muted);font-size:1.1rem;cursor:pointer;border-radius:10px}
.eye:hover{color:var(--blue)}
#password{padding-right:48px}

.btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;height:52px;margin-top:8px;border:0;border-radius:999px;background:var(--blue);color:#fff;font:600 1.05rem 'Figtree',sans-serif;cursor:pointer;transition:background .2s}
.btn:hover{background:var(--blue-d)}
.back{display:inline-flex;align-items:center;gap:6px;margin-top:26px;color:var(--muted);text-decoration:none;font-weight:500;font-size:.95rem}
.back:hover{color:var(--blue)}

@media(max-width:860px){
  .page{grid-template-columns:1fr}
  .side{display:none}
  .mobile-brand{display:flex}
  .main{align-items:flex-start;padding-top:48px}
}
@media(prefers-reduced-motion:reduce){*{transition:none!important}}
</style>
</head>
<body>

<div class="page">
  <aside class="side">
    <a class="brand" href="<?= base_url('index'); ?>">
      <img src="dist/assets/img/icon-landing.png" alt="">SPK <span>Bantuan</span>
    </a>
    <div>
      <h1>Kelola penilaian bantuan desa dengan data.</h1>
      <p>Masuk untuk mengelola data warga dan melihat hasil klasifikasi kelayakan penerima bantuan.</p>
    </div>
    <span style="color:#7f95ad;font-size:.9rem;position:relative;z-index:1">Sistem Pendukung Keputusan &middot; Naïve Bayes Classifier</span>
  </aside>

  <main class="main">
    <div class="box">
      <a class="brand mobile-brand" href="<?= base_url('index'); ?>">
        <img src="dist/assets/img/icon-landing.png" alt="" style="background:none;padding:0">SPK <span>Bantuan</span>
      </a>

      <h2>Masuk ke sistem</h2>
      <p class="sub">Pilih level pengguna, lalu isi akun Anda.</p>

      <?php if(session()->getFlashdata('error')): ?>
      <div class="alert" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        <span><?= session()->getFlashdata('error') ?></span>
      </div>
      <?php endif; ?>

      <form action="<?= base_url('login/auth') ?>" method="post">
        <div class="field">
          <label for="role">Level user</label>
          <div class="control">
            <i class="bi bi-person-badge lead"></i>
            <select name="role" id="role" required>
              <option value="" selected disabled>Pilih level user</option>
              <option value="admin">Administrator</option>
              <option value="kepala_desa">Kepala Desa</option>
            </select>
          </div>
        </div>

        <div class="field">
          <label for="username">Username</label>
          <div class="control">
            <i class="bi bi-person lead"></i>
            <input type="text" name="username" id="username" autocomplete="username" required>
          </div>
        </div>

        <div class="field">
          <label for="password">Password</label>
          <div class="control">
            <i class="bi bi-lock lead"></i>
            <input type="password" name="password" id="password" autocomplete="current-password" required>
            <button type="button" class="eye" id="eye" aria-label="Tampilkan password"><i class="bi bi-eye"></i></button>
          </div>
        </div>

        <button class="btn" type="submit"><i class="bi bi-box-arrow-in-right"></i>Masuk</button>
      </form>

      <a class="back" href="<?= base_url('index'); ?>"><i class="bi bi-arrow-left"></i>Kembali ke beranda</a>
    </div>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var messages = {
    role: 'Silakan pilih level user',
    username: 'Username wajib diisi',
    password: 'Password wajib diisi'
  };

  document.querySelectorAll('[required]').forEach(function (el) {
    el.addEventListener('invalid', function () {
      this.setCustomValidity(messages[this.name] || 'Kolom ini wajib diisi');
    });
    el.addEventListener('input', function () { this.setCustomValidity(''); });
    el.addEventListener('change', function () { this.setCustomValidity(''); });
  });

  var pw = document.getElementById('password'), eye = document.getElementById('eye');
  eye.addEventListener('click', function () {
    var show = pw.type === 'password';
    pw.type = show ? 'text' : 'password';
    eye.innerHTML = '<i class="bi bi-eye' + (show ? '-slash' : '') + '"></i>';
    eye.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
  });
});
</script>
</body>
</html>