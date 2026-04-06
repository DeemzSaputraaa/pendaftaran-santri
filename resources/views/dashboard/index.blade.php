@extends('layouts.app')

@section('title', 'Beranda Dashboard')
@section('header', 'Status Pendaftaran')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <!-- Welcome Card -->
        <div class="card border-0 text-white mb-4" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0); border-radius: 16px;">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-2">Assalamu'alaikum, {{ $user->name }}!</h4>
                <p class="mb-3" style="color:rgba(255,255,255,.75)">Selamat datang di Sistem Pendaftaran Santri Baru Pesantren & BCB Cahaya Mutiara Insani.</p>
                <div class="d-flex flex-wrap gap-3">
                    <span class="badge bg-white bg-opacity-25 px-3 py-2 fw-semibold">
                        <i class="bi bi-hash me-1"></i> {{ $user->nomor_registrasi }}
                    </span>
                    @php
                        $statusConfig = [
                            'pendaftar_baru' => ['label' => 'Lengkapi Data', 'bg' => 'warning'],
                            'data_lengkap' => ['label' => 'Data Lengkap', 'bg' => 'info'],
                            'berkas_terverifikasi' => ['label' => 'Berkas Terverifikasi', 'bg' => 'info'],
                            'menunggu_seleksi' => ['label' => 'Menunggu Seleksi', 'bg' => 'secondary'],
                            'lulus' => ['label' => 'LULUS', 'bg' => 'success'],
                            'cadangan' => ['label' => 'CADANGAN', 'bg' => 'warning'],
                            'tidak_lulus' => ['label' => 'TIDAK LULUS', 'bg' => 'danger'],
                            'daftar_ulang' => ['label' => 'Daftar Ulang', 'bg' => 'primary'],
                            'aktif' => ['label' => 'SANTRI AKTIF', 'bg' => 'success'],
                        ];
                        $cfg = $statusConfig[$user->status_pendaftaran] ?? ['label' => $user->status_pendaftaran, 'bg' => 'secondary'];
                    @endphp
                    <span class="badge bg-{{ $cfg['bg'] }} px-3 py-2 fw-bold">
                        {{ $cfg['label'] }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="card border-0 shadow-sm" style="border-radius:16px">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Tahapan Pendaftaran Anda</h5>
                <p class="text-secondary small mb-4 pb-3 border-bottom">Ikuti langkah-langkah di bawah ini untuk menyelesaikan proses pendaftaran.</p>

                @php
                    $hasPembayaran = $user->pembayaran !== null;
                    $steps = [
                        ['key' => 'akun', 'icon' => 'bi-person-check-fill', 'title' => 'Pendaftaran Akun', 'desc' => 'Anda telah berhasil membuat akun.', 'done' => true],
                        ['key' => 'identitas', 'icon' => 'bi-card-list', 'title' => 'Lengkapi Identitas & Dokumen', 'desc' => 'Isi biodata, upload berkas, dan video bacaan.', 'done' => $hasBiodata && $hasAllDocs],
                        ['key' => 'pembayaran', 'icon' => 'bi-cash-stack', 'title' => 'Biaya Pendaftaran', 'desc' => 'Upload bukti pembayaran biaya pendaftaran.', 'done' => $hasPembayaran],
                        ['key' => 'seleksi', 'icon' => 'bi-clipboard-check-fill', 'title' => 'Verifikasi & Seleksi', 'desc' => 'Admin memverifikasi berkas & pembayaran serta menginput hasil tes.', 'done' => in_array($user->status_pendaftaran, ['lulus','cadangan','tidak_lulus','aktif'])],
                        ['key' => 'pengumuman', 'icon' => 'bi-megaphone-fill', 'title' => 'Pengumuman', 'desc' => 'Cek hasil seleksi melalui menu pengumuman.', 'done' => in_array($user->status_pendaftaran, ['lulus','cadangan','tidak_lulus','aktif'])],
                    ];
                @endphp

                @foreach($steps as $i => $step)
                    <div class="d-flex gap-3 mb-3 {{ !$step['done'] && ($i > 0 && !$steps[$i-1]['done']) ? 'opacity-50' : '' }}">
                        <div>
                            @if($step['done'])
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:36px; height:36px">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            @elseif($i === 0 || $steps[$i-1]['done'])
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:36px; height:36px; box-shadow:0 4px 12px rgba(13,110,253,.3)">
                                    <span class="fw-bold small">{{ $i + 1 }}</span>
                                </div>
                            @else
                                <div class="rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center border" style="width:36px; height:36px">
                                    <span class="fw-bold small">{{ $i + 1 }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $step['title'] }}</h6>
                            <p class="text-secondary small mb-0">{{ $step['desc'] }}</p>

                            @if($step['key'] === 'identitas' && !$step['done'])
                                <div class="mt-2">
                                    <a href="/dashboard/identitas" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square me-1"></i> Isi Biodata</a>
                                    <a href="/dashboard/dokumen" class="btn btn-sm btn-outline-primary"><i class="bi bi-upload me-1"></i> Upload Dokumen</a>
                                </div>
                            @endif

                            @if($step['key'] === 'pembayaran' && !$step['done'] && $steps[$i-1]['done'])
                                <div class="mt-2">
                                    <a href="/dashboard/biaya-pendaftaran" class="btn btn-sm btn-warning"><i class="bi bi-cash-stack me-1"></i> Bayar Pendaftaran</a>
                                </div>
                            @endif

                            @if($step['key'] === 'pengumuman' && in_array($user->status_pendaftaran, ['lulus','cadangan','tidak_lulus']))
                                <div class="mt-2">
                                    <a href="/pengumuman" class="btn btn-sm btn-outline-primary" target="_blank"><i class="bi bi-megaphone me-1"></i> Lihat Pengumuman</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius:16px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle-fill text-primary me-2"></i>Pusat Informasi</h6>
                <ul class="list-unstyled mb-0 small text-secondary">
                    <li class="d-flex gap-2 mb-3">
                        <i class="bi bi-dot fs-5 text-primary"></i>
                        <span>Seleksi dilakukan secara <strong>offline</strong> (tatap muka) setelah berkas diverifikasi.</span>
                    </li>
                    <li class="d-flex gap-2 mb-3">
                        <i class="bi bi-dot fs-5 text-primary"></i>
                        <span>Pengumuman dapat dicek menggunakan <strong>nomor registrasi</strong>.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="bi bi-dot fs-5 text-primary"></i>
                        <span>Hubungi panitia via WA: <strong>0812-3456-7890</strong></span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius:16px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-person-badge-fill text-primary me-2"></i>Data Akun Anda</h6>
                <table class="table table-sm table-borderless small mb-0">
                    <tr><td class="text-secondary" style="width:40%">Nama</td><td class="fw-semibold">{{ $user->name }}</td></tr>
                    <tr><td class="text-secondary">Email</td><td class="fw-semibold">{{ $user->email }}</td></tr>
                    <tr><td class="text-secondary">No. HP</td><td class="fw-semibold">{{ $user->phone ?? '-' }}</td></tr>
                    <tr><td class="text-secondary">No. Reg</td><td class="fw-bold text-primary">{{ $user->nomor_registrasi }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
