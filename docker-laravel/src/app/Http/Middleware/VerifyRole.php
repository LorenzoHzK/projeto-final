<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VerifyRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (Auth::check() && in_array(Auth::user()->role, $role)) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized, you can do it.'], Response::HTTP_UNAUTHORIZED);
    }
}
