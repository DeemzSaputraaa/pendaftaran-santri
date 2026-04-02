@extends('layouts.app')

@section('title', 'Dokumen Berkas')
@section('header', 'Unggah Dokumen Berkas')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <h3 class="text-xl font-bold text-slate-800 mb-2">Manajemen Berkas Santri</h3>
    <p class="text-slate-500 mb-8 border-b border-slate-100 pb-6">Silakan unggah dokumen yang diperlukan sesuai dengan ketentuan format dan ukuran maksimal yang tertera.</p>

    <div class="mb-8 p-4 bg-amber-50 rounded-lg border border-amber-200 text-amber-800 text-sm flex gap-3">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <p><strong>Perhatian:</strong> Menu form unggah Berkas akan aktif setelah form Biodata diri berhasil disimpan 100%.</p>
    </div>

    <!-- Table Dokumen -->
    <div class="overflow-x-auto opacity-60 pointer-events-none">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-y border-slate-200 text-slate-600 text-sm">
                    <th class="py-4 px-6 font-semibold">Nama Dokumen</th>
                    <th class="py-4 px-6 font-semibold">Keterangan Aturan</th>
                    <th class="py-4 px-6 font-semibold">Status Dokumen</th>
                    <th class="py-4 px-6 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                
                <!-- KK -->
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-6 font-medium">1. Kartu Keluarga (KK)</td>
                    <td class="py-4 px-6 text-sm">Scan asli, format PDF/JPG maks 2MB.</td>
                    <td class="py-4 px-6 text-sm">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Belum Unggah
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <button class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded text-sm hover:border-blue-500 hover:text-blue-600 transition-colors">Upload</button>
                    </td>
                </tr>

                <!-- Akta Kelahiran -->
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-6 font-medium">2. Akta Kelahiran</td>
                    <td class="py-4 px-6 text-sm">Scan asli berwarna, format PDF/JPG maks 2MB.</td>
                    <td class="py-4 px-6 text-sm">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Belum Unggah
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <button class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded text-sm hover:border-blue-500 hover:text-blue-600 transition-colors">Upload</button>
                    </td>
                </tr>

                <!-- Pas Foto -->
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-6 font-medium">3. Pas Foto 3x4 Santri</td>
                    <td class="py-4 px-6 text-sm">Latar merah/biru, rapi/berpeci, format JPG/PNG maks 1MB.</td>
                    <td class="py-4 px-6 text-sm">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Belum Unggah
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <button class="bg-white border border-slate-300 text-slate-700 px-3 py-1.5 rounded text-sm hover:border-blue-500 hover:text-blue-600 transition-colors">Upload</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
