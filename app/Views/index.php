<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SPK Bantuan – Sistem Pendukung Keputusan Penerima Bantuan Desa</title>
<meta name="description" content="Sistem pendukung keputusan untuk menentukan kelayakan penerima bantuan desa dengan metode Naïve Bayes Classifier.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
:root{
  --ink:#0d2640; --blue:#0b4a94; --blue-d:#08376f; --orange:#f29400; --orange-d:#c97a00;
  --paper:#f5f8fc; --white:#fff; --line:#dbe4ee; --muted:#52667d; --ok:#14804a; --bad:#b4372f;
  --r:14px;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;scroll-padding-top:80px}
body{font-family:'Figtree',system-ui,sans-serif;color:var(--ink);background:var(--white);line-height:1.6;font-size:17px}
h1,h2,h3{font-family:'Bricolage Grotesque',sans-serif;line-height:1.1;letter-spacing:-.02em}
a{color:inherit}
.wrap{max-width:1160px;margin:0 auto;padding:0 24px}
:focus-visible{outline:3px solid var(--orange);outline-offset:3px;border-radius:6px}

/* nav */
.nav{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.9);backdrop-filter:blur(10px);border-bottom:1px solid var(--line)}
.nav .wrap{display:flex;align-items:center;justify-content:space-between;height:68px}
.brand{display:flex;align-items:center;gap:10px;text-decoration:none;font-family:'Bricolage Grotesque';font-weight:800;font-size:1.3rem;color:var(--blue)}
.brand img{height:40px;width:40px;object-fit:contain}
.brand span{color:var(--orange)}
.menu{display:flex;align-items:center;gap:28px;list-style:none}
.menu a{text-decoration:none;font-weight:500;color:var(--muted)}
.menu a:hover{color:var(--blue)}
.btn{display:inline-flex;align-items:center;gap:8px;padding:12px 22px;border-radius:999px;font-weight:600;text-decoration:none;border:2px solid transparent;transition:background .2s,color .2s,border-color .2s}
.btn-primary{background:var(--blue);color:#fff}
.btn-primary:hover{background:var(--blue-d)}
.btn-accent{background:var(--orange);color:#1b1200}
.btn-accent:hover{background:#ffa51f}
.btn-line{border-color:var(--line);color:var(--ink);background:#fff}
.btn-line:hover{border-color:var(--blue);color:var(--blue)}
.menu .btn{padding:9px 18px;color:#fff}
.burger{display:none;background:none;border:0;font-size:1.7rem;color:var(--ink);cursor:pointer}

/* hero */
.hero{background:linear-gradient(180deg,var(--paper),#fff);padding:80px 0 96px;overflow:hidden}
.hero .wrap{display:grid;grid-template-columns:1.05fr .95fr;gap:64px;align-items:center}
.hero h1{font-size:clamp(2.4rem,5vw,3.9rem);font-weight:800;color:var(--ink);margin-bottom:22px}
.hero p.lead{font-size:1.15rem;color:var(--muted);max-width:34em;margin-bottom:32px}
.hero p.lead strong{color:var(--ink)}
.actions{display:flex;flex-wrap:wrap;gap:14px}
.facts{display:flex;flex-wrap:wrap;gap:12px 28px;margin-top:40px;color:var(--muted);font-size:.95rem}
.facts span{display:flex;align-items:center;gap:8px}
.facts i{color:var(--blue)}

/* live demo card */
.demo{background:#fff;border:1px solid var(--line);border-radius:20px;box-shadow:0 30px 60px -30px rgba(11,74,148,.35);padding:26px}
.demo-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;gap:12px;flex-wrap:wrap}
.demo-head h3{font-size:1.05rem}
.tabs{display:flex;background:var(--paper);border-radius:999px;padding:4px}
.tabs button{border:0;background:none;padding:7px 14px;border-radius:999px;font:600 .85rem 'Figtree';color:var(--muted);cursor:pointer}
.tabs button[aria-selected=true]{background:var(--blue);color:#fff}
.rows{list-style:none;border-top:1px solid var(--line)}
.rows li{display:flex;justify-content:space-between;gap:12px;padding:10px 0;border-bottom:1px solid var(--line);font-size:.95rem}
.rows li span:first-child{color:var(--muted)}
.rows li span:last-child{font-weight:600;text-align:right}
.result{margin-top:20px;border-radius:var(--r);padding:18px;background:var(--paper);transition:background .3s}
.result .verdict{display:flex;align-items:center;gap:10px;font-family:'Bricolage Grotesque';font-weight:800;font-size:1.5rem}
.result.ok .verdict{color:var(--ok)}
.result.no .verdict{color:var(--bad)}
.bar{height:10px;border-radius:99px;background:#e3eaf2;overflow:hidden;margin-top:6px}
.bar i{display:block;height:100%;border-radius:99px;transition:width .5s ease}
.pl{display:flex;justify-content:space-between;font-size:.85rem;color:var(--muted);margin-top:12px}
.note{font-size:.8rem;color:var(--muted);margin-top:14px}

/* sections */
section{padding:96px 0}
.head{max-width:640px;margin-bottom:56px}
.head h2{font-size:clamp(1.9rem,3.6vw,2.7rem);font-weight:800;margin-bottom:14px}
.head p{color:var(--muted)}

.why{display:grid;grid-template-columns:repeat(3,1fr);border-top:2px solid var(--ink)}
.why article{padding:28px 28px 8px 0}
.why article+article{padding-left:28px;border-left:1px solid var(--line)}
.why i{font-size:1.9rem;color:var(--orange)}
.why h3{font-size:1.3rem;margin:14px 0 10px}
.why p{color:var(--muted)}

.flow{background:var(--ink);color:#fff}
.flow .head p{color:#a9bbd0}
.flow .grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center}
.steps{list-style:none;counter-reset:s}
.steps li{counter-increment:s;position:relative;padding:0 0 32px 64px}
.steps li::before{content:counter(s);position:absolute;left:0;top:0;width:44px;height:44px;border-radius:50%;background:var(--orange);color:#1b1200;display:grid;place-items:center;font:800 1.1rem 'Bricolage Grotesque'}
.steps li::after{content:"";position:absolute;left:21px;top:50px;bottom:6px;width:2px;background:#2b4a6c}
.steps li:last-child::after{display:none}
.steps h3{font-size:1.25rem;margin-bottom:6px}
.steps p{color:#a9bbd0}
.steps b.ok{color:#5be39b}.steps b.no{color:#ff9b93}
.formula{background:#12365a;border:1px solid #234a73;border-radius:20px;padding:36px;text-align:center}
.formula .eq{font:600 1.5rem/1.4 'Bricolage Grotesque';margin:18px 0 22px}
.formula .eq sub{font-size:.7em}
.formula dl{display:grid;grid-template-columns:auto 1fr;gap:8px 16px;text-align:left;color:#c6d4e4;font-size:.92rem}
.formula dt{color:var(--orange);font-weight:600}

.crit{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.crit div{display:flex;align-items:center;gap:14px;padding:18px;border:1px solid var(--line);border-radius:var(--r);background:#fff;font-weight:600}
.crit i{width:44px;height:44px;border-radius:12px;background:#e8f0fb;color:var(--blue);display:grid;place-items:center;font-size:1.3rem;flex:none}

.cta{padding:0 0 96px}
.cta .box{background:var(--blue);color:#fff;border-radius:28px;padding:56px;display:flex;justify-content:space-between;align-items:center;gap:32px;flex-wrap:wrap}
.cta h2{font-size:clamp(1.7rem,3vw,2.3rem);font-weight:800;max-width:15em}
.cta p{color:#c9dbf2;margin-top:8px}

footer{border-top:1px solid var(--line);padding:32px 0;color:var(--muted);font-size:.92rem}
footer .wrap{display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap}

@media(max-width:900px){
  .hero .wrap,.flow .grid{grid-template-columns:1fr;gap:44px}
  .why{grid-template-columns:1fr}
  .why article+article{padding-left:0;border-left:0;border-top:1px solid var(--line)}
  .crit{grid-template-columns:repeat(2,1fr)}
  .burger{display:block}
  .menu{display:none;position:absolute;top:68px;left:0;right:0;background:#fff;flex-direction:column;align-items:stretch;gap:0;padding:12px 24px 20px;border-bottom:1px solid var(--line)}
  .menu.open{display:flex}
  .menu a{padding:12px 0}
  .menu .btn{justify-content:center;margin-top:8px}
  section{padding:68px 0}
  .cta .box{padding:36px 28px}
}
@media(max-width:520px){.crit{grid-template-columns:1fr}.hero{padding-top:48px}}
@media(prefers-reduced-motion:reduce){*{transition:none!important;scroll-behavior:auto!important}}
</style>
</head>
<body>

<nav class="nav">
  <div class="wrap">
    <a class="brand" href="#beranda"><img src="dist/assets/img/icon-landing.png" alt="">SPK <span>Bantuan</span></a>
    <button class="burger" id="burger" aria-label="Buka menu" aria-expanded="false"><i class="bi bi-list"></i></button>
    <ul class="menu" id="menu">
      <li><a href="#beranda">Beranda</a></li>
      <li><a href="#tentang">Tentang</a></li>
      <li><a href="#alur">Alur kerja</a></li>
      <li><a href="#kriteria">Kriteria</a></li>
      <li><a class="btn btn-primary" href="<?= base_url('login'); ?>">Masuk sistem</a></li>
    </ul>
  </div>
</nav>

<header id="beranda" class="hero">
  <div class="wrap">
    <div>
      <h1>Bantuan desa tepat sasaran, diputuskan dengan data.</h1>
      <p class="lead">Sistem pendukung keputusan berbasis web yang menilai kelayakan calon penerima bantuan desa memakai metode <strong>Naïve Bayes Classifier</strong>. Hasilnya objektif, transparan, dan langsung terlihat.</p>
      <div class="actions">
        <a class="btn btn-accent" href="<?= base_url('cekstatus'); ?>"><i class="bi bi-search"></i>Cek status penerimaan</a>
        <a class="btn btn-line" href="#alur">Lihat cara kerjanya</a>
      </div>
      <div class="facts">
        <span><i class="bi bi-check2-circle"></i>8 kriteria penilaian</span>
        <span><i class="bi bi-check2-circle"></i>Hasil dalam hitungan detik</span>
        <span><i class="bi bi-check2-circle"></i>Berdasarkan data historis</span>
      </div>
    </div>

    <div class="demo" aria-live="polite">
      <div class="demo-head">
        <h3>Contoh penilaian warga</h3>
        <div class="tabs" role="tablist">
          <button role="tab" aria-selected="true" data-i="0">Warga A</button>
          <button role="tab" aria-selected="false" data-i="1">Warga B</button>
        </div>
      </div>
      <ul class="rows" id="rows"></ul>
      <div class="result" id="result">
        <div class="verdict" id="verdict"></div>
        <div class="pl"><span>Layak</span><span id="pY"></span></div>
        <div class="bar"><i id="bY" style="background:var(--ok)"></i></div>
        <div class="pl"><span>Tidak layak</span><span id="pN"></span></div>
        <div class="bar"><i id="bN" style="background:var(--bad)"></i></div>
      </div>
      <p class="note">Data dan nilai pada kartu ini hanya ilustrasi.</p>
    </div>
  </div>
</header>

<section id="tentang">
  <div class="wrap">
    <div class="head">
      <h2>Menentukan penerima bantuan tanpa tebak-tebakan</h2>
      <p>Penilaian manual rawan perbedaan persepsi. Sistem ini menggantinya dengan perhitungan yang sama untuk setiap warga.</p>
    </div>
    <div class="why">
      <article>
        <i class="bi bi-cpu"></i>
        <h3>Naïve Bayes Classifier</h3>
        <p>Probabilitas statistik dari data historis dipakai untuk memprediksi apakah seorang warga layak menerima bantuan.</p>
      </article>
      <article>
        <i class="bi bi-shield-check"></i>
        <h3>Objektif dan transparan</h3>
        <p>Penilaian bertumpu pada kriteria nyata, sehingga kesalahan manusia dan potensi konflik antarwarga berkurang.</p>
      </article>
      <article>
        <i class="bi bi-lightning-charge"></i>
        <h3>Hasil langsung</h3>
        <p>Rekomendasi kelayakan muncul begitu data profil warga selesai dimasukkan petugas.</p>
      </article>
    </div>
  </div>
</section>

<section id="alur" class="flow">
  <div class="wrap">
    <div class="head">
      <h2>Dari data warga sampai keputusan, dalam tiga langkah</h2>
      <p>Setiap rekomendasi melewati alur klasifikasi yang sama.</p>
    </div>
    <div class="grid">
      <ol class="steps">
        <li>
          <h3>Masukkan data calon penerima</h3>
          <p>Petugas desa mengisi kriteria warga sesuai kondisi terkini di lapangan.</p>
        </li>
        <li>
          <h3>Hitung probabilitas</h3>
          <p>Sistem menghitung probabilitas prior dan posterior setiap kriteria dengan rumus Naïve Bayes.</p>
        </li>
        <li>
          <h3>Terima rekomendasi</h3>
          <p>Warga diklasifikasikan sebagai <b class="ok">Layak</b> atau <b class="no">Tidak layak</b> menerima bantuan.</p>
        </li>
      </ol>
      <div class="formula">
        <i class="bi bi-diagram-3" style="font-size:2.2rem;color:var(--orange)"></i>
        <div class="eq">P(H|X) = P(X|H) · P(H) / P(X)</div>
        <dl>
          <dt>P(H|X)</dt><dd>peluang warga layak, jika diketahui datanya</dd>
          <dt>P(X|H)</dt><dd>peluang data tersebut muncul pada warga layak</dd>
          <dt>P(H)</dt><dd>peluang awal sebuah warga layak</dd>
          <dt>P(X)</dt><dd>peluang data tersebut muncul secara umum</dd>
        </dl>
      </div>
    </div>
  </div>
</section>

<section id="kriteria">
  <div class="wrap">
    <div class="head">
      <h2>Delapan kriteria yang dinilai</h2>
      <p>Variabel utama yang menjadi acuan kelayakan penerima manfaat.</p>
    </div>
    <div class="crit">
      <div><i class="bi bi-car-front"></i>Kepemilikan kendaraan</div>
      <div><i class="bi bi-house-check"></i>Kepemilikan rumah</div>
      <div><i class="bi bi-house-gear"></i>Kondisi rumah</div>
      <div><i class="bi bi-map"></i>Kepemilikan tanah</div>
      <div><i class="bi bi-wallet2"></i>Penghasilan</div>
      <div><i class="bi bi-people"></i>Tanggungan</div>
      <div><i class="bi bi-clock-history"></i>Usia</div>
      <div><i class="bi bi-briefcase"></i>Pekerjaan</div>
    </div>
  </div>
</section>

<section class="cta">
  <div class="wrap">
    <div class="box">
      <div>
        <h2>Sudah didata? Cek status penerimaan bantuan Anda.</h2>
        <p>Warga dapat melihat hasil penilaian tanpa perlu datang ke kantor desa.</p>
      </div>
      <a class="btn btn-accent" href="<?= base_url('cekstatus'); ?>"><i class="bi bi-search"></i>Cek status sekarang</a>
    </div>
  </div>
</section>

<footer>
  <div class="wrap">
    <span>&copy; 2026 Pemerintah Desa</span>
    <span>Sistem Pendukung Keputusan berbasis klasifikasi Naïve Bayes</span>
  </div>
</footer>

<script>
(function(){
  var burger=document.getElementById('burger'),menu=document.getElementById('menu');
  burger.addEventListener('click',function(){
    var o=menu.classList.toggle('open');burger.setAttribute('aria-expanded',o);
  });
  menu.addEventListener('click',function(e){if(e.target.tagName==='A')menu.classList.remove('open')});

  var data=[
    {rows:[['Kepemilikan rumah','Menumpang'],['Kondisi rumah','Tidak layak huni'],['Penghasilan','< Rp1.000.000'],['Tanggungan','4 orang'],['Pekerjaan','Buruh harian']],y:87},
    {rows:[['Kepemilikan rumah','Milik sendiri'],['Kondisi rumah','Permanen'],['Penghasilan','> Rp4.000.000'],['Tanggungan','1 orang'],['Pekerjaan','Pegawai swasta']],y:12}
  ];
  var tabs=document.querySelectorAll('.tabs button');
  function show(i){
    var d=data[i],ok=d.y>=50;
    document.getElementById('rows').innerHTML=d.rows.map(function(r){return '<li><span>'+r[0]+'</span><span>'+r[1]+'</span></li>'}).join('');
    var res=document.getElementById('result');
    res.className='result '+(ok?'ok':'no');
    document.getElementById('verdict').innerHTML=ok?'<i class="bi bi-check-circle-fill"></i>Layak':'<i class="bi bi-x-circle-fill"></i>Tidak layak';
    document.getElementById('pY').textContent=d.y+'%';
    document.getElementById('pN').textContent=(100-d.y)+'%';
    document.getElementById('bY').style.width=d.y+'%';
    document.getElementById('bN').style.width=(100-d.y)+'%';
    tabs.forEach(function(t,k){t.setAttribute('aria-selected',k===i)});
  }
  tabs.forEach(function(t){t.addEventListener('click',function(){show(+t.dataset.i)})});
  show(0);
})();
</script>
</body>
</html>