<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request) {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('api.host') . '/api/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $data = json_decode($response);

        if ($response->ok()) {
            
            $request->session()->put('token', $data->data->access_token);
            // $request->session()->put('user', $data->data->user);
            return to_route('dashboard');
        } else {
            return to_route('auth.login');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return to_route('auth.login');
    }
}
