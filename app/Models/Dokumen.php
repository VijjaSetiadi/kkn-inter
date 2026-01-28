<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [
        'pendaftaran_id',
        'jenis_dokumen',
        'nama_file',
        'path_file',
        'status_verifikasi',
        'catatan_verifikasi',
        'verified_at',
        'reupload_count',          // BARU
        'last_reuploaded_at',      // BARU
        'reupload_reason',         // BARU
        'old_path_file',           // BARU
        'old_nama_file'            // BARU
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'last_reuploaded_at' => 'datetime',  // ✅ INI YANG KURANG!
    ];

    // Relationship
    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranKkn::class, 'pendaftaran_id');
    }

    // Accessor untuk format jenis dokumen
    public function getJenisDokumenFormattedAttribute()
    {
        $labels = [
            'ktp' => 'KTP',
            'khs' => 'KHS Terakhir',
            'transkrip' => 'Transkrip Nilai',
            'sertifikat_bahasa' => 'Sertifikat Bahasa (TOEFL/IELTS)',
            'passport' => 'Passport',
            'surat_rekomendasi' => 'Surat Rekomendasi Dosen',
            'surat_izin_ortu' => 'Surat Izin Orang Tua',
            'lainnya' => 'Lainnya'
        ];

        return $labels[$this->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $this->jenis_dokumen));
    }

    // Accessor untuk URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->path_file);
    }

    // Check if file is PDF
    public function getIsPdfAttribute()
    {
        $extension = strtolower(pathinfo($this->nama_file, PATHINFO_EXTENSION));
        return $extension === 'pdf';
    }

    // Check if file is Image
    public function getIsImageAttribute()
    {
        $extension = strtolower(pathinfo($this->nama_file, PATHINFO_EXTENSION));
        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
    }

    // Check if can preview
    public function getCanPreviewAttribute()
    {
        return $this->is_pdf || $this->is_image;
    }

    /**
     * Get status badge HTML
     * Accessor untuk menampilkan badge status verifikasi
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> Pending</span>',
            'diterima' => '<span class="badge bg-success"><i class="fas fa-check"></i> Diterima</span>',
            'ditolak' => '<span class="badge bg-danger"><i class="fas fa-times"></i> Ditolak</span>',
        ];

        return $badges[$this->status_verifikasi] ?? $badges['pending'];
    }

    /**
     * Get status text (tanpa HTML)
     */
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Pending',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
        ];

        return $statuses[$this->status_verifikasi] ?? 'Pending';
    }

    /**
     * Get status color class
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'diterima' => 'success',
            'ditolak' => 'danger',
        ];

        return $colors[$this->status_verifikasi] ?? 'warning';
    }

    /**
     * Check if dokumen is verified (diterima atau ditolak)
     */
    public function isVerified()
    {
        return in_array($this->status_verifikasi, ['diterima', 'ditolak']);
    }

    /**
     * Check if dokumen is accepted
     */
    public function isAccepted()
    {
        return $this->status_verifikasi === 'diterima';
    }

    /**
     * Check if dokumen is rejected
     */
    public function isRejected()
    {
        return $this->status_verifikasi === 'ditolak';
    }

    /**
     * Check if dokumen is pending
     */
    public function isPending()
    {
        return $this->status_verifikasi === 'pending';
    }

    /**
     * Scope untuk filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_verifikasi', $status);
    }

    /**
     * Scope untuk dokumen yang diterima
     */
    public function scopeAccepted($query)
    {
        return $query->where('status_verifikasi', 'diterima');
    }

    /**
     * Scope untuk dokumen yang ditolak
     */
    public function scopeRejected($query)
    {
        return $query->where('status_verifikasi', 'ditolak');
    }

    /**
     * Scope untuk dokumen yang pending
     */
    public function scopePending($query)
    {
        return $query->where('status_verifikasi', 'pending');
    }

    /**
     * Get file size in human readable format
     */
    public function getFileSizeAttribute()
    {
        $filePath = storage_path('app/public/' . $this->path_file);
        
        if (!file_exists($filePath)) {
            return 'File tidak ditemukan';
        }

        $bytes = filesize($filePath);
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if document can be reuploaded
     */
    public function canBeReuploaded()
    {
        return $this->status_verifikasi === 'ditolak';
    }

    /**
     * Get reupload info text
     */
    public function getReuploadInfoAttribute()
    {
        if ($this->reupload_count > 0 && $this->last_reuploaded_at) {
            return "Upload ke-" . ($this->reupload_count + 1) . " | Terakhir: " . 
                $this->last_reuploaded_at->format('d M Y H:i');
        }
        return "Upload pertama";
    }

    /**
     * Get file extension
     */
    public function getFileExtensionAttribute()
    {
        return strtolower(pathinfo($this->nama_file, PATHINFO_EXTENSION));
    }

    /**
     * Boot method untuk set default values
     */
    protected static function boot()
    {
        parent::boot();

        // Set default status saat create
        static::creating(function ($dokumen) {
            if (empty($dokumen->status_verifikasi)) {
                $dokumen->status_verifikasi = 'pending';
            }
        });
    }
}