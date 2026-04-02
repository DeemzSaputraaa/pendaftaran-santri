@extends('layouts.app')

@section('title', 'Beranda Dashboard')
@section('header', 'Status Pendaftaran')

@section('content')
<div class="grid lg:grid-cols-3 gap-8">
    <!-- Left Column: Status Map & Main Info -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl p-8 text-white shadow-xl shadow-blue-500/20 relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 blur-xl">
                <svg class="h-64 w-64" viewBox="0 0 100 100" fill="currentColor">
                    <circle cx="50" cy="50" r="50"/>
                </svg>
            </div>
            <div class="relative z-10">
                <h1 class="text-2xl font-bold mb-2">Assalamu'alaikum, Calon Santri!</h1>
                <p class="text-blue-100 mb-6 max-w-lg leading-relaxed">Selamat datang di sistem pendaftaran santri baru Pesantren Al-Hikmah. Lengkapi seluruh persyaratan agar Anda dapat segera dijadwalkan untuk tes masuk.</p>
                
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm shadow border border-white/30 rounded-lg text-white text-sm">
                    Status saat ini: <strong class="font-bold tracking-wide uppercase">MENUNGGU PEMBAYARAN</strong>
                </div>
            </div>
        </div>

        <!-- Progress Flow -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <h3 class="text-xl font-bold text-slate-800 mb-2">Tahapan Pendaftaran Anda</h3>
            <p class="text-slate-500 mb-6 border-b border-slate-100 pb-6">Ikuti langkah-langkah di bawah ini untuk menyelesaikan proses pendaftaran santri baru.</p>
            
            <div class="space-y-6">
                <!-- Tahap 1 -->
                <div class="flex gap-4 items-start opacity-70">
                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white shrink-0 mt-1 shadow-md">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg">Pendaftaran Akun</h4>
                        <p class="text-sm text-slate-500 mt-1">Anda telah berhasil membuat akun di sistem.</p>
                    </div>
                </div>

                <!-- Tahap 2 Aktif -->
                <div class="flex gap-4 items-start relative">
                    <div class="w-8 h-8 rounded-full border-4 border-blue-100 bg-blue-500 flex items-center justify-center text-white shrink-0 mt-1 shadow-lg shadow-blue-500/30">
                        <span class="text-xs font-bold font-sans">2</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-slate-800 text-lg">Pembayaran Biaya Pendaftaran</h4>
                        <div class="mt-3 p-4 bg-amber-50 rounded-lg border border-amber-200 text-amber-800 text-sm flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 mt-0.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <div>
                                <p class="font-semibold mb-1">Menunggu unggah bukti pembayaran</p>
                                <p class="opacity-80">Silakan bayar biaya pendaftaran sebesar Rp 300.000 ke rekening BSI 1234567890 an. Pesantren Al-Hikmah. Lalu unggah bukti transfer.</p>
                                <a href="/dashboard/pembayaran" class="inline-block mt-3 bg-amber-500 hover:bg-amber-600 px-4 py-1.5 rounded text-white font-medium transition-colors">Bayar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tahap 3 -->
                <div class="flex gap-4 items-start opacity-40">
                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 shrink-0 mt-1 font-bold text-xs">3</div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg">Lengkapi Biodata</h4>
                        <p class="text-sm text-slate-500 mt-1">Isi formulir identitas santri, alamat, dan data wali setelah pembayaran divalidasi admin.</p>
                    </div>
                </div>

                <!-- Tahap 4 -->
                <div class="flex gap-4 items-start opacity-40">
                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 shrink-0 mt-1 font-bold text-xs">4</div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg">Unggah Dokumen Berkas</h4>
                        <p class="text-sm text-slate-500 mt-1">Upload scan KK, Akta Kelahiran, dan dokumen lainnya.</p>
                    </div>
                </div>

                <!-- Tahap 5 -->
                <div class="flex gap-4 items-start opacity-40">
                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 shrink-0 mt-1 font-bold text-xs">5</div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg">Pengumuman & Daftar Ulang</h4>
                        <p class="text-sm text-slate-500 mt-1">Cetak kartu ujian, ikuti seleksi, dan lakukan daftar ulang jika lulus.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Right Column: Sidebar Info -->
    <div class="space-y-6">
        
        <!-- Info Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-slate-800 font-bold mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pusat Informasi
            </h3>
            <ul class="space-y-4 text-sm text-slate-600">
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold">•</span>
                    <span>Wawancara calon santri akan dilakukan secara tatap muka (offline).</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold">•</span>
                    <span>Kartu Ujian hanya bisa dicetak jika berkas sudah lengkap (Verifikasi 100%).</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-500 font-bold">•</span>
                    <span>Jika ada kendala, hubungi panitia melalui WA: <strong>0812-3456-7890</strong>.</span>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection
