<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Tambahan field untuk pendaftaran santri
            $table->string('phone')->nullable();
            $table->enum('role', ['admin', 'santri'])->default('santri');
            $table->enum('status_pendaftaran', [
                'belum_bayar', 
                'menunggu_verifikasi_bayar', 
                'isi_data', 
                'menunggu_tes', 
                'lulus', 
                'tidak_lulus',
                'pemberkasan_ulang',
                'selesai'
            ])->default('belum_bayar');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
