<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'university',
        'description',
        'capacity',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Get pendaftaran yang menggunakan destination ini
     * Relasi berdasarkan kolom negara_tujuan
     */
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranKKN::class, 'negara_tujuan', 'country');
    }

    /**
     * Scope untuk destination yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get jumlah pendaftar untuk destination ini
     */
    public function getTotalPendaftarAttribute()
    {
        return $this->pendaftaran()->count();
    }

    /**
     * Check if destination is full
     */
    public function isFull()
    {
        if (!$this->capacity) {
            return false;
        }
        
        return $this->pendaftaran()->whereIn('status', ['diterima', 'pending', 'diproses'])->count() >= $this->capacity;
    }

    /**
     * Get available slots
     */
    public function getAvailableSlotsAttribute()
    {
        if (!$this->capacity) {
            return null;
        }
        
        $used = $this->pendaftaran()->whereIn('status', ['diterima', 'pending', 'diproses'])->count();
        return max(0, $this->capacity - $used);
    }
}