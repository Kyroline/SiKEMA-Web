<?php

namespace App\Http\Controllers\PBM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExcuseController extends Controller
{
    function update(Request $request, string $id)
    {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->patch(config('api.host') . "/api/pbm/excuse/" . $id, [
            "excuse" => $request->excuse,
            "status" => intval($request->status),
        ]);
    }
}
