<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (session('access_token') == null)
        if (!$request->session()->has('token'))
            return to_route('auth.login');
        // $token = session('access_token');
        $token = $request->session()->get('token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://localhost:8080/api/auth/validate');

        if ($response->status() == 200) {
            return $next($request);
        } else {
            $request->session()->flush();
            return to_route('auth.login'); //redirect()->away('url ke login gwa')
        }
    }
}
