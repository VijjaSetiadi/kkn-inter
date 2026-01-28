<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DokumenController extends Controller
{
    // Download sudah ada di PendaftaranController
    // Tidak perlu diduplikasi disini

    /**
     * Update status verifikasi dokumen
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:diterima,ditolak,pending',
                'catatan' => 'nullable|string|max:500'
            ]);

            $dokumen = Dokumen::findOrFail($id);
            
            $dokumen->status_verifikasi = $request->status;
            $dokumen->catatan_verifikasi = $request->catatan;
            $dokumen->verified_at = now();
            $dokumen->save();

            $statusText = [
                'diterima' => 'diterima',
                'ditolak' => 'ditolak',
                'pending' => 'dikembalikan ke status pending'
            ];

            // Generate badge HTML
            $badges = [
                'pending' => '<span class="badge bg-warning"><i class="fas fa-clock"></i> Pending</span>',
                'diterima' => '<span class="badge bg-success"><i class="fas fa-check"></i> Diterima</span>',
                'ditolak' => '<span class="badge bg-danger"><i class="fas fa-times"></i> Ditolak</span>',
            ];

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil ' . $statusText[$request->status],
                'data' => [
                    'status' => $dokumen->status_verifikasi,
                    'badge' => $badges[$dokumen->status_verifikasi]
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update status error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update status batch (multiple documents)
     */
    public function updateStatusBatch(Request $request)
    {
        try {
            $request->validate([
                'dokumen_ids' => 'required|array',
                'dokumen_ids.*' => 'exists:dokumen,id',
                'status' => 'required|in:diterima,ditolak,pending'
            ]);

            $updated = Dokumen::whereIn('id', $request->dokumen_ids)
                ->update([
                    'status_verifikasi' => $request->status,
                    'verified_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'message' => $updated . ' dokumen berhasil diperbarui'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Batch update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
        /**
     * Get reupload history
     */
    public function getReuploadHistory($id)
    {
        try {
            $dokumen = Dokumen::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'reupload_count' => $dokumen->reupload_count,
                    'last_reuploaded_at' => $dokumen->last_reuploaded_at ? 
                        $dokumen->last_reuploaded_at->format('d M Y H:i') : null,
                    'reupload_reason' => $dokumen->reupload_reason,
                    'old_file' => $dokumen->old_nama_file
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}