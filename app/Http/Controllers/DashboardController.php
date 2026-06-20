<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load(['biodata', 'dokumens', 'seleksi', 'pembayaran', 'pembayaranDaftarUlang']);

        $hasBiodata = $user->biodata !== null;
        $requiredDocs = ['pas_foto', 'fc_ktp', 'kk', 'surat_kesanggupan', 'srt_tidak_merokok', 'video_bacaan'];
        $uploadedDocs = $user->dokumens->pluck('jenis_dokumen')->toArray();
        $hasAllDocs = count(array_intersect($requiredDocs, $uploadedDocs)) === count($requiredDocs);
        $hasVerifiedBiayaPendaftaran = $user->pembayaran?->status === 'verified';
        $hasSubmittedDaftarUlang = $user->pembayaranDaftarUlang !== null;

        return view('dashboard.index', compact(
            'user',
            'hasBiodata',
            'hasAllDocs',
            'hasVerifiedBiayaPendaftaran',
            'hasSubmittedDaftarUlang'
        ));
    }
}
