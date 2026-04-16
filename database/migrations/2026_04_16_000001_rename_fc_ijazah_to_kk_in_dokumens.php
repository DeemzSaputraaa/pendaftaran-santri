<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE dokumens
                MODIFY COLUMN jenis_dokumen ENUM(
                    'pas_foto',
                    'fc_ktp',
                    'fc_ijazah',
                    'kk',
                    'surat_kesanggupan',
                    'srt_tidak_merokok',
                    'video_bacaan'
                ) NOT NULL
            ");
        }

        DB::table('dokumens')
            ->where('jenis_dokumen', 'fc_ijazah')
            ->update(['jenis_dokumen' => 'kk']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE dokumens
                MODIFY COLUMN jenis_dokumen ENUM(
                    'pas_foto',
                    'fc_ktp',
                    'kk',
                    'surat_kesanggupan',
                    'srt_tidak_merokok',
                    'video_bacaan'
                ) NOT NULL
            ");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE dokumens
                MODIFY COLUMN jenis_dokumen ENUM(
                    'pas_foto',
                    'fc_ktp',
                    'kk',
                    'fc_ijazah',
                    'surat_kesanggupan',
                    'srt_tidak_merokok',
                    'video_bacaan'
                ) NOT NULL
            ");
        }

        DB::table('dokumens')
            ->where('jenis_dokumen', 'kk')
            ->update(['jenis_dokumen' => 'fc_ijazah']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE dokumens
                MODIFY COLUMN jenis_dokumen ENUM(
                    'pas_foto',
                    'fc_ktp',
                    'fc_ijazah',
                    'surat_kesanggupan',
                    'srt_tidak_merokok',
                    'video_bacaan'
                ) NOT NULL
            ");
        }
    }
};
