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
        // kalo di session website kamu udah ada token
        if (session('access_token') != null) {
            // cek token sama yang ada di api
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('access_token'),
            ])->get('http://localhost:7777/api/auth/user-profile');
            
            // kalo tokennya masih valid, statusnya 200
            if ($response->status() == 200){
                return $next($request);
            }

            // kalo udah ngga valid ya sessionnya dihapus redirect ke login
            else {
                $request->session()->flush();
                return redirect('login'); //redirect()->away('url ke login gwa')
            }
        } 

        // kalo sessionnya baru aja dikirim dari portal
        else if ($request->has('access_token')) {
            // hapus session yang lama kalo ada
            $request->session()->flush();
            // pake session yang baru
            session(['access_token' => $request['access_token']]);
        }

        // ini kalo emang blm login sama sekali, di session ga ada, ga bawa token sama sekali
        else {
            return redirect('login'); //redirect()->away('url ke login gwa')
        }
    }
}

