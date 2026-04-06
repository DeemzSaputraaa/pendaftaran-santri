<?php

namespace App\Http\Controllers;

use App\Models\BiodataSantri;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $biodata = $user->biodata;

        return view('dashboard.identitas', compact('user', 'biodata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'nullable|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'no_telp_wali' => 'required|string|max:20',
        ]);

        $user = auth()->user();

        BiodataSantri::updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
                'alamat_lengkap', 'asal_sekolah', 'nama_ayah', 'pekerjaan_ayah',
                'nama_ibu', 'pekerjaan_ibu', 'no_telp_wali'
            ])
        );

        // Cek apakah dokumen sudah lengkap untuk update status
        $this->checkAndUpdateStatus($user);

        return redirect('/dashboard/identitas')->with('success', 'Biodata berhasil disimpan!');
    }

    private function checkAndUpdateStatus($user)
    {
        $user->refresh();
        $hasBiodata = $user->biodata !== null;
        $requiredDocs = ['kartu_keluarga', 'akta_kelahiran', 'ijazah', 'pas_foto', 'video_bacaan_quran'];
        $uploadedDocs = $user->dokumens->pluck('jenis_dokumen')->toArray();
        $hasAllDocs = count(array_intersect($requiredDocs, $uploadedDocs)) === count($requiredDocs);

        if ($hasBiodata && $hasAllDocs && $user->status_pendaftaran === 'pendaftar_baru') {
            $user->status_pendaftaran = 'data_lengkap';
            $user->save();
        }
    }
}
