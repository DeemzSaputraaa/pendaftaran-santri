@extends('layouts.app')

@section('title', 'Identitas Diri')
@section('header', 'Lengkapi Identitas Diri')

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:16px">
    <div class="card-body p-4 p-lg-5">

        <div class="mb-4 pb-3 border-bottom">
            <h5 class="fw-bold mb-1">Formulir Biodata Santri</h5>
            <p class="text-secondary small mb-0">Isi data pribadi santri dan data orang tua/wali sesuai dokumen resmi.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('identitas.store') }}" method="POST">
            @csrf

            <!-- Data Diri Santri -->
            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-fill me-2"></i>Informasi Calon Santri</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Nama Lengkap (Sesuai Akta)</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                    <div class="form-text">Nama diambil dari data akun.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $biodata->nisn ?? '') }}" placeholder="Nomor Induk Siswa Nasional">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', isset($biodata->tanggal_lahir) ? $biodata->tanggal_lahir->format('Y-m-d') : '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">— Pilih —</option>
                        <option value="L" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="P" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Asal Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $biodata->asal_sekolah ?? '') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small">Alamat Lengkap (Sesuai KK) <span class="text-danger">*</span></label>
                    <textarea name="alamat_lengkap" rows="3" class="form-control" required>{{ old('alamat_lengkap', $biodata->alamat_lengkap ?? '') }}</textarea>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <h6 class="fw-bold text-primary mb-3 mt-4 pt-3 border-top"><i class="bi bi-people-fill me-2"></i>Informasi Orang Tua / Wali</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Nama Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $biodata->nama_ayah ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Pekerjaan Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Nama Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $biodata->nama_ibu ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Pekerjaan Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">No. Telepon Wali <span class="text-danger">*</span></label>
                    <input type="text" name="no_telp_wali" class="form-control" value="{{ old('no_telp_wali', $biodata->no_telp_wali ?? '') }}" placeholder="0812xxxxxxxx" required>
                </div>
            </div>

            <div class="pt-3 border-top">
                <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold">
                    <i class="bi bi-check-lg me-2"></i> Simpan Biodata
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
