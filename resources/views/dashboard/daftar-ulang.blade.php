@extends('layouts.app')

@section('title', 'Biaya Pendaftaran')
@section('header', 'Biaya Pendaftaran')

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:16px">
    <div class="card-body p-4 p-lg-5">

        @if($pembayaran && $pembayaran->status === 'verified')
            <div class="text-center py-5">
                <div class="mb-4" style="font-size:4rem"><i class="bi bi-patch-check-fill text-success"></i></div>
                <h5 class="fw-bold mb-2">Alhamdulillah, Pembayaran Diterima!</h5>
                <p class="text-secondary">Biaya pendaftaran Anda telah diverifikasi. Proses pendaftaran Anda valid.</p>
            </div>
        @elseif($pembayaran && $pembayaran->status === 'pending')
            <div class="text-center py-5">
                <div class="mb-4" style="font-size:4rem"><i class="bi bi-hourglass-split text-warning"></i></div>
                <h5 class="fw-bold mb-2">Bukti Sedang Diverifikasi</h5>
                <p class="text-secondary">Admin sedang memeriksa bukti biaya pendaftaran Anda. Silakan tunggu konfirmasi.</p>
                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-primary mt-2">
                    <i class="bi bi-eye me-1"></i> Lihat Bukti yang Diunggah
                </a>
            </div>
        @else
            @if($pembayaran && $pembayaran->status === 'rejected')
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Bukti pembayaran ditolak.</strong>
                    {{ $pembayaran->catatan_admin ? 'Alasan: ' . $pembayaran->catatan_admin : 'Silakan unggah ulang bukti yang valid.' }}
                </div>
            @endif

            <!-- Form Upload Bukti Pembayaran -->
            <div class="mb-4 pb-3 border-bottom">
                <h5 class="fw-bold mb-1">Unggah Biaya Pendaftaran</h5>
                <p class="text-secondary small mb-0">Silakan unggah bukti pembayaran biaya pendaftaran untuk bisa diproses oleh panitia.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-3" style="background:#f8f9fa; border:1px solid #e9ecef">
                        <h6 class="fw-bold text-primary mb-2"><i class="bi bi-bank me-2"></i>Informasi Pembayaran</h6>
                        <table class="table table-sm table-borderless mb-0 small">
                            <tr><td class="text-secondary" style="width:40%">Bank</td><td class="fw-semibold">BSI (Bank Syariah Indonesia)</td></tr>
                            <tr><td class="text-secondary">No. Rekening</td><td class="fw-bold">1234567890</td></tr>
                            <tr><td class="text-secondary">Atas Nama</td><td class="fw-semibold">Pesantren CMI</td></tr>
                            <tr><td class="text-secondary">Nominal</td><td class="fw-bold text-success fs-5">Rp 150.000</td></tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('biaya-pendaftaran.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                            <input type="file" name="bukti_pembayaran" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                            <div class="form-text">Format: JPG, PNG, atau PDF. Maks 2MB.</div>
                        </div>
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-upload me-2"></i> Kirim Bukti Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
