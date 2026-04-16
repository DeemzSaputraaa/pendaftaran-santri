<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('jenis_dokumen', [
                'pas_foto',
                'fc_ktp',
                'kk',
                'surat_kesanggupan',
                'srt_tidak_merokok',
                'video_bacaan'
            ]);
            $table->string('file_path');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
