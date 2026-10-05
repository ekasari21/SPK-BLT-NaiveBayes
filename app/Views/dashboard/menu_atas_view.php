<?php
// Data pengguna dari session (sesuaikan key jika di controller login Anda berbeda)
$username  = session()->get('username') ?? 'Pengguna';
$role      = session()->get('role');
$roleLabel = ['admin' => 'Administrator', 'kepala_desa' => 'Kepala Desa'][$role] ?? 'Pengguna';
$initial   = strtoupper(mb_substr($username, 0, 1));
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  /* Penyesuaian tema SPK Bantuan untuk header AdminLTE */
  .app-header{
    --spk-ink:#0d2640; --spk-blue:#0b4a94; --spk-orange:#f29400; --spk-line:#dbe4ee; --spk-muted:#52667d;
    background:#fff !important;
    border-bottom:1px solid var(--spk-line);
    font-family:'Figtree',system-ui,sans-serif;
  }
  .app-header .nav-link{color:var(--spk-muted);font-weight:500}
  .app-header .nav-link:hover,
  .app-header .nav-link:focus-visible{color:var(--spk-blue)}
  .app-header .nav-link:focus-visible,
  .app-header .btn:focus-visible{outline:3px solid var(--spk-orange);outline-offset:2px;border-radius:8px}

  .spk-title{
    font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:1.1rem;
    color:var(--spk-blue);letter-spacing:-.01em;padding-left:.5rem;
  }
  .spk-title span{color:var(--spk-orange)}

  .spk-avatar{
    width:36px;height:36px;border-radius:50%;background:var(--spk-blue);color:#fff;
    display:inline-grid;place-items:center;font:800 1rem 'Bricolage Grotesque',sans-serif;flex:none;
  }
  .app-header .user-menu>.nav-link{display:flex;align-items:center;gap:10px;line-height:1.2}
  .spk-who{display:flex;flex-direction:column;text-align:left}
  .spk-who b{color:var(--spk-ink);font-weight:600;font-size:.95rem}
  .spk-who small{color:var(--spk-muted);font-size:.78rem}

  .app-header .user-menu>.dropdown-menu{
    border:1px solid var(--spk-line);border-radius:16px;overflow:hidden;
    box-shadow:0 24px 48px -24px rgba(11,74,148,.35);padding:0;min-width:260px;
  }
  .app-header .user-menu .user-header{
    background:var(--spk-ink) !important;color:#fff;height:auto;padding:22px 20px;text-align:center;
  }
  .app-header .user-menu .user-header .spk-avatar{
    width:64px;height:64px;font-size:1.7rem;background:var(--spk-orange);color:#1b1200;margin-bottom:10px;
  }
  .app-header .user-menu .user-header p{margin:0;font-weight:600;color:#fff}
  .app-header .user-menu .user-header small{display:block;color:#a9bbd0;font-weight:400;margin-top:2px}
  .app-header .user-menu .user-footer{background:#fff;padding:14px 16px}
  .spk-logout{
    display:flex;align-items:center;justify-content:center;gap:8px;width:100%;
    border:1.5px solid #f0c4bf;border-radius:999px;color:#b4372f;background:#fff;
    padding:9px 16px;font-weight:600;text-decoration:none;transition:background .2s,color .2s,border-color .2s;
  }
  .spk-logout:hover{background:#b4372f;border-color:#b4372f;color:#fff}
  @media (prefers-reduced-motion:reduce){.spk-logout{transition:none}}
</style>

<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Buka atau tutup menu samping">
          <i class="bi bi-list fs-4"></i>
        </a>
      </li>
      <li class="nav-item d-none d-md-block">
        <span class="spk-title">SPK <span>Bantuan 1</span></span>
      </li>
      <li class="nav-item d-none d-md-block ms-3">
        <a href="<?= base_url('index'); ?>" class="nav-link"><i class="bi bi-house me-1"></i>Beranda</a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->

    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto align-items-center">
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen" aria-label="Layar penuh">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>
<!--end::Header-->