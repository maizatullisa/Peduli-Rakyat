<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login & dia admin
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request); // boleh lanjut
        }

        // Kalau bukan admin, tolak
        return response()->json(['message' => 'Unauthorized. Admin only.'], 403);
    }
}
