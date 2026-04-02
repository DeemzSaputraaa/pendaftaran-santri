<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin Utama
        User::create([
            'name' => 'Administrator Pesantren',
            'email' => 'admin@pesantren.com',
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status_pendaftaran' => 'selesai',
        ]);

        // (Opsional) Membuat Akun Contoh Santri
        User::create([
            'name' => 'Calon Santri A',
            'email' => 'santri@pesantren.com',
            'phone' => '089876543210',
            'password' => Hash::make('password123'),
            'role' => 'santri',
            'status_pendaftaran' => 'belum_bayar',
        ]);
    }
}
