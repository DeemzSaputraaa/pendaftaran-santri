<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokumen;
use App\Models\Seleksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Admin
    public function index()
    {
        $totalPendaftar = User::where('role', 'santri')->count();
        $dataLengkap = User::where('role', 'santri')->where('status_pendaftaran', 'data_lengkap')->count();
        $lulus = User::where('role', 'santri')->where('status_pendaftaran', 'lulus')->count();
        $aktif = User::where('role', 'santri')->where('status_pendaftaran', 'aktif')->count();

        return view('admin.index', compact('totalPendaftar', 'dataLengkap', 'lulus', 'aktif'));
    }

    // Daftar Semua Pendaftar
    public function pendaftar()
    {
        $pendaftars = User::where('role', 'santri')
            ->with(['biodata', 'dokumens', 'seleksi', 'pembayaran'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.pendaftar', compact('pendaftars'));
    }

    // Detail & Verifikasi Berkas Pendaftar
    public function verifikasi($id)
    {
        $santri = User::where('role', 'santri')
            ->with(['biodata', 'dokumens', 'seleksi', 'pembayaran'])
            ->findOrFail($id);

        return view('admin.verifikasi', compact('santri'));
    }

    // Update status dokumen
    public function updateDokumen(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'catatan_admin' => 'nullable|string',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->status = $request->status;
        $dokumen->catatan_admin = $request->catatan_admin;
        $dokumen->save();

        // Cek jika semua dokumen terverifikasi
        $user = $dokumen->user;
        $allVerified = $user->dokumens()->where('status', '!=', 'verified')->count() === 0
            && $user->dokumens()->count() >= 6;

        if ($allVerified && $user->status_pendaftaran === 'data_lengkap') {
            $user->status_pendaftaran = 'berkas_terverifikasi';
            $user->save();
        }

        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }

    // Halaman Input Seleksi
    public function seleksi($id)
    {
        $santri = User::where('role', 'santri')
            ->with(['biodata', 'seleksi'])
            ->findOrFail($id);

        return view('admin.seleksi', compact('santri'));
    }

    // Simpan Nilai Seleksi
    public function simpanSeleksi(Request $request, $id)
    {
        $request->validate([
            'nilai_bacaan' => 'required|integer|min:0|max:100',
            'nilai_hafalan' => 'required|integer|min:0|max:100',
            'nilai_wawancara' => 'required|integer|min:0|max:100',
            'status_kelulusan' => 'required|in:lulus,cadangan,tidak_lulus',
            'catatan' => 'nullable|string',
        ]);

        $santri = User::findOrFail($id);
        $totalNilai = $request->nilai_bacaan + $request->nilai_hafalan + $request->nilai_wawancara;

        Seleksi::updateOrCreate(
            ['user_id' => $santri->id],
            [
                'admin_id' => auth()->id(),
                'nilai_bacaan' => $request->nilai_bacaan,
                'nilai_hafalan' => $request->nilai_hafalan,
                'nilai_wawancara' => $request->nilai_wawancara,
                'total_nilai' => $totalNilai,
                'status_kelulusan' => $request->status_kelulusan,
                'catatan' => $request->catatan,
            ]
        );

        // Update status pendaftaran santri
        $santri->status_pendaftaran = $request->status_kelulusan;
        $santri->save();

        return back()->with('success', 'Hasil seleksi berhasil disimpan.');
    }

    // Verifikasi Pembayaran Daftar Ulang
    public function verifikasiPembayaran(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'catatan_admin' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $request->status;
        $pembayaran->catatan_admin = $request->catatan_admin;
        $pembayaran->save();

        // Pembayaran pendaftaran diverifikasi (Opsional: ubah ke status menunggu seleksi jika dokumen juga lengkap)

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
