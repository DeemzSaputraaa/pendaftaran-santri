@extends('layouts.app')

@section('title', 'Pembayaran Pendaftaran')
@section('header', 'Pembayaran & Verifikasi')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <h3 class="text-xl font-bold text-slate-800 mb-2">Pembayaran Pendaftaran Otomatis</h3>
    <p class="text-slate-500 mb-8 border-b border-slate-100 pb-6">Sistem Pendaftaran Santri Al-Hikmah sekarang didukung oleh <b>Xendit</b>. Pembayaran akan terverifikasi secara instan (real-time). Anda tidak perlu lagi mengunggah manual bukti transfer.</p>

    <!-- Payment Status Info -->
    @php
        $pembayaran = \App\Models\Pembayaran::where('user_id', auth()->id())->first();
    @endphp

    @if($pembayaran && $pembayaran->status == 'PAID')
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 mb-8 text-center flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-3xl mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <h4 class="text-xl font-bold text-slate-900 mb-1">Pembayaran Lunas!</h4>
            <p class="text-slate-600">Alhamdulillah, pembayaran pendaftaran Anda berhasil diverifikasi secara otomatis.</p>
        </div>
    @elseif($pembayaran && $pembayaran->status == 'PENDING')
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-8 text-center flex flex-col items-center justify-center">
            <h4 class="text-lg font-bold text-slate-900 mb-2">Anda memiliki Tagihan Menunggu Pembayaran</h4>
            <p class="text-slate-600 mb-6">Silakan lanjutkan pembayaran Anda yang belum selesai melalui tautan di bawah ini.</p>
            <a href="{{ $pembayaran->checkout_link }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-8 py-4 rounded-xl transition-all shadow-sm">
                Lanjutkan Pembayaran
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    @else
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8 flex flex-col md:flex-row items-center gap-6">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm text-2xl text-blue-600">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <div>
                <p class="text-sm text-slate-500 font-semibold mb-1">Rincian Pembayaran</p>
                <p class="text-2xl font-bold text-slate-900 mb-1">Biaya Pendaftaran Santri Baru</p>
                <p class="font-medium text-slate-700">Dapat dibayar via Virtual Account, E-Wallet (OVO/Dana), atau QRIS.</p>
            </div>
            <div class="md:ml-auto md:text-right">
                <p class="text-sm text-slate-500 font-semibold mb-1">Total Tagihan</p>
                <p class="text-3xl font-bold text-blue-700">Rp 300.000</p>
            </div>
        </div>

        <form action="{{ route('checkout') }}" method="POST" class="text-right">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-xl shadow-md hover:shadow-lg transition-all focus:ring-4 focus:ring-blue-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                Bayar Sekarang dengan Xendit
            </button>
        </form>
    @endif
</div>
@endsection
