<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    
    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'email',
        'no_telepon',
        'program_studi',
        'semester',
        'ipk',
        'foto'
    ];

    protected $casts = [
        'ipk' => 'decimal:2',
        'semester' => 'integer'
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranKkn::class);
    }

    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }
}