<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Pendaftaran Santri CMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; min-height: 100vh; }
        .auth-image { background: linear-gradient(135deg, #0a2540 0%, #0d3868 100%); position: relative; overflow: hidden; }
        .auth-image::before { content:''; position:absolute; top:0; right:0; width:300px; height:300px; background:radial-gradient(circle,rgba(201,168,76,.15),transparent 70%); border-radius:50%; }
        .auth-image .overlay-text { position: absolute; bottom: 3rem; left: 3rem; right: 3rem; z-index: 2; }
        .brand-icon { width:44px; height:44px; border-radius:12px; background:linear-gradient(135deg,#0d6efd,#0dcaf0); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:.75rem; }
    </style>
</head>
<body>
<div class="row g-0 min-vh-100">
    <!-- Image Side -->
    <div class="col-md-5 d-none d-md-flex auth-image">
        <div class="overlay-text text-white">
            <h2 class="fw-bold fs-3 mb-3">Lanjutkan Proses Pendaftaran</h2>
            <p style="color:rgba(255,255,255,.7)">Masuk ke akun Anda untuk melengkapi data, mengunggah dokumen, dan memantau status pendaftaran santri baru.</p>
        </div>
        <a href="/" class="position-absolute top-0 start-0 m-4 btn btn-sm text-white" style="background:rgba(0,0,0,.2); backdrop-filter:blur(8px); border-radius:100px; padding:.45rem 1rem; font-size:.8rem">
            <i class="bi bi-arrow-left me-1"></i> Beranda
        </a>
    </div>

    <!-- Form Side -->
    <div class="col-md-7 d-flex align-items-center justify-content-center bg-white p-4 p-lg-5">
        <div class="w-100" style="max-width:460px">
            <a href="/" class="d-md-none text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-4" style="font-size:.85rem">
                <i class="bi bi-arrow-left"></i> Beranda
            </a>

            <div class="mb-5">
                <div class="brand-icon mb-4">CMI</div>
                <h1 class="fw-bold fs-3 mb-2" style="color: #0f172a">Selamat Datang</h1>
                <p class="text-secondary" style="font-size: .95rem; line-height:1.5">Silakan masukkan email dan password yang Anda buat pada<br>saat registrasi pendaftaran.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3" style="font-size:.875rem">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold mb-1" style="font-size:.85rem; color:#1e293b">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="contoh@user.com" required>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label fw-bold mb-0" style="font-size:.85rem; color:#1e293b">Password</label>
                        <a href="#" class="text-primary text-decoration-none fw-semibold" style="font-size:.85rem">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold mb-4 py-3" style="font-size:1.05rem; background:#1e3a8a; border-color:#1e3a8a">
                    Masuk ke Dashboard
                </button>
                <p class="text-center text-secondary" style="font-size:.8rem">
                    Belum punya akun pendaftaran? <a href="/register" class="fw-bold text-primary text-decoration-none">Daftar di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
