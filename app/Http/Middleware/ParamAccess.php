<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParamAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('access_token', Carbon::now()->format('Ymd'))->first();
        if(@$user) {
            return $next($request);
        }
        return response()->json([
            'status' => 'Unauthorized',
            'data' => null,
            'errors' => 'Harap login/registrasi lebih dulu'
        ],401);
    }
}
