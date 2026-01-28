<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranKkn;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Dashboard mahasiswa
     */
    public function index()
    {
        \Log::info('=== MAHASISWA DASHBOARD ACCESS ===', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email
        ]);

        // GUNAKAN USER LANGSUNG sebagai mahasiswa
        $mahasiswa = Auth::user();
        
        if (!$mahasiswa || !$mahasiswa->profile_completed_at) {
            \Log::warning('Dashboard: Profile not completed');
            return redirect()->route('profile.complete')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        \Log::info('Dashboard accessed successfully', [
            'user_id' => $mahasiswa->id,
            'email' => $mahasiswa->email,
            'name' => $mahasiswa->name
        ]);

        // Ambil riwayat pendaftaran
        $pendaftaran = PendaftaranKkn::where('mahasiswa_id', $mahasiswa->id)
            ->with('dokumen')
            ->orderBy('created_at', 'desc')
            ->get();

        $sudahDaftar = $pendaftaran->count() > 0;
        $adaPendingProses = $pendaftaran->whereIn('status', ['pending', 'diproses'])->count() > 0;
        $pendaftaranDibuka = Setting::isRegistrationOpen();

        \Log::info('Dashboard data loaded', [
            'pendaftaran_count' => $pendaftaran->count(),
            'sudah_daftar' => $sudahDaftar,
            'ada_pending' => $adaPendingProses
        ]);

        return view('mahasiswa.dashboard', compact(
            'mahasiswa', 
            'pendaftaran', 
            'sudahDaftar', 
            'adaPendingProses', 
            'pendaftaranDibuka'
        ));
    }

    /**
     * Halaman profile mahasiswa
     */
    public function profile()
    {
        $mahasiswa = Auth::user();
        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    /**
     * Update profile mahasiswa
     */
    public function updateProfile(Request $request)
    {
        $mahasiswa = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'no_telepon' => 'required|string|max:20',
            'program_studi' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'phone' => $request->no_telepon,
                'program_studi' => $request->program_studi,
                'fakultas' => $request->fakultas,
                'angkatan' => $request->angkatan,
            ];

            if ($request->hasFile('foto')) {
                if ($mahasiswa->foto) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = 'foto_' . $mahasiswa->nim . '_' . time() . '.' . $foto->getClientOriginalExtension();
                $fotoPath = $foto->storeAs('foto_mahasiswa', $fotoName, 'public');
                $data['foto'] = $fotoPath;
            }

            $mahasiswa->update($data);
            DB::commit();

            return redirect()
                ->route('mahasiswa.profile')
                ->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Profile update error: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil.')
                ->withInput();
        }
    }
}