<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        
        // Buat settings default jika belum ada
        if ($settings->isEmpty()) {
            $this->createDefaultSettings();
            $settings = Setting::all()->keyBy('key');
        }
        
        return view('admin.settings.index', compact('settings'));
    }
    
    public function update(Request $request)
    {
        // <<<< EDIT VALIDASI - BUAT registration_status NULLABLE
        $request->validate([
            'registration_status' => 'nullable|in:open,closed', // EDIT: nullable
            'registration_start' => 'nullable|date',
            'registration_end' => 'nullable|date|after_or_equal:registration_start',
        ], [
            'registration_status.in' => 'Status pendaftaran harus "open" atau "closed"',
            'registration_start.date' => 'Format tanggal mulai tidak valid',
            'registration_end.date' => 'Format tanggal selesai tidak valid',
            'registration_end.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
        ]);
        
        // <<<< TAMBAHKAN INI - HANDLE TOGGLE ON/OFF
        // Jika toggle ON (checked) = "open"
        // Jika toggle OFF (unchecked) = "closed"
        $registrationStatus = $request->has('registration_status') ? 'open' : 'closed';
        // <<<< SAMPAI SINI
        
        // Update registration status
        Setting::updateOrCreate(
            ['key' => 'registration_status'],
            [
                'value' => $registrationStatus, // <<<< GUNAKAN VARIABLE INI
                'label' => 'Status Pendaftaran',
                'type' => 'select'
            ]
        );
        
        // Update registration start date
        if ($request->filled('registration_start')) { // <<<< GANTI has menjadi filled
            Setting::updateOrCreate(
                ['key' => 'registration_start'],
                [
                    'value' => $request->registration_start,
                    'label' => 'Tanggal Mulai Pendaftaran',
                    'type' => 'date'
                ]
            );
        }
        
        // Update registration end date
        if ($request->filled('registration_end')) { // <<<< GANTI has menjadi filled
            Setting::updateOrCreate(
                ['key' => 'registration_end'],
                [
                    'value' => $request->registration_end,
                    'label' => 'Tanggal Selesai Pendaftaran',
                    'type' => 'date'
                ]
            );
        }
        
        return redirect()->route('admin.settings')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }
    
    private function createDefaultSettings()
    {
        $defaults = [
            [
                'key' => 'registration_status',
                'value' => 'open',
                'label' => 'Status Pendaftaran',
                'type' => 'select'
            ],
            [
                'key' => 'registration_start',
                'value' => now()->format('Y-m-d'),
                'label' => 'Tanggal Mulai Pendaftaran',
                'type' => 'date'
            ],
            [
                'key' => 'registration_end',
                'value' => now()->addMonths(1)->format('Y-m-d'),
                'label' => 'Tanggal Selesai Pendaftaran',
                'type' => 'date'
            ],
        ];
        
        foreach ($defaults as $setting) {
            Setting::create($setting);
        }
    }
}