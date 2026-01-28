<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip middleware untuk route verification, complete-profile, dan logout
        if ($request->routeIs('verification.show') || 
            $request->routeIs('verification.verify') ||
            $request->routeIs('verification.resend') ||
            $request->routeIs('profile.complete') ||
            $request->routeIs('profile.complete.store') ||
            $request->routeIs('logout')) {
            return $next($request);
        }

        // Cek apakah user sudah verifikasi email
        if (auth()->check() && !auth()->user()->email_verified_at) {
            \Log::warning('CheckEmailVerified BLOCKED', [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email,
                'route' => $request->route()->getName(),
                'email_verified_at' => auth()->user()->email_verified_at
            ]);

            return redirect()->route('verification.show')
                ->with('warning', 'Silakan verifikasi email Anda terlebih dahulu.');
        }

        \Log::info('CheckEmailVerified PASSED', [
            'user_id' => auth()->id(),
            'route' => $request->route()->getName()
        ]);

        return $next($request);
    }
}