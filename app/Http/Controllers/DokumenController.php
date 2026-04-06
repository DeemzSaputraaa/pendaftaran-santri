<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $dokumens = $user->dokumens->keyBy('jenis_dokumen');

        return view('dashboard.dokumen', compact('user', 'dokumens'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'jenis_dokumen' => 'required|in:pas_foto,fc_ktp,fc_ijazah,surat_kesanggupan,srt_tidak_merokok,video_bacaan',
            'file' => 'required|file|max:20480', // Max 20MB untuk video
        ]);

        $jenis = $request->jenis_dokumen;

        // Validasi ukuran berdasarkan jenis
        if ($jenis === 'video_bacaan') {
            $request->validate(['file' => 'mimes:mp4,mov,avi,webm|max:20480']);
        } elseif ($jenis === 'pas_foto') {
            $request->validate(['file' => 'mimes:jpg,jpeg,png|max:1024']);
        } else {
            $request->validate(['file' => 'mimes:pdf,jpg,jpeg,png|max:2048']);
        }

        $user = auth()->user();

        // Hapus file lama jika ada
        $existing = Dokumen::where('user_id', $user->id)
            ->where('jenis_dokumen', $jenis)
            ->first();

        if ($existing) {
            // Hapus file fisik lama
            $oldPath = storage_path('app/public/' . $existing->file_path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            $existing->delete();
        }

        // Simpan file baru
        $path = $request->file('file')->store('dokumen/' . $user->id, 'public');

        Dokumen::create([
            'user_id' => $user->id,
            'jenis_dokumen' => $jenis,
            'file_path' => $path,
            'status' => 'pending',
        ]);

        // Cek kelengkapan data
        $this->checkAndUpdateStatus($user);

        $namaDoc = str_replace('_', ' ', ucfirst($jenis));
        return back()->with('success', "Dokumen {$namaDoc} berhasil diunggah!");
    }

    private function checkAndUpdateStatus($user)
    {
        $user->refresh();
        $hasBiodata = $user->biodata !== null;
        $requiredDocs = ['pas_foto', 'fc_ktp', 'fc_ijazah', 'surat_kesanggupan', 'srt_tidak_merokok', 'video_bacaan'];
        $uploadedDocs = $user->dokumens->pluck('jenis_dokumen')->toArray();
        $hasAllDocs = count(array_intersect($requiredDocs, $uploadedDocs)) === count($requiredDocs);

        if ($hasBiodata && $hasAllDocs && $user->status_pendaftaran === 'pendaftar_baru') {
            $user->status_pendaftaran = 'data_lengkap';
            $user->save();
        }
    }
}
