<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'label', 'type'];

    // Helper method to get setting value
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Helper method to set setting value
    public static function set($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    // <<<< EDIT BAGIAN INI - SESUAIKAN DENGAN CONTROLLER
    /**
     * Check if registration is open
     * Controller menggunakan key: 'registration_status' dengan value 'open' atau 'closed'
     */
    public static function isRegistrationOpen()
    {
        // Ambil status pendaftaran dari database
        $status = self::get('registration_status', 'closed');
        
        // Jika status bukan "open", pendaftaran ditutup
        if ($status !== 'open') {
            return false;
        }
        
        // Cek tanggal pendaftaran (opsional)
        $startDate = self::get('registration_start');
        $endDate = self::get('registration_end');
        
        // Jika ada setting tanggal, cek apakah masih dalam periode
        if ($startDate || $endDate) {
            $now = Carbon::now();
            
            // Cek tanggal mulai
            if ($startDate) {
                $start = Carbon::parse($startDate);
                if ($now->lt($start)) {
                    return false; // Belum dimulai
                }
            }
            
            // Cek tanggal selesai
            if ($endDate) {
                $end = Carbon::parse($endDate)->endOfDay();
                if ($now->gt($end)) {
                    return false; // Sudah berakhir
                }
            }
        }
        
        return true; // Pendaftaran dibuka
    }
    // <<<< SAMPAI SINI
}