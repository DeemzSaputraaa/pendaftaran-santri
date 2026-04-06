<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Santri Baru — Pesantren CMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; min-height: 100vh; }
        .auth-image { background: linear-gradient(135deg, #0a2540 0%, #0d3868 100%); position: relative; overflow: hidden; }
        .auth-image::before { content:''; position:absolute; bottom:0; left:0; width:400px; height:400px; background:radial-gradient(circle,rgba(201,168,76,.12),transparent 70%); border-radius:50%; }
        .auth-image .overlay-text { position: absolute; bottom: 3rem; left: 3rem; right: 3rem; z-index: 2; }
    </style>
</head>
<body>
<div class="row g-0 min-vh-100">
    <!-- Form Side -->
    <div class="col-md-7 d-flex flex-column justify-content-center bg-white p-4 p-lg-5 overflow-auto">
        <div class="w-100 mx-auto" style="max-width:580px">
            <a href="/" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3" style="font-size:.85rem">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>

            <div class="mb-4">
                <h1 class="fw-bold fs-4 mb-2" style="color:#0f172a">Buat Akun Pendaftaran</h1>
                <p class="text-secondary mb-0" style="font-size:.95rem; line-height:1.5">Masukkan data dasar akun. Pastikan alamat Email aktif dan Password<br>mudah Anda ingat.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3" style="font-size:.875rem">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-1" style="font-size:.85rem; color:#1e293b">Nama Lengkap (Sesuai Akta)</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="Nama Calon Santri" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-1" style="font-size:.85rem; color:#1e293b">Nomor Telepon/WA Aktif</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="0812xxxx" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold mb-1" style="font-size:.85rem; color:#1e293b">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="email@user.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-1" style="font-size:.85rem; color:#1e293b">Password</label>
                        <input type="password" name="password" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="Minimal 8 karakter" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-1" style="font-size:.85rem; color:#1e293b">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" style="font-size:1rem; padding:.75rem 1rem" placeholder="Ketik ulang password" required>
                    </div>
                </div>

                <div class="form-check mt-4">
                    <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                    <label for="terms" class="form-check-label text-secondary" style="font-size:.85rem">
                        Saya menyetujui semua <a href="#" class="text-primary text-decoration-none">Syarat dan Ketentuan</a> pendaftaran santri baru<br>Pesantren Al-Hikmah.
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold mt-3 py-3" style="font-size:1.05rem">
                    Daftar dan Buat Akun
                </button>

                <p class="text-center text-secondary mt-3" style="font-size:.8rem">
                    Sudah punya akun? <a href="/login" class="fw-bold text-primary text-decoration-none">Masuk sekarang</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Image Side -->
    <div class="col-md-5 d-none d-md-flex auth-image">
        <div class="overlay-text text-white">
            <h2 class="fw-bold fs-3 mb-3">Langkah Awal Menjadi Penghafal Qur'an</h2>
            <p style="color:rgba(255,255,255,.7)">Mulailah dengan membuat akun, lalu selesaikan seluruh proses pendaftaran secara online tanpa harus datang ke pesantren.</p>
        </div>
    </div>
</div>
</body>
</html>
