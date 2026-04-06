<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'nomor_registrasi',
        'role',
        'status_pendaftaran',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function biodata()
    {
        return $this->hasOne(BiodataSantri::class);
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function seleksi()
    {
        return $this->hasOne(Seleksi::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Generate nomor registrasi format: CMI-YYYY-XXXX
     */
    public static function generateNomorRegistrasi()
    {
        $year = date('Y');
        $lastUser = self::where('nomor_registrasi', 'like', "CMI-{$year}-%")
            ->orderBy('nomor_registrasi', 'desc')
            ->first();

        if ($lastUser) {
            $lastNumber = (int) substr($lastUser->nomor_registrasi, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return sprintf("CMI-%s-%04d", $year, $newNumber);
    }
}
