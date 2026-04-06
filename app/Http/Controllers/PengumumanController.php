<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('pengumuman');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'nomor_registrasi' => 'required|string'
        ]);

        $user = User::where('nomor_registrasi', $request->nomor_registrasi)
            ->with('seleksi')
            ->first();

        if (!$user) {
            return back()->with('error', 'Nomor registrasi tidak ditemukan.')->withInput();
        }

        if (!$user->seleksi || $user->seleksi->status_kelulusan === 'belum_dinilai') {
            return back()->with('info', 'Hasil seleksi untuk nomor registrasi ini belum tersedia.')->withInput();
        }

        return view('pengumuman', [
            'hasil' => $user->seleksi,
            'santri' => $user,
        ]);
    }
}
