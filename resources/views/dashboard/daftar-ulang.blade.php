@extends('layouts.app')

@section('title', 'Daftar Ulang')
@section('header', 'Daftar Ulang')

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:16px">
    <div class="card-body p-4 p-lg-5">

        @if($user->status_pendaftaran === 'aktif')
            <div class="text-center py-5">
                <div class="mb-4" style="font-size:4rem"><i class="bi bi-patch-check-fill text-success"></i></div>
                <h5 class="fw-bold mb-2">Daftar Ulang Selesai</h5>
                <p class="text-secondary mb-0">Data daftar ulang Anda sudah diverifikasi. Status Anda telah diperbarui menjadi santri aktif.</p>
            </div>
        @elseif($pembayaran && $pembayaran->status === 'verified')
            <div class="text-center py-5">
                <div class="mb-4" style="font-size:4rem"><i class="bi bi-patch-check-fill text-success"></i></div>
                <h5 class="fw-bold mb-2">Daftar Ulang Diterima</h5>
                <p class="text-secondary">Pembayaran daftar ulang Anda sudah diverifikasi. Status akun Anda sedang atau sudah diperbarui menjadi aktif.</p>
            </div>
        @elseif($pembayaran && $pembayaran->status === 'pending')
            <div class="text-center py-5">
                <div class="mb-4" style="font-size:4rem"><i class="bi bi-hourglass-split text-warning"></i></div>
                <h5 class="fw-bold mb-2">Data Sedang Diverifikasi</h5>
                <p class="text-secondary">Admin sedang memeriksa konfirmasi kesediaan dan bukti pembayaran daftar ulang Anda.</p>
                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-primary mt-2">
                    <i class="bi bi-eye me-1"></i> Lihat Bukti Pembayaran
                </a>
            </div>
        @else
            @if($pembayaran && $pembayaran->status === 'rejected')
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Daftar ulang belum disetujui.</strong>
                    {{ $pembayaran->catatan_admin ? 'Catatan admin: ' . $pembayaran->catatan_admin : 'Silakan perbaiki data dan unggah ulang bukti yang valid.' }}
                </div>
            @endif

            <div class="mb-4 pb-3 border-bottom">
                <h5 class="fw-bold mb-1">Konfirmasi Daftar Ulang</h5>
                <p class="text-secondary small mb-0">Isi konfirmasi kesediaan mondok dan unggah bukti pembayaran daftar ulang untuk diaktivasi oleh panitia.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-3" style="background:#f8f9fa; border:1px solid #e9ecef">
                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-bank me-2"></i>Informasi Daftar Ulang</h6>
                        <table class="table table-sm table-borderless mb-3 small">
                            <tr><td class="text-secondary" style="width:40%">Bank</td><td class="fw-semibold">{{ $paymentConfig['bank_name'] }}</td></tr>
                            <tr><td class="text-secondary">No. Rekening</td><td class="fw-bold">{{ $paymentConfig['account_number'] }}</td></tr>
                            <tr><td class="text-secondary">Atas Nama</td><td class="fw-semibold">{{ $paymentConfig['account_name'] }}</td></tr>
                            <tr>
                                <td class="text-secondary">Nominal</td>
                                <td class="fw-bold {{ $paymentConfig['nominal'] > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $paymentConfig['nominal'] > 0 ? 'Rp ' . number_format($paymentConfig['nominal'], 0, ',', '.') : 'Belum dikonfigurasi' }}
                                </td>
                            </tr>
                        </table>
                        <ul class="small text-secondary mb-0 ps-3">
                            <li class="mb-2">Pastikan Anda sudah dinyatakan lulus seleksi.</li>
                            <li class="mb-2">Konfirmasi kesediaan untuk melanjutkan proses menjadi santri aktif.</li>
                            <li class="mb-2">Transfer sesuai nominal yang ditetapkan panitia.</li>
                            <li>Unggah bukti pembayaran dengan format JPG, PNG, atau PDF.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('daftar-ulang.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="konfirmasi_kesediaan" name="konfirmasi_kesediaan" required>
                                <label class="form-check-label small fw-semibold" for="konfirmasi_kesediaan">
                                    Saya menyatakan bersedia melakukan daftar ulang dan melanjutkan proses menjadi santri aktif.
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                            <input type="file" name="bukti_pembayaran" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                            <div class="form-text">Format: JPG, PNG, atau PDF. Maks 2MB.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Catatan Tambahan</label>
                            <textarea name="catatan_santri" class="form-control" rows="3" placeholder="Opsional. Contoh: tanggal transfer, nama pengirim, atau informasi lain.">{{ old('catatan_santri', $pembayaran->catatan_santri ?? '') }}</textarea>
                        </div>
                        @if(($paymentConfig['nominal'] ?? 0) < 1)
                            <div class="alert alert-warning small">
                                Nominal daftar ulang belum dikonfigurasi admin. Form belum bisa diproses sampai nominal diatur.
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary fw-bold" {{ ($paymentConfig['nominal'] ?? 0) < 1 ? 'disabled' : '' }}>
                            <i class="bi bi-send-check me-2"></i> Kirim Daftar Ulang
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
