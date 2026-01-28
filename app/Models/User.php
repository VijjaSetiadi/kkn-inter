<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        // Data Akademik
        'nim',
        'program_studi',
        'fakultas',
        'semester',
        'ipk',
        'angkatan',
        // Data Pribadi
        'phone',
        'no_telepon', // Alias untuk phone
        'alamat',
        'alamat_lengkap', // Alias untuk alamat
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto_profil',
        // Verification & Profile Completion
        'email_verified_at',
        'verification_code',
        'verification_code_expires_at',
        'profile_completed_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verification_code_expires_at' => 'datetime',
            'profile_completed_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
            'ipk' => 'decimal:2',
            'semester' => 'integer',
            'angkatan' => 'integer',
        ];
    }

    // ============================================
    // RELASI
    // ============================================
    
    /**
     * Relasi ke PendaftaranKkn
     * Satu user bisa punya banyak pendaftaran
     */
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranKkn::class, 'mahasiswa_id');
    }

    /**
     * Relasi ke Mahasiswa (jika masih pakai tabel mahasiswa terpisah)
     * OPSIONAL: Hapus jika tidak pakai tabel mahasiswa lagi
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    // ============================================
    // ACCESSOR & MUTATOR
    // ============================================
    
    /**
     * Accessor untuk nama (kompatibilitas dengan view lama)
     */
    public function getNamaAttribute()
    {
        return $this->name;
    }

    /**
     * Accessor untuk alamat_lengkap (kompatibilitas)
     */
    public function getAlamatLengkapAttribute()
    {
        return $this->alamat ?? $this->attributes['alamat_lengkap'] ?? null;
    }

    /**
     * Mutator untuk alamat_lengkap
     */
    public function setAlamatLengkapAttribute($value)
    {
        $this->attributes['alamat'] = $value;
        $this->attributes['alamat_lengkap'] = $value;
    }

    /**
     * Accessor untuk no_telepon (kompatibilitas)
     */
    public function getNoTeleponAttribute()
    {
        return $this->phone ?? $this->attributes['no_telepon'] ?? null;
    }

    /**
     * Mutator untuk no_telepon
     */
    public function setNoTeleponAttribute($value)
    {
        $this->attributes['phone'] = $value;
        $this->attributes['no_telepon'] = $value;
    }

    /**
     * Accessor untuk foto profil URL
     */
    public function getFotoProfilUrlAttribute()
    {
        if ($this->foto_profil) {
            return asset('storage/' . $this->foto_profil);
        }
        
        // Foto default berdasarkan jenis kelamin
        if ($this->jenis_kelamin === 'Perempuan') {
            return asset('images/default-avatar-female.png');
        }
        
        return asset('images/default-avatar-male.png');
    }

    /**
     * Accessor untuk nama lengkap dengan gelar (jika ada)
     */
    public function getNamaLengkapAttribute()
    {
        return $this->name;
    }

    // ============================================
    // HELPER METHODS
    // ============================================
    
    /**
     * Check if user is Admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is Mahasiswa
     */
    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    /**
     * Check if profile is completed
     */
    public function hasCompletedProfile()
    {
        return !is_null($this->profile_completed_at);
    }

    /**
     * Check if email is verified
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Check if profile data is complete (for validation)
     */
    public function isProfileDataComplete()
    {
        return !empty($this->nim) && 
               !empty($this->phone) && 
               !empty($this->program_studi) &&
               !empty($this->fakultas) &&
               !empty($this->jenis_kelamin) &&
               !empty($this->angkatan) &&
               !empty($this->tempat_lahir) &&
               !empty($this->tanggal_lahir) &&
               !empty($this->alamat);
    }

    /**
     * Get pendaftaran yang sedang aktif/pending
     */
    public function getPendaftaranAktifAttribute()
    {
        return $this->pendaftaran()
                    ->whereIn('status', ['pending', 'diproses'])
                    ->latest()
                    ->first();
    }

    /**
     * Get total pendaftaran
     */
    public function getTotalPendaftaranAttribute()
    {
        return $this->pendaftaran()->count();
    }

    /**
     * Get pendaftaran yang diterima
     */
    public function getPendaftaranDiterimaAttribute()
    {
        return $this->pendaftaran()
                    ->where('status', 'diterima')
                    ->get();
    }

    /**
     * Check if user pernah diterima KKN
     */
    public function pernahDiterimaKkn()
    {
        return $this->pendaftaran()
                    ->where('status', 'diterima')
                    ->exists();
    }

    /**
     * Get status pendaftaran terakhir
     */
    public function getStatusPendaftaranTerakhirAttribute()
    {
        $pendaftaran = $this->pendaftaran()->latest()->first();
        return $pendaftaran ? $pendaftaran->status : null;
    }

    // ============================================
    // SCOPES
    // ============================================
    
    /**
     * Scope untuk filter mahasiswa saja
     */
    public function scopeMahasiswa($query)
    {
        return $query->where('role', 'mahasiswa');
    }

    /**
     * Scope untuk filter admin saja
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope untuk filter yang sudah verifikasi email
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope untuk filter yang sudah complete profile
     */
    public function scopeProfileCompleted($query)
    {
        return $query->whereNotNull('profile_completed_at');
    }

    /**
     * Scope untuk filter berdasarkan angkatan
     */
    public function scopeAngkatan($query, $angkatan)
    {
        return $query->where('angkatan', $angkatan);
    }

    /**
     * Scope untuk filter berdasarkan program studi
     */
    public function scopeProgramStudi($query, $prodi)
    {
        return $query->where('program_studi', $prodi);
    }
}