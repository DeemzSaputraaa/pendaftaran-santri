<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

    // Menampilkan invoice Xendit kepada santri untuk dibayar
    public function createInvoice(Request $request) 
    {
        // Pastikan hanya santri yang login
        $user = auth()->user();

        // Cek apakah santri sudah memiliki pembayaran pending atau lunas
        $existingPayment = Pembayaran::where('user_id', $user->id)->first();
        if ($existingPayment) {
            if ($existingPayment->status == 'PAID') {
                return redirect('/dashboard')->with('success', 'Pembayaran Anda sudah Lunas!');
            }
            if ($existingPayment->status == 'PENDING') {
                return redirect($existingPayment->checkout_link);
            }
        }

        // Buat ID unik untuk referensi Xendit
        $external_id = 'SANTRI-' . date('Ymd') . '-' . Str::random(5);
        
        // Buat data pembayaran di database kita
        $pembayaran = new Pembayaran();
        $pembayaran->user_id = $user->id;
        $pembayaran->external_id = $external_id;
        $pembayaran->jenis_pembayaran = 'pendaftaran';
        $pembayaran->nominal = 300000;
        $pembayaran->status = 'PENDING';

        // Hit ke API Xendit untuk membuat Invoice URL
        $apiInstance = new InvoiceApi();
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => $external_id,
            'amount' => 300000,
            'description' => 'Biaya Pendaftaran Santri Baru Al-Hikmah a.n ' . $user->name,
            'customer' => [
                'given_names' => $user->name,
                'email' => $user->email,
            ],
            'success_redirect_url' => url('/dashboard'),
            'failure_redirect_url' => url('/dashboard/pembayaran'),
        ]);

        try {
            $invoice = $apiInstance->createInvoice($createInvoiceRequest);
            $pembayaran->checkout_link = $invoice['invoice_url'];
            $pembayaran->save();

            // Arahkan santri ke halaman UI Xendit
            return redirect($invoice['invoice_url']);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    // Webhook otomatis dari Xendit ketika dibayar
    public function webhook(Request $request)
    {
        // 1. Verifikasi callback token dari Xendit (Keamanan)
        $xenditXCallbackToken = $request->header('x-callback-token');
        if ($xenditXCallbackToken !== env('XENDIT_CALLBACK_TOKEN')) {
            return response()->json(['message' => 'Token tidak valid'], 403);
        }

        // 2. Baca status Invoice
        $external_id = $request->external_id;
        $status = $request->status;

        $pembayaran = Pembayaran::where('external_id', $external_id)->first();
        if ($pembayaran) {
            if ($status == 'PAID') {
                $pembayaran->status = 'PAID';
            } elseif ($status == 'EXPIRED') {
                $pembayaran->status = 'EXPIRED';
            }
            $pembayaran->save();
        }

        return response()->json(['message' => 'Webhook berhasil diproses']);
    }
}
