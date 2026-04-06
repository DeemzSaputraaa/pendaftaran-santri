@extends('layouts.app')

@section('title', 'Dokumen Berkas')
@section('header', 'Unggah Dokumen Berkas')

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:16px">
    <div class="card-body p-4 p-lg-5">

        <div class="mb-4 pb-3 border-bottom">
            <h5 class="fw-bold mb-1">Manajemen Berkas Santri</h5>
            <p class="text-secondary small mb-0">Unggah dokumen sesuai ketentuan format dan ukuran maksimal.</p>
        </div>

        @php
            $docList = [
                ['key' => 'pas_foto', 'name' => 'Pas Foto 3x4', 'ket' => 'Latar merah/biru, rapi/berpeci, JPG/PNG maks 1MB', 'accept' => '.jpg,.jpeg,.png'],
                ['key' => 'fc_ktp', 'name' => 'Fotokopi KTP Orang Tua', 'ket' => 'Scan KTP salah satu orang tua, PDF/JPG maks 2MB', 'accept' => '.pdf,.jpg,.jpeg,.png'],
                ['key' => 'fc_ijazah', 'name' => 'Fotokopi Ijazah / SKL', 'ket' => 'Scan Ijazah atau surat keterangan lulus, PDF/JPG maks 2MB', 'accept' => '.pdf,.jpg,.jpeg,.png'],
                ['key' => 'surat_kesanggupan', 'name' => 'Surat Kesanggupan', 'ket' => 'Pernyataan mematuhi aturan (bertanda tangan), PDF/JPG maks 2MB', 'accept' => '.pdf,.jpg,.jpeg,.png'],
                ['key' => 'srt_tidak_merokok', 'name' => 'Surat Keterangan Tidak Merokok', 'ket' => 'Surat pernyataan tidak merokok, PDF/JPG maks 2MB', 'accept' => '.pdf,.jpg,.jpeg,.png'],
                ['key' => 'video_bacaan', 'name' => 'Video/VN Bacaan Surat', 'ket' => 'Video bacaan surat pilihan, MP4/MOV maks 20MB', 'accept' => '.mp4,.mov,.avi,.webm'],
            ];
        @endphp

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr class="text-secondary small text-nowrap" style="border-bottom:2px solid #e5e7eb">
                        <th class="fw-semibold py-3" style="min-width:220px">Nama Dokumen</th>
                        <th class="fw-semibold py-3" style="min-width:280px">Keterangan</th>
                        <th class="fw-semibold py-3" style="min-width:160px">Status</th>
                        <th class="fw-semibold py-3" style="min-width:280px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docList as $i => $doc)
                        @php
                            $uploaded = $dokumens[$doc['key']] ?? null;
                        @endphp
                        <tr>
                            <td class="fw-semibold">{{ $i + 1 }}. {{ $doc['name'] }}</td>
                            <td class="small text-secondary">{{ $doc['ket'] }}</td>
                            <td>
                                @if($uploaded)
                                    @if($uploaded->status === 'verified')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="bi bi-check-circle-fill me-1"></i> Terverifikasi
                                        </span>
                                    @elseif($uploaded->status === 'rejected')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                            <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                                        </span>
                                        @if($uploaded->catatan_admin)
                                            <div class="small text-danger mt-1">{{ $uploaded->catatan_admin }}</div>
                                        @endif
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">
                                            <i class="bi bi-clock-fill me-1"></i> Menunggu Review
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-light text-secondary border px-2 py-1">
                                        <i class="bi bi-dash-circle me-1"></i> Belum Unggah
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($uploaded && $uploaded->status !== 'rejected')
                                    <a href="{{ asset('storage/' . $uploaded->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                @endif

                                @if(!$uploaded || $uploaded->status === 'rejected')
                                    <form action="{{ route('dokumen.upload') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex align-items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="jenis_dokumen" value="{{ $doc['key'] }}">
                                        <input type="file" name="file" accept="{{ $doc['accept'] }}" class="form-control form-control-sm" style="min-width:200px" required>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-upload"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
