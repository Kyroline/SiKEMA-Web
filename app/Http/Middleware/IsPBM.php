<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPBM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user'))
            return to_route('auth.login');
        $user = $request->session()->get('user');

        if ($user->type != 2 || empty($user->pbm)) { // 2 is for lecturer, whereas 2 is for PBM, and 0 for student
            $request->session()->flush();
            abort(403);
        }

        return $next($request);
    }
}
