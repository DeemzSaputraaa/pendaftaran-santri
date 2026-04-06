<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DaftarUlangController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pembayaran = $user->pembayaran;

        return view('dashboard.daftar-ulang', compact('user', 'pembayaran'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = auth()->user();

        // Simpan bukti
        $path = $request->file('bukti_pembayaran')->store('pembayaran/' . $user->id, 'public');

        Pembayaran::updateOrCreate(
            ['user_id' => $user->id],
            [
                'jenis_pembayaran' => 'biaya_pendaftaran',
                'nominal' => 150000, // Nominal biaya pendaftaran
                'bukti_pembayaran' => $path,
                'status' => 'pending',
            ]
        );

        return back()->with('success', 'Bukti biaya pendaftaran berhasil diunggah! Menunggu verifikasi admin.');
    }
}
