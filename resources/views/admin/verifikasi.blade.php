@extends('layouts.admin')

@section('title', 'Verifikasi Berkas')
@section('header', 'Verifikasi Berkas — ' . $santri->name)

@section('content')
<div class="row g-4">
    <!-- Info Santri -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-person-badge text-primary me-2"></i>Data Santri</h6>
                <table class="table table-sm table-borderless small mb-0">
                    <tr><td class="text-secondary" style="width:40%">Nama</td><td class="fw-semibold">{{ $santri->name }}</td></tr>
                    <tr><td class="text-secondary">No. Reg</td><td class="fw-bold text-success">{{ $santri->nomor_registrasi }}</td></tr>
                    <tr><td class="text-secondary">Email</td><td>{{ $santri->email }}</td></tr>
                    <tr><td class="text-secondary">Telepon</td><td>{{ $santri->phone ?? '-' }}</td></tr>
                    <tr><td class="text-secondary">Status</td><td><span class="badge bg-secondary">{{ str_replace('_', ' ', ucfirst($santri->status_pendaftaran)) }}</span></td></tr>
                </table>
            </div>
        </div>

        @if($santri->biodata)
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-card-list text-success me-2"></i>Biodata</h6>
                <table class="table table-sm table-borderless small mb-0">
                    <tr><td class="text-secondary">NISN</td><td>{{ $santri->biodata->nisn ?? '-' }}</td></tr>
                    <tr><td class="text-secondary">TTL</td><td>{{ $santri->biodata->tempat_lahir }}, {{ $santri->biodata->tanggal_lahir?->format('d/m/Y') }}</td></tr>
                    <tr><td class="text-secondary">JK</td><td>{{ $santri->biodata->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}</td></tr>
                    <tr><td class="text-secondary">Asal Sekolah</td><td>{{ $santri->biodata->asal_sekolah }}</td></tr>
                    <tr><td class="text-secondary">Alamat</td><td>{{ $santri->biodata->alamat_lengkap }}</td></tr>
                    <tr><td colspan="2" class="pt-2"><strong class="text-secondary">Data Orang Tua</strong></td></tr>
                    <tr><td class="text-secondary">Ayah</td><td>{{ $santri->biodata->nama_ayah }} ({{ $santri->biodata->pekerjaan_ayah }})</td></tr>
                    <tr><td class="text-secondary">Ibu</td><td>{{ $santri->biodata->nama_ibu }} ({{ $santri->biodata->pekerjaan_ibu }})</td></tr>
                    <tr><td class="text-secondary">No. Wali</td><td>{{ $santri->biodata->no_telp_wali }}</td></tr>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Dokumen -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-folder-check text-primary me-2"></i>Dokumen Berkas</h6>

                @if($santri->dokumens->count() === 0)
                    <div class="text-center text-secondary py-5">
                        <i class="bi bi-folder2-open fs-1 mb-3 d-block"></i>
                        Belum ada dokumen yang diunggah.
                    </div>
                @else
                    @foreach($santri->dokumens as $doc)
                        <div class="border rounded-3 p-3 mb-3">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <h6 class="fw-bold mb-1 small">{{ str_replace('_', ' ', ucwords($doc->jenis_dokumen)) }}</h6>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($doc->status === 'verified')
                                            <span class="badge bg-success-subtle text-success small"><i class="bi bi-check-circle me-1"></i>Terverifikasi</span>
                                        @elseif($doc->status === 'rejected')
                                            <span class="badge bg-danger-subtle text-danger small"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning small"><i class="bi bi-clock me-1"></i>Pending</span>
                                        @endif
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="small text-primary">
                                            <i class="bi bi-eye me-1"></i>Lihat File
                                        </a>
                                    </div>
                                </div>

                                @if($doc->status === 'pending')
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.dokumen.update', $doc->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="verified">
                                        <button class="btn btn-sm btn-success"><i class="bi bi-check-lg me-1"></i>Terima</button>
                                    </form>
                                    <form action="{{ route('admin.dokumen.update', $doc->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="catatan_admin" class="form-control" placeholder="Alasan tolak..." style="min-width:140px">
                                            <button class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                @if($santri->pembayaran)
                    <div class="border rounded-3 p-3 mt-4">
                        <h6 class="fw-bold small mb-2"><i class="bi bi-cash-stack text-warning me-2"></i>Bukti Pembayaran Daftar Ulang</h6>
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div>
                                <span class="badge bg-{{ $santri->pembayaran->status === 'verified' ? 'success' : ($santri->pembayaran->status === 'rejected' ? 'danger' : 'warning') }}-subtle text-{{ $santri->pembayaran->status === 'verified' ? 'success' : ($santri->pembayaran->status === 'rejected' ? 'danger' : 'warning') }} small">
                                    {{ ucfirst($santri->pembayaran->status) }}
                                </span>
                                <a href="{{ asset('storage/' . $santri->pembayaran->bukti_pembayaran) }}" target="_blank" class="small text-primary ms-2">
                                    <i class="bi bi-eye me-1"></i>Lihat Bukti
                                </a>
                            </div>
                            @if($santri->pembayaran->status === 'pending')
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.pembayaran.verifikasi', $santri->pembayaran->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="verified">
                                    <button class="btn btn-sm btn-success"><i class="bi bi-check-lg me-1"></i>Verifikasi</button>
                                </form>
                                <form action="{{ route('admin.pembayaran.verifikasi', $santri->pembayaran->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <input type="text" name="catatan_admin" class="form-control form-control-sm d-inline" placeholder="Alasan..." style="width:140px">
                                    <button class="btn btn-sm btn-danger mt-1"><i class="bi bi-x-lg me-1"></i>Tolak</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- Link ke Seleksi -->
        @if(in_array($santri->status_pendaftaran, ['berkas_terverifikasi', 'data_lengkap']))
            <div class="mt-3">
                <a href="{{ route('admin.seleksi', $santri->id) }}" class="btn btn-warning fw-bold">
                    <i class="bi bi-clipboard-data me-2"></i>Input Nilai Seleksi
                </a>
            </div>
        @endif
    </div>
</div>

<div class="mt-4">
    <a href="/admin/pendaftar" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar</a>
</div>
@endsection
