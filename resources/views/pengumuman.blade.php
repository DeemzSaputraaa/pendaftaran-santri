<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Hasil Seleksi — Pesantren CMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; min-height: 100vh; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .hero-pengumuman { background: linear-gradient(135deg, #0a2540, #0d3868); padding: 5rem 0 3rem; }
        .search-card { margin-top: -2rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,.08); }
        .result-card { border-radius: 16px; }
        .score-circle { width: 70px; height: 70px; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 800; font-size: 1.25rem; }
    </style>
</head>
<body>

<!-- Hero -->
<section class="hero-pengumuman text-white text-center">
    <div class="container">
        <a href="/" class="text-white text-decoration-none d-inline-flex align-items-center gap-2 mb-4 opacity-75" style="font-size:.85rem">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
        <h1 class="font-serif display-5 fw-bold mb-3">Pengumuman Hasil Seleksi</h1>
        <p style="color:rgba(255,255,255,.7); max-width:500px; margin:0 auto">Masukkan nomor registrasi Anda untuk melihat hasil seleksi penerimaan santri baru.</p>
    </div>
</section>

<!-- Search Card -->
<div class="container" style="max-width:640px">
    <div class="card search-card border-0 p-4 p-lg-5">
        <div class="card-body">
            {{-- Flash Messages --}}
            @if(session('error'))
                <div class="alert alert-danger py-2 small"><i class="bi bi-x-circle me-1"></i> {{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="alert alert-info py-2 small"><i class="bi bi-info-circle me-1"></i> {{ session('info') }}</div>
            @endif

            <form action="{{ route('pengumuman.cek') }}" method="POST" class="mb-4">
                @csrf
                <label class="form-label fw-bold">Nomor Registrasi</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-primary-subtle border-end-0"><i class="bi bi-search text-primary"></i></span>
                    <input type="text" name="nomor_registrasi" class="form-control border-start-0" placeholder="Contoh: CMI-2026-0001" value="{{ old('nomor_registrasi') }}" required>
                    <button type="submit" class="btn btn-primary fw-bold px-4">Cek Hasil</button>
                </div>
            </form>

            {{-- Hasil Seleksi --}}
            @if(isset($hasil) && isset($santri))
                <div class="result-card border p-4 mt-4
                    {{ $hasil->status_kelulusan === 'lulus' ? 'border-success bg-success-subtle' : '' }}
                    {{ $hasil->status_kelulusan === 'cadangan' ? 'border-warning bg-warning-subtle' : '' }}
                    {{ $hasil->status_kelulusan === 'tidak_lulus' ? 'border-danger bg-danger-subtle' : '' }}
                ">
                    <div class="text-center mb-4">
                        @if($hasil->status_kelulusan === 'lulus')
                            <div class="mb-3" style="font-size:3rem"><i class="bi bi-emoji-smile-fill text-success"></i></div>
                            <h4 class="fw-bold text-success">LULUS</h4>
                            <p class="text-secondary">Selamat! Anda dinyatakan lulus seleksi.</p>
                        @elseif($hasil->status_kelulusan === 'cadangan')
                            <div class="mb-3" style="font-size:3rem"><i class="bi bi-hourglass-split text-warning"></i></div>
                            <h4 class="fw-bold text-warning">CADANGAN</h4>
                            <p class="text-secondary">Anda masuk dalam daftar cadangan. Harap menunggu informasi lebih lanjut.</p>
                        @else
                            <div class="mb-3" style="font-size:3rem"><i class="bi bi-emoji-frown-fill text-danger"></i></div>
                            <h4 class="fw-bold text-danger">TIDAK LULUS</h4>
                            <p class="text-secondary">Mohon maaf, Anda belum diterima dalam seleksi ini.</p>
                        @endif
                    </div>

                    <table class="table table-sm table-borderless small mb-4">
                        <tr><td class="text-secondary" style="width:40%">Nama</td><td class="fw-semibold">{{ $santri->name }}</td></tr>
                        <tr><td class="text-secondary">No. Registrasi</td><td class="fw-bold text-primary">{{ $santri->nomor_registrasi }}</td></tr>
                    </table>

                    <!-- Scores -->
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <div class="score-circle bg-white border text-primary">
                            {{ $hasil->nilai_bacaan }}
                            <small class="fw-normal" style="font-size:.55rem; color:#6b7280">Bacaan</small>
                        </div>
                        <div class="score-circle bg-white border text-primary">
                            {{ $hasil->nilai_hafalan }}
                            <small class="fw-normal" style="font-size:.55rem; color:#6b7280">Hafalan</small>
                        </div>
                        <div class="score-circle bg-white border text-primary">
                            {{ $hasil->nilai_wawancara }}
                            <small class="fw-normal" style="font-size:.55rem; color:#6b7280">Wawancara</small>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="fw-bold">Total Nilai: {{ $hasil->total_nilai }} / 300</span>
                    </div>

                    @if($hasil->status_kelulusan === 'lulus')
                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="small text-secondary mb-3">Silakan login ke dashboard untuk melakukan <strong>Daftar Ulang</strong>.</p>
                            <a href="/login" class="btn btn-primary fw-bold"><i class="bi bi-box-arrow-in-right me-1"></i> Login ke Dashboard</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Footer -->
<div class="text-center py-4 mt-5">
    <p class="text-secondary small">&copy; {{ date('Y') }} Pesantren & BCB Cahaya Mutiara Insani</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
