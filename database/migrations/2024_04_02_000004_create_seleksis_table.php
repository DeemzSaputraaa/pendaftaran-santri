<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seleksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');

            // Nilai tes
            $table->integer('nilai_bacaan')->default(0);   // Bacaan Al-Qur'an
            $table->integer('nilai_hafalan')->default(0);   // Hafalan
            $table->integer('nilai_wawancara')->default(0); // Wawancara
            $table->integer('total_nilai')->default(0);

            $table->enum('status_kelulusan', ['belum_dinilai', 'lulus', 'cadangan', 'tidak_lulus'])->default('belum_dinilai');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seleksis');
    }
};
