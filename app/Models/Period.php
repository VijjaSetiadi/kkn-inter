<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',          // PERBAIKAN: Ganti dari 'academic_year' ke 'year'
        'semester',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'semester' => 'integer'
    ];

    protected $attributes = [
        'is_active' => true
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk period yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk period berdasarkan tahun ajaran
     */
    public function scopeByAcademicYear($query, $year)
    {
        return $query->where('year', $year);  // PERBAIKAN: Ganti 'academic_year' ke 'year'
    }

    /*
    |--------------------------------------------------------------------------
    | STATIC METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Get all active periods
     */
    public static function getActive()
    {
        return self::where('is_active', true)
            ->orderBy('year', 'desc')  // PERBAIKAN: Ganti 'academic_year' ke 'year'
            ->orderBy('semester', 'asc')
            ->get();
    }

    /**
     * Get active periods untuk dropdown
     */
    public static function getActiveForDropdown()
    {
        return self::where('is_active', true)
            ->orderBy('year', 'desc')  // PERBAIKAN: Ganti 'academic_year' ke 'year'
            ->orderBy('semester', 'asc')
            ->get()
            ->pluck('name', 'name');
    }

    /**
     * Check if period exists and is active
     */
    public static function isPeriodActive($name)
    {
        return self::where('name', $name)
            ->where('is_active', true)
            ->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Relationship dengan PendaftaranKkn
     */
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranKkn::class, 'periode', 'name');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS & MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->is_active) {
            return '<span class="badge bg-success">Aktif</span>';
        }
        return '<span class="badge bg-danger">Nonaktif</span>';
    }

    /**
     * Get semester badge HTML
     */
    public function getSemesterBadgeAttribute()
    {
        $color = $this->semester == 1 ? 'info' : 'primary';
        return '<span class="badge bg-' . $color . '">Semester ' . $this->semester . '</span>';
    }

    /**
     * Get formatted date range
     */
    public function getDateRangeAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return '-';
        }
        
        return Carbon::parse($this->start_date)->format('d M Y') . ' - ' . 
               Carbon::parse($this->end_date)->format('d M Y');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Toggle active status
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this->save();
    }

    /**
     * Activate period
     */
    public function activate()
    {
        $this->is_active = true;
        return $this->save();
    }

    /**
     * Deactivate period
     */
    public function deactivate()
    {
        $this->is_active = false;
        return $this->save();
    }

    /**
     * Check if period is currently open
     */
    public function isOpen()
    {
        if (!$this->is_active) {
            return false;
        }

        if (!$this->start_date || !$this->end_date) {
            return true; // Jika tidak ada tanggal, dianggap terbuka
        }

        $now = Carbon::now();
        return $now->between($this->start_date, $this->end_date);
    }
}