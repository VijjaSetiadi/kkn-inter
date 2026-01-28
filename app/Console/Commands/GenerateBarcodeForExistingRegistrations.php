<?php

namespace App\Console\Commands;

use App\Models\PendaftaranKkn;  // ← GANTI INI
use Illuminate\Console\Command;

class GenerateBarcodeForExistingRegistrations extends Command
{
    protected $signature = 'pendaftaran:generate-barcode';
    protected $description = 'Generate barcode untuk pendaftaran yang belum memiliki barcode';

    public function handle()
    {
        // Ganti Pendaftaran jadi PendaftaranKkn
        $pendaftaranTanpaBarcode = PendaftaranKkn::whereNull('barcode_number')
            ->orWhere('barcode_number', '')
            ->get();
        
        if ($pendaftaranTanpaBarcode->count() === 0) {
            $this->info('✅ Semua pendaftaran sudah memiliki barcode.');
            return 0;
        }
        
        $this->info("🔍 Ditemukan {$pendaftaranTanpaBarcode->count()} pendaftaran tanpa barcode.");
        
        $bar = $this->output->createProgressBar($pendaftaranTanpaBarcode->count());
        $bar->start();
        
        foreach ($pendaftaranTanpaBarcode as $pendaftaran) {
            // Pastikan method generateBarcodeNumber() ada di model PendaftaranKkn
            $pendaftaran->barcode_number = PendaftaranKkn::generateBarcodeNumber();
            $pendaftaran->save();
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('✅ Barcode berhasil digenerate untuk semua pendaftaran!');
        
        return 0;
    }
}