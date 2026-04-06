@extends('layouts.admin')

@section('title', 'Input Seleksi')
@section('header', 'Input Hasil Seleksi — ' . $santri->name)

@section('content')
<div class="row g-4">
    <!-- Info Santri -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-person-badge text-primary me-2"></i>Data Santri</h6>
                <table class="table table-sm table-borderless small mb-0">
                    <tr><td class="text-secondary">Nama</td><td class="fw-semibold">{{ $santri->name }}</td></tr>
                    <tr><td class="text-secondary">No. Reg</td><td class="fw-bold text-success">{{ $santri->nomor_registrasi }}</td></tr>
                    @if($santri->biodata)
                        <tr><td class="text-secondary">TTL</td><td>{{ $santri->biodata->tempat_lahir }}, {{ $santri->biodata->tanggal_lahir?->format('d/m/Y') }}</td></tr>
                        <tr><td class="text-secondary">Asal Sekolah</td><td>{{ $santri->biodata->asal_sekolah }}</td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Form Seleksi -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4"><i class="bi bi-clipboard-data text-warning me-2"></i>Input Nilai Seleksi</h6>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.seleksi.simpan', $santri->id) }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Nilai Bacaan Al-Qur'an <span class="text-danger">*</span></label>
                            <input type="number" name="nilai_bacaan" class="form-control form-control-lg text-center fw-bold" min="0" max="100" value="{{ old('nilai_bacaan', $santri->seleksi->nilai_bacaan ?? 0) }}" required>
                            <div class="form-text text-center">0 - 100</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Nilai Hafalan <span class="text-danger">*</span></label>
                            <input type="number" name="nilai_hafalan" class="form-control form-control-lg text-center fw-bold" min="0" max="100" value="{{ old('nilai_hafalan', $santri->seleksi->nilai_hafalan ?? 0) }}" required>
                            <div class="form-text text-center">0 - 100</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Nilai Wawancara <span class="text-danger">*</span></label>
                            <input type="number" name="nilai_wawancara" class="form-control form-control-lg text-center fw-bold" min="0" max="100" value="{{ old('nilai_wawancara', $santri->seleksi->nilai_wawancara ?? 0) }}" required>
                            <div class="form-text text-center">0 - 100</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Status Kelulusan <span class="text-danger">*</span></label>
                        <select name="status_kelulusan" class="form-select form-select-lg" required>
                            <option value="">— Pilih Status —</option>
                            <option value="lulus" {{ old('status_kelulusan', $santri->seleksi->status_kelulusan ?? '') === 'lulus' ? 'selected' : '' }}>✅ LULUS</option>
                            <option value="cadangan" {{ old('status_kelulusan', $santri->seleksi->status_kelulusan ?? '') === 'cadangan' ? 'selected' : '' }}>⏳ CADANGAN</option>
                            <option value="tidak_lulus" {{ old('status_kelulusan', $santri->seleksi->status_kelulusan ?? '') === 'tidak_lulus' ? 'selected' : '' }}>❌ TIDAK LULUS</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Catatan (Opsional)</label>
                        <textarea name="catatan" rows="3" class="form-control">{{ old('catatan', $santri->seleksi->catatan ?? '') }}</textarea>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold px-5">
                            <i class="bi bi-check2-all me-2"></i>Simpan Hasil Seleksi
                        </button>
                        <a href="/admin/pendaftar" class="btn btn-outline-secondary btn-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
