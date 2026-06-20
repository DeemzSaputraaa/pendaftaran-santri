<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class BiayaPendaftaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pembayaran = $user->pembayaran;
        $paymentConfig = config('pembayaran.biaya_pendaftaran');

        return view('dashboard.biaya-pendaftaran', compact('user', 'pembayaran', 'paymentConfig'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = auth()->user();
        $paymentConfig = config('pembayaran.biaya_pendaftaran');
        if (($paymentConfig['nominal'] ?? 0) < 1) {
            return back()->with('error', 'Nominal biaya pendaftaran belum dikonfigurasi.');
        }

        $path = $request->file('bukti_pembayaran')->store('pembayaran/' . $user->id . '/biaya-pendaftaran', 'public');

        Pembayaran::updateOrCreate(
            [
                'user_id' => $user->id,
                'jenis_pembayaran' => 'biaya_pendaftaran',
            ],
            [
                'nominal' => $paymentConfig['nominal'],
                'bukti_pembayaran' => $path,
                'status' => 'pending',
                'catatan_admin' => null,
                'konfirmasi_kesediaan' => null,
                'catatan_santri' => null,
            ]
        );

        return back()->with('success', 'Bukti biaya pendaftaran berhasil diunggah! Menunggu verifikasi admin.');
    }
}
