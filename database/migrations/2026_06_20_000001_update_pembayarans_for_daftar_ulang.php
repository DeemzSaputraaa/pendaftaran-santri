<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->boolean('konfirmasi_kesediaan')->nullable()->after('bukti_pembayaran');
            $table->text('catatan_santri')->nullable()->after('konfirmasi_kesediaan');
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE pembayarans
                MODIFY COLUMN jenis_pembayaran ENUM('biaya_pendaftaran', 'daftar_ulang') NOT NULL
            ");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE pembayarans
                MODIFY COLUMN jenis_pembayaran ENUM('biaya_pendaftaran') NOT NULL
            ");
        }

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn(['konfirmasi_kesediaan', 'catatan_santri']);
        });
    }
};
