@extends('layouts.admin')

@section('title', 'Data Pendaftar')
@section('header', 'Data Pendaftar Santri')

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body p-4">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr class="text-secondary small text-nowrap" style="border-bottom:2px solid #e5e7eb">
                        <th class="fw-semibold py-3">No. Reg</th>
                        <th class="fw-semibold py-3">Nama</th>
                        <th class="fw-semibold py-3">Email</th>
                        <th class="fw-semibold py-3">Biodata</th>
                        <th class="fw-semibold py-3">Dokumen</th>
                        <th class="fw-semibold py-3">Status</th>
                        <th class="fw-semibold py-3" style="min-width:100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftars as $santri)
                        @php
                            $statusConfig = [
                                'pendaftar_baru' => ['label' => 'Pendaftar Baru', 'bg' => 'secondary'],
                                'data_lengkap' => ['label' => 'Data Lengkap', 'bg' => 'info'],
                                'berkas_terverifikasi' => ['label' => 'Terverifikasi', 'bg' => 'primary'],
                                'menunggu_seleksi' => ['label' => 'Menunggu Seleksi', 'bg' => 'warning'],
                                'lulus' => ['label' => 'Lulus', 'bg' => 'success'],
                                'cadangan' => ['label' => 'Cadangan', 'bg' => 'warning'],
                                'tidak_lulus' => ['label' => 'Tidak Lulus', 'bg' => 'danger'],
                                'daftar_ulang' => ['label' => 'Daftar Ulang', 'bg' => 'primary'],
                                'aktif' => ['label' => 'Aktif', 'bg' => 'success'],
                            ];
                            $cfg = $statusConfig[$santri->status_pendaftaran] ?? ['label' => $santri->status_pendaftaran, 'bg' => 'secondary'];
                            $docCount = $santri->dokumens->count();
                        @endphp
                        <tr>
                            <td><span class="fw-bold text-primary small">{{ $santri->nomor_registrasi }}</span></td>
                            <td class="fw-semibold">{{ $santri->name }}</td>
                            <td class="small text-secondary">{{ $santri->email }}</td>
                            <td>
                                @if($santri->biodata)
                                    <span class="badge bg-primary-subtle text-primary"><i class="bi bi-check"></i> Ada</span>
                                @else
                                    <span class="badge bg-light text-secondary border">Belum</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $docCount }}/6</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $cfg['bg'] }}">{{ $cfg['label'] }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.verifikasi', $santri->id) }}" class="btn btn-sm btn-outline-primary" title="Verifikasi Berkas">
                                        <i class="bi bi-folder-check"></i>
                                    </a>
                                    @if(in_array($santri->status_pendaftaran, ['berkas_terverifikasi','data_lengkap','menunggu_seleksi']))
                                        <a href="{{ route('admin.seleksi', $santri->id) }}" class="btn btn-sm btn-outline-warning" title="Input Seleksi">
                                            <i class="bi bi-clipboard-data"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-5">Belum ada data pendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pendaftars->links() }}
        </div>

    </div>
</div>
@endsection
