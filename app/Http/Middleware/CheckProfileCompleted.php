<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompleted
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Skip middleware untuk route-route tertentu
        if ($request->routeIs('profile.complete') || 
            $request->routeIs('profile.complete.store') ||
            $request->routeIs('logout') ||
            $request->routeIs('login') ||
            $request->routeIs('register.*')) {
            return $next($request);
        }

        // ✅ Skip jika user belum login
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        // ✅ BYPASS untuk ADMIN - Admin tidak perlu melengkapi profil
        if ($user->role === 'admin') {
            \Log::info('CheckProfileCompleted BYPASSED for ADMIN', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'route' => $request->route()->getName()
            ]);
            
            return $next($request);
        }

        // ✅ Cek apakah profil sudah lengkap (untuk mahasiswa)
        $isProfileComplete = !empty($user->nim) 
            && !empty($user->name) 
            && !empty($user->no_telepon) 
            && !empty($user->fakultas) 
            && !empty($user->program_studi) 
            && !empty($user->angkatan) 
            && !empty($user->semester) 
            && !empty($user->ipk);

        if (!$isProfileComplete) {
            \Log::warning('CheckProfileCompleted BLOCKED - Profile Incomplete', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'route' => $request->route()->getName(),
                'nim' => $user->nim ?? 'NULL',
                'no_telepon' => $user->no_telepon ?? 'NULL',
                'fakultas' => $user->fakultas ?? 'NULL',
            ]);

            return redirect()->route('profile.complete')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        \Log::info('CheckProfileCompleted PASSED', [
            'user_id' => $user->id,
            'role' => $user->role,
            'route' => $request->route()->getName()
        ]);

        return $next($request);
    }
}