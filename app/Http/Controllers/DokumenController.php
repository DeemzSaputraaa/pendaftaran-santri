<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\UploadedFile;
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
            'jenis_dokumen' => 'required|in:pas_foto,fc_ktp,kk,surat_kesanggupan,srt_tidak_merokok,video_bacaan',
            'file' => 'required|file|max:20480', // Max 20MB untuk video
        ]);

        $jenis = $request->jenis_dokumen;
        $this->validateDocumentFile($request, 'file', $jenis);

        $user = auth()->user();
        $this->storeDocumentFile($user->id, $jenis, $request->file('file'));

        // Cek kelengkapan data
        $this->checkAndUpdateStatus($user);

        $namaDoc = str_replace('_', ' ', ucfirst($jenis));
        return back()->with('success', "Dokumen {$namaDoc} berhasil diunggah!");
    }

    public function uploadSemua(Request $request)
    {
        $allowedFields = ['pas_foto', 'fc_ktp', 'kk', 'surat_kesanggupan', 'srt_tidak_merokok', 'video_bacaan'];
        $singleUpload = $request->input('single_upload');

        if ($singleUpload !== null) {
            if (!in_array($singleUpload, $allowedFields, true)) {
                return back()->with('error', 'Jenis dokumen tidak valid.');
            }

            if (!$request->hasFile($singleUpload)) {
                return back()->with('error', 'Pilih file terlebih dahulu sebelum mengunggah dokumen ini.');
            }

            $this->validateDocumentFile($request, $singleUpload, $singleUpload);

            $user = auth()->user();
            $this->storeDocumentFile($user->id, $singleUpload, $request->file($singleUpload));
            $this->checkAndUpdateStatus($user);

            $namaDoc = str_replace('_', ' ', ucfirst($singleUpload));
            return back()->with('success', "Dokumen {$namaDoc} berhasil diunggah!");
        }

        $hasAtLeastOneFile = false;

        foreach ($allowedFields as $field) {
            if ($request->hasFile($field)) {
                $hasAtLeastOneFile = true;
                $this->validateDocumentFile($request, $field, $field);
            }
        }

        if (!$hasAtLeastOneFile) {
            return back()->with('error', 'Pilih minimal satu file untuk upload semua dokumen.');
        }

        $user = auth()->user();
        $uploadedCount = 0;

        foreach ($allowedFields as $field) {
            if (!$request->hasFile($field)) {
                continue;
            }

            $this->storeDocumentFile($user->id, $field, $request->file($field));
            $uploadedCount++;
        }

        $this->checkAndUpdateStatus($user);

        return back()->with('success', "{$uploadedCount} dokumen berhasil diunggah sekaligus.");
    }

    private function validateDocumentFile(Request $request, string $field, string $jenis): void
    {
        if ($jenis === 'video_bacaan') {
            $request->validate([$field => 'file|mimes:mp4,mov,avi,webm|max:20480']);
        } elseif ($jenis === 'pas_foto') {
            $request->validate([$field => 'file|mimes:jpg,jpeg,png|max:1024']);
        } else {
            $request->validate([$field => 'file|mimes:pdf,jpg,jpeg,png|max:2048']);
        }
    }

    private function storeDocumentFile(int $userId, string $jenis, UploadedFile $file): void
    {
        $existing = Dokumen::where('user_id', $userId)
            ->where('jenis_dokumen', $jenis)
            ->first();

        if ($existing) {
            $oldPath = storage_path('app/public/' . $existing->file_path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            $existing->delete();
        }

        $path = $file->store('dokumen/' . $userId, 'public');

        Dokumen::create([
            'user_id' => $userId,
            'jenis_dokumen' => $jenis,
            'file_path' => $path,
            'status' => 'pending',
        ]);
    }

    private function checkAndUpdateStatus($user)
    {
        $user->refresh();
        $hasBiodata = $user->biodata !== null;
        $requiredDocs = ['pas_foto', 'fc_ktp', 'kk', 'surat_kesanggupan', 'srt_tidak_merokok', 'video_bacaan'];
        $uploadedDocs = $user->dokumens->pluck('jenis_dokumen')->toArray();
        $hasAllDocs = count(array_intersect($requiredDocs, $uploadedDocs)) === count($requiredDocs);

        if ($hasBiodata && $hasAllDocs && $user->status_pendaftaran === 'pendaftar_baru') {
            $user->status_pendaftaran = 'data_lengkap';
            $user->save();
        }
    }
}
