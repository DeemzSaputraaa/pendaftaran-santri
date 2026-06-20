<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DaftarUlangController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!in_array($user->status_pendaftaran, ['lulus', 'daftar_ulang', 'aktif'])) {
            return redirect('/dashboard')->with('error', 'Fitur daftar ulang hanya tersedia untuk santri yang dinyatakan lulus.');
        }

        $pembayaran = $user->pembayaranDaftarUlang;
        $paymentConfig = config('pembayaran.daftar_ulang');

        return view('dashboard.daftar-ulang', compact('user', 'pembayaran', 'paymentConfig'));
    }

    public function upload(Request $request)
    {
        $user = auth()->user();
        if ($user->status_pendaftaran === 'aktif') {
            return redirect('/dashboard/daftar-ulang')->with('error', 'Daftar ulang Anda sudah selesai diverifikasi.');
        }

        $request->validate([
            'konfirmasi_kesediaan' => 'accepted',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'catatan_santri' => 'nullable|string|max:1000',
        ]);

        if (!in_array($user->status_pendaftaran, ['lulus', 'daftar_ulang'])) {
            return redirect('/dashboard')->with('error', 'Anda belum bisa melakukan daftar ulang.');
        }

        $paymentConfig = config('pembayaran.daftar_ulang');
        if (($paymentConfig['nominal'] ?? 0) < 1) {
            return back()->with('error', 'Nominal daftar ulang belum dikonfigurasi admin.');
        }

        $path = $request->file('bukti_pembayaran')->store('pembayaran/' . $user->id . '/daftar-ulang', 'public');

        Pembayaran::updateOrCreate(
            [
                'user_id' => $user->id,
                'jenis_pembayaran' => 'daftar_ulang',
            ],
            [
                'nominal' => $paymentConfig['nominal'],
                'bukti_pembayaran' => $path,
                'konfirmasi_kesediaan' => true,
                'catatan_santri' => $request->catatan_santri,
                'status' => 'pending',
                'catatan_admin' => null,
            ]
        );

        if ($user->status_pendaftaran === 'lulus') {
            $user->status_pendaftaran = 'daftar_ulang';
            $user->save();
        }

        return back()->with('success', 'Data daftar ulang berhasil dikirim. Menunggu verifikasi admin.');
    }
}
