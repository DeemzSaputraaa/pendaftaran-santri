<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Pendaftaran Santri Baru Pesantren & BCB Cahaya Mutiara Insani - Tahfidz Al-Quran Intensif & Ilmu Syar'i">
    <title>Pendaftaran Santri Baru — Pesantren & BCB Cahaya Mutiara Insani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        :root { --cmi-theme: #0d6efd; --cmi-dark: #0a2540; --cmi-gold: #c9a84c; }
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .navbar-glass { background: rgba(255,255,255,.92); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,.06); }
        .hero-section { background: linear-gradient(135deg, #0a2540 0%, #0d3868 50%, #104b8d 100%); min-height: 100vh; position: relative; overflow: hidden; }
        .hero-section::before { content: ''; position: absolute; top: -50%; right: -20%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(201,168,76,.15) 0%, transparent 70%); border-radius: 50%; }
        .hero-section::after { content: ''; position: absolute; bottom: -30%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(32,201,151,.1) 0%, transparent 70%); border-radius: 50%; }
        .hero-badge { display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15); padding: .5rem 1rem; border-radius: 100px; font-size: .85rem; color: #a7f3d0; backdrop-filter: blur(8px); }
        .hero-badge .dot { width: 8px; height: 8px; border-radius: 50%; background: #34d399; animation: pulse-dot 2s infinite; }
        @keyframes pulse-dot { 0%,100% { opacity:1; } 50% { opacity:.3; } }
        .btn-cmi { background: var(--cmi-gold); color: #1a2332; font-weight: 700; padding: .85rem 2rem; border-radius: 12px; border: none; transition: all .3s; }
        .btn-cmi:hover { background: #dbb85a; color: #1a2332; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201,168,76,.3); }
        .btn-outline-light-custom { border: 1.5px solid rgba(255,255,255,.3); color: #fff; padding: .85rem 2rem; border-radius: 12px; font-weight: 600; transition: all .3s; background: transparent; }
        .btn-outline-light-custom:hover { background: rgba(255,255,255,.1); color: #fff; border-color: rgba(255,255,255,.5); }
        .step-card { background: #fff; border-radius: 16px; padding: 2rem; text-align: center; border: 1px solid #e5e7eb; transition: all .3s; height: 100%; }
        .step-card:hover { border-color: var(--cmi-theme); transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.08); }
        .step-number { width: 56px; height: 56px; border-radius: 50%; background: linear-gradient(135deg, #0d6efd, #0dcaf0); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.25rem; margin: 0 auto 1.25rem; }
        .stat-item { text-align: center; }
        .stat-item .num { font-size: 2rem; font-weight: 800; color: #fff; }
        .stat-item .label { color: #a7f3d0; font-size: .8rem; font-weight: 500; }
        .footer { background: #0f172a; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-glass py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="/">
            <div style="width:38px; height:38px; border-radius:10px; background: linear-gradient(135deg,#0d6efd,#0dcaf0); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:.75rem;">CMI</div>
            <div>
                <div class="fw-bold text-dark" style="font-size:.95rem; line-height:1.2">Cahaya Mutiara Insani</div>
                <div class="text-primary" style="font-size:.65rem; font-weight:600; letter-spacing:.03em">PESANTREN & BCB</div>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link fw-semibold" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link fw-medium text-secondary" href="#alur">Alur Pendaftaran</a></li>
                <li class="nav-item"><a class="nav-link fw-medium text-secondary" href="/pengumuman">Pengumuman</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <a href="/login" class="fw-bold text-primary text-decoration-none">Masuk</a>
                <a href="/register" class="btn btn-primary px-4 rounded-pill fw-semibold">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero -->
<header id="beranda" class="hero-section d-flex align-items-center text-white" style="padding-top:120px">
    <div class="container position-relative" style="z-index:2">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="hero-badge mb-4">
                    <span class="dot"></span>
                    Pendaftaran Gelombang 1 Dibuka
                </div>
                <h1 class="font-serif display-4 fw-bold mb-4" style="line-height:1.15">
                    Mencetak Generasi<br>
                    <span style="color: var(--cmi-gold)">Penghafal Al-Qur'an</span>
                </h1>
                <p class="lead mb-5" style="color:rgba(255,255,255,.75); max-width:540px; font-weight:300; line-height:1.8">
                    Pesantren & Bimbingan Cinta Belajar <strong>"BCB"</strong> Cahaya Mutiara Insani — pusat pendidikan berasrama yang berfokus pada <strong>Tahfidz Al-Quran Intensif</strong> dan penguatan <strong>Ilmu Syar'i</strong>, mencetak generasi berkarakter kuat dan siap mengabdi di masyarakat.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 mb-5">
                    <a href="/register" class="btn btn-cmi btn-lg">
                        <i class="bi bi-pencil-square me-2"></i> Mulai Pendaftaran
                    </a>
                    <a href="#alur" class="btn btn-outline-light-custom btn-lg">
                        <i class="bi bi-arrow-down-circle me-2"></i> Lihat Panduan
                    </a>
                </div>

                <!-- Stats dihilangkan sesuai permintaan -->
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="p-3 rounded-4" style="background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); backdrop-filter: blur(12px);">
                    <img src="https://images.unsplash.com/photo-1585036156171-384164a8c159?q=80&w=800&auto=format&fit=crop" onerror="this.src='https://images.unsplash.com/photo-1609599006353-e629aaabfeae?q=80&w=800&auto=format&fit=crop'" alt="Pesantren CMI" class="img-fluid rounded-3" style="height:480px; object-fit:cover; width:100%;">
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Alur Pendaftaran -->
<section id="alur" class="py-5" style="padding-top:5rem!important; padding-bottom:5rem!important; background:#fff">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3">ALUR PENDAFTARAN</span>
            <h2 class="font-serif display-6 fw-bold text-dark">Tahapan Pendaftaran Santri</h2>
            <p class="text-secondary mt-3 mx-auto" style="max-width:560px">Ikuti 4 tahapan berikut untuk mendaftarkan putra-putri Anda sebagai santri baru Pesantren CMI.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h5 class="fw-bold mb-3">Pendaftaran</h5>
                    <p class="text-secondary small mb-0">Isi data diri, data orang tua, unggah dokumen persyaratan & video bacaan Al-Qur'an. Sistem akan memberikan nomor registrasi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h5 class="fw-bold mb-3">Seleksi</h5>
                    <p class="text-secondary small mb-0">Admin melakukan verifikasi berkas dan input hasil tes bacaan Al-Qur'an, hafalan, serta wawancara.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h5 class="fw-bold mb-3">Pengumuman</h5>
                    <p class="text-secondary small mb-0">Cek hasil seleksi menggunakan nomor registrasi dan unduh surat kelulusan jika dinyatakan lulus.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h5 class="fw-bold mb-3">Daftar Ulang</h5>
                    <p class="text-secondary small mb-0">Konfirmasi kesediaan dan unggah bukti pembayaran. Status akan diperbarui menjadi santri aktif.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer py-5">
    <div class="container text-center">
        <div style="width:50px; height:50px; border-radius:14px; background:linear-gradient(135deg,#0d6efd,#0dcaf0); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:.8rem; margin:0 auto 1.5rem">CMI</div>
        <p class="text-secondary mb-2">&copy; {{ date('Y') }} Pesantren & BCB Cahaya Mutiara Insani. Mencetak Generasi Penghafal Al-Qur'an.</p>
        <p class="small text-secondary">Tahfidz Al-Quran Intensif & Penguatan Ilmu Syar'i</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function(e) {
            e.preventDefault();
            const el = document.querySelector(this.getAttribute('href'));
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
</body>
</html>
