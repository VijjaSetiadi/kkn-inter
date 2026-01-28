<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendaftaranKkn extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_kkn';
    
    protected $fillable = [
        'mahasiswa_id',
        'periode',
        'negara_tujuan',
        'universitas_tujuan',
        'motivasi',
        'status',
        'catatan_admin',
        'tanggal_daftar',
        'barcode_number',
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pendaftaran_id');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning text-dark">Pending</span>',
            'diproses' => '<span class="badge bg-info text-white">Diproses</span>',
            'diterima' => '<span class="badge bg-success">Diterima</span>',
            'ditolak' => '<span class="badge bg-danger">Ditolak</span>'
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    public function getTanggalDaftarFormattedAttribute()
    {
        return $this->created_at->translatedFormat('d F Y, H:i');
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Pending',
            'diproses' => 'Diproses',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'diproses' => 'info',
            'diterima' => 'success',
            'ditolak' => 'danger'
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPeriode($query, $periode)
    {
        return $query->where('periode', $periode);
    }
    
    public function scopeByNegara($query, $negara)
    {
        return $query->where('negara_tujuan', $negara);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('mahasiswa', function($q) use ($search) {
            $q->where('nim', 'LIKE', "%{$search}%")
              ->orWhere('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function canBeEdited()
    {
        return in_array($this->status, ['pending', 'diproses']);
    }

    public function isFinal()
    {
        return in_array($this->status, ['diterima', 'ditolak']);
    }

    public static function generateBarcodeNumber()
    {
        do {
            $code = 'KKN-' . date('Y') . '-' . strtoupper(Str::random(8));
        } while (self::where('barcode_number', $code)->exists());
        
        return $code;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->status)) {
                $model->status = 'pending';
            }
            
            if (empty($model->tanggal_daftar)) {
                $model->tanggal_daftar = now();
            }
            
            if (empty($model->barcode_number)) {
                $model->barcode_number = self::generateBarcodeNumber();
            }
        });

        static::deleting(function ($model) {
            foreach ($model->dokumen as $dok) {
                if (\Storage::disk('public')->exists($dok->path_file)) {
                    \Storage::disk('public')->delete($dok->path_file);
                }
                $dok->delete();
            }
        });
    }
}