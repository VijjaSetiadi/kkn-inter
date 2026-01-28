<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            \Log::warning('CheckRole: Not authenticated');
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (auth()->user()->role !== $role) {
            \Log::warning('CheckRole BLOCKED', [
                'user_id' => auth()->id(),
                'expected_role' => $role,
                'actual_role' => auth()->user()->role,
                'route' => $request->route()->getName()
            ]);

            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        \Log::info('CheckRole PASSED', [
            'user_id' => auth()->id(),
            'role' => $role,
            'route' => $request->route()->getName()
        ]);

        return $next($request);
    }
}