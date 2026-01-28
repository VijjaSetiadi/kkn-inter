<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileCompleted
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip untuk route complete-profile
        if ($request->routeIs('profile.complete') || $request->routeIs('profile.complete.store')) {
            return $next($request);
        }

        // Cek apakah user sudah lengkapi profil
        if (auth()->check() && !auth()->user()->profile_completed_at) {
            return redirect()->route('profile.complete')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        return $next($request);
    }
}