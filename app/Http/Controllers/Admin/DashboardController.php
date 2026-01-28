<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranKkn;
use App\Models\Period;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\PendaftaranStatusUpdated;

class DashboardController extends Controller
{
    /**
     * Dashboard - Enhanced dengan statistik lengkap
     */
    public function index()
    {
        // Get basic statistics
        $totalPendaftar = PendaftaranKkn::count();
        $pending = PendaftaranKkn::where('status', 'pending')->count();
        $diproses = PendaftaranKkn::where('status', 'diproses')->count();
        $diterima = PendaftaranKkn::where('status', 'diterima')->count();
        $ditolak = PendaftaranKkn::where('status', 'ditolak')->count();

        // Statistik per Negara (top destinations)
        $statistikNegara = PendaftaranKkn::select('negara_tujuan', DB::raw('count(*) as total'))
            ->groupBy('negara_tujuan')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Statistik per Periode (latest periods)
        $statistikPeriode = PendaftaranKkn::select('periode', DB::raw('count(*) as total'))
            ->groupBy('periode')
            ->orderBy('periode', 'desc')
            ->limit(5)
            ->get();

        // Pendaftaran Terbaru (10 latest)
        $pendaftaranTerbaru = PendaftaranKkn::with(['mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'pending',
            'diproses',
            'diterima',
            'ditolak',
            'statistikNegara',
            'statistikPeriode',
            'pendaftaranTerbaru'
        ));
    }

    /**
     * Data Pendaftaran - Halaman terpisah dengan tabel lengkap
     */
    public function pendaftaranIndex(Request $request)
    {
        // Query dasar
        $query = PendaftaranKkn::with(['mahasiswa', 'dokumen']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by periode
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        // Filter by negara
        if ($request->filled('negara')) {
            $query->where('negara_tujuan', $request->negara);
        }

        // Search by NIM or Nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function($q) use ($search) {
                $q->where('nim', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }

        // Get data with pagination
        $pendaftaran = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistics - Variabel terpisah untuk view
        $totalPendaftar = PendaftaranKkn::count();
        $pending = PendaftaranKkn::where('status', 'pending')->count();
        $diproses = PendaftaranKkn::where('status', 'diproses')->count();
        $diterima = PendaftaranKkn::where('status', 'diterima')->count();
        $ditolak = PendaftaranKkn::where('status', 'ditolak')->count();

        // Ambil data periode untuk filter (dari tabel periods)
        $periods = Period::where('is_active', 1)
            ->orderBy('year', 'desc')
            ->orderBy('semester', 'asc')
            ->get();

        // Ambil data destinations untuk filter (unique countries)
        $destinations = Destination::where('is_active', 1)
            ->select('country')
            ->distinct()
            ->orderBy('country', 'asc')
            ->get();

        // Return view dengan semua variabel yang dibutuhkan
        return view('admin.pendaftaran.index', compact(
            'pendaftaran',
            'totalPendaftar',
            'pending',
            'diproses',
            'diterima',
            'ditolak',
            'periods',
            'destinations'
        ));
    }

    public function show($id)
    {
        $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])
            ->findOrFail($id);

        return view('admin.detail', compact('pendaftaran'));
    }

    /**
     * Update status pendaftaran dan kirim email notifikasi ke mahasiswa
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        try {
            // Load pendaftaran dengan relasi mahasiswa
            $pendaftaran = PendaftaranKkn::with('mahasiswa')->findOrFail($id);
            
            // Simpan status lama untuk email
            $statusLama = $pendaftaran->status;
            
            // Update status dan catatan
            $pendaftaran->status = $request->status;
            
            if ($request->filled('catatan_admin')) {
                $pendaftaran->catatan_admin = $request->catatan_admin;
            }
            
            $pendaftaran->save();
            
            // ✅ KIRIM EMAIL NOTIFIKASI
            try {
                Mail::to($pendaftaran->mahasiswa->email)->send(
                    new PendaftaranStatusUpdated(
                        $pendaftaran,
                        $statusLama,
                        $request->status,
                        $request->catatan_admin
                    )
                );
                
                Log::info('Email status update berhasil dikirim', [
                    'pendaftaran_id' => $pendaftaran->id,
                    'mahasiswa_id' => $pendaftaran->mahasiswa->id,
                    'mahasiswa_email' => $pendaftaran->mahasiswa->email,
                    'mahasiswa_nama' => $pendaftaran->mahasiswa->name,
                    'status_lama' => $statusLama,
                    'status_baru' => $request->status,
                    'catatan_admin' => $request->catatan_admin,
                    'timestamp' => now()->toDateTimeString()
                ]);
                
                $emailStatus = ' dan email notifikasi telah dikirim ke mahasiswa';
                
            } catch (\Exception $emailError) {
                Log::error('Gagal mengirim email status update', [
                    'pendaftaran_id' => $pendaftaran->id,
                    'mahasiswa_email' => $pendaftaran->mahasiswa->email,
                    'error' => $emailError->getMessage(),
                    'trace' => $emailError->getTraceAsString()
                ]);
                
                $emailStatus = ' namun email notifikasi gagal dikirim. Silakan hubungi mahasiswa secara manual';
            }
            
            return redirect()
                ->back()
                ->with('success', 'Status berhasil diupdate menjadi "' . ucfirst($request->status) . '"' . $emailStatus . '.');
                
        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengupdate status: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pendaftaran = PendaftaranKkn::findOrFail($id);
            
            // Delete related dokumen files
            foreach($pendaftaran->dokumen as $dok) {
                if (\Storage::disk('public')->exists($dok->path_file)) {
                    \Storage::disk('public')->delete($dok->path_file);
                }
            }
            
            // Delete pendaftaran (will cascade delete dokumen)
            $pendaftaran->delete();

            return redirect()
                ->route('admin.pendaftaran.index')
                ->with('success', 'Data pendaftaran berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.pendaftaran.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function export(Request $request)
    {
        // Query dengan filter yang sama
        $query = PendaftaranKkn::with('mahasiswa');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }
        if ($request->filled('negara')) {
            $query->where('negara_tujuan', $request->negara);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function($q) use ($search) {
                $q->where('nim', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }

        $pendaftaran = $query->orderBy('created_at', 'desc')->get();

        // Create CSV
        $filename = 'pendaftaran_kkn_international_' . date('YmdHis') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($pendaftaran) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 support
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'No',
                'Tanggal Daftar',
                'NIM',
                'Nama',
                'Email',
                'No. Telepon',
                'Program Studi',
                'Semester',
                'IPK',
                'Periode',
                'Negara Tujuan',
                'Status',
                'Catatan Admin'
            ]);

            // Data
            foreach ($pendaftaran as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->created_at->format('d/m/Y H:i'),
                    $item->mahasiswa->nim ?? '-',
                    $item->mahasiswa->name ?? '-',
                    $item->mahasiswa->email ?? '-',
                    $item->mahasiswa->no_telepon ?? $item->mahasiswa->phone ?? '-',
                    $item->mahasiswa->program_studi ?? '-',
                    $item->mahasiswa->semester ?? '-',
                    $item->mahasiswa->ipk ?? '-',
                    $item->periode,
                    $item->negara_tujuan,
                    ucfirst($item->status),
                    $item->catatan_admin ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function previewDokumen($id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $dokumen->path_file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        $extension = strtolower(pathinfo($dokumen->nama_file, PATHINFO_EXTENSION));
        
        // Set proper content type
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        ];
        
        $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';
        
        // Return file with proper headers
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $dokumen->nama_file . '"'
        ]);
    }

    public function downloadDokumen($id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $dokumen->path_file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $dokumen->nama_file);
    }
}