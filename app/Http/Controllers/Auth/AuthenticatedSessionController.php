<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        \Log::info('=== USER LOGIN ===', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'email_verified_at' => $user->email_verified_at,
            'profile_completed_at' => $user->profile_completed_at
        ]);

        // CEK EMAIL VERIFICATION
        if (!$user->email_verified_at) {
            \Log::warning('Email not verified, logout user');
            
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', '⚠️ Email Anda belum diverifikasi. Silakan cek email dan masukkan kode verifikasi terlebih dahulu.');
        }

        // CEK PROFIL LENGKAP (MAHASISWA)
        if ($user->role === 'mahasiswa' && !$user->profile_completed_at) {
            \Log::info('Profile not completed, redirect to complete profile');
            
            return redirect()->route('profile.complete')
                ->with('info', '📋 Selamat datang! Silakan lengkapi profil Anda untuk melanjutkan.');
        }

        // REDIRECT BERDASARKAN ROLE
        if ($user->role === 'admin') {
            \Log::info('Redirect to admin dashboard');
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->role === 'mahasiswa') {
            \Log::info('Redirect to mahasiswa dashboard');
            return redirect()->route('mahasiswa.dashboard');
        }

        \Log::warning('Unknown role, redirect to default dashboard');
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        \Log::info('User logout', ['user_id' => Auth::id()]);
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}