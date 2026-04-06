<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator CMI',
            'email' => 'admin@cmi.ac.id',
            'phone' => '081234567890',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nomor_registrasi' => null,
            'status_pendaftaran' => 'aktif',
        ]);

        // Akun Contoh Santri (Opsional)
        User::create([
            'name' => 'Ahmad Fauzan',
            'email' => 'santri@cmi.ac.id',
            'phone' => '089876543210',
            'password' => Hash::make('santri123'),
            'role' => 'santri',
            'nomor_registrasi' => User::generateNomorRegistrasi(),
            'status_pendaftaran' => 'pendaftar_baru',
        ]);
    }
}
