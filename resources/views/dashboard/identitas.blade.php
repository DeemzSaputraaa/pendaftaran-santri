@extends('layouts.app')

@section('title', 'Identitas Diri')
@section('header', 'Lengkapi Identitas Diri')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    
    <div class="mb-8 p-4 bg-amber-50 rounded-lg border border-amber-200 text-amber-800 text-sm flex gap-3">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p><strong>Perhatian:</strong> Halaman pengisian identitas ini hanya dapat disimpan setelah tahap Pembayaran diverifikasi oleh Panitia. Anda masih bisa melihat *draft* form di bawah.</p>
    </div>

    <form action="#" class="space-y-8 opacity-60 pointer-events-none">
        
        <!-- Data Diri -->
        <div class="mb-4">
            <h3 class="text-xl font-bold text-slate-800 mb-2">Informasi Calon Santri</h3>
            <p class="text-slate-500 mb-6 border-b border-slate-100 pb-6">Lengkapi data pribadi santri sesuai dengan kartu identitas resmi yang berlaku.</p>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap (Sesuai Akta)</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300 bg-slate-50" value="Calon Santri A" disabled>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">NISN</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tempat Lahir</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Lahir</label>
                    <input type="date" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Kelamin</label>
                    <select class="w-full px-4 py-3 rounded-lg border border-slate-300">
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Asal Sekolah</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap (Sesuai Kartu Keluarga)</label>
                    <textarea rows="3" class="w-full px-4 py-3 rounded-lg border border-slate-300"></textarea>
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="mt-8 mb-4">
            <h3 class="text-xl font-bold text-slate-800 mb-2">Informasi Orang Tua / Wali</h3>
            <p class="text-slate-500 mb-6 border-b border-slate-100 pb-6">Masukkan data orang tua atau wali penanggung jawab santri.</p>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Ayah</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan Ayah</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Ibu</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan Ibu</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300">
                </div>
            </div>
        </div>

        <button type="button" class="bg-blue-600 text-white font-bold py-3.5 px-8 rounded-lg">
            Simpan Biodata Sesuai Formulir
        </button>

    </form>
</div>
@endsection
