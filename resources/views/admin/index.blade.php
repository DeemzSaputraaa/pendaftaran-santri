@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')
<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center" style="width:44px;height:44px">
                        <i class="bi bi-people-fill text-primary fs-5"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary rounded-pill small">Total</span>
                </div>
                <h3 class="fw-bold mb-1">{{ $totalPendaftar }}</h3>
                <p class="text-secondary small mb-0">Total Pendaftar</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-circle bg-info-subtle d-flex align-items-center justify-content-center" style="width:44px;height:44px">
                        <i class="bi bi-folder-check text-info fs-5"></i>
                    </div>
                    <span class="badge bg-info-subtle text-info rounded-pill small">Verifikasi</span>
                </div>
                <h3 class="fw-bold mb-1">{{ $dataLengkap }}</h3>
                <p class="text-secondary small mb-0">Data Lengkap</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-circle bg-success-subtle d-flex align-items-center justify-content-center" style="width:44px;height:44px">
                        <i class="bi bi-trophy-fill text-success fs-5"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill small">Lulus</span>
                </div>
                <h3 class="fw-bold mb-1">{{ $lulus }}</h3>
                <p class="text-secondary small mb-0">Lulus Seleksi</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center" style="width:44px;height:44px">
                        <i class="bi bi-patch-check-fill text-warning fs-5"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning rounded-pill small">Aktif</span>
                </div>
                <h3 class="fw-bold mb-1">{{ $aktif }}</h3>
                <p class="text-secondary small mb-0">Santri Aktif</p>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">Aksi Cepat</h5>
        <div class="d-flex flex-wrap gap-3">
            <a href="/admin/pendaftar" class="btn btn-primary"><i class="bi bi-people me-2"></i>Kelola Pendaftar</a>
            <a href="/pengumuman" class="btn btn-outline-primary" target="_blank"><i class="bi bi-megaphone me-2"></i>Lihat Pengumuman</a>
        </div>
    </div>
</div>
@endsection
