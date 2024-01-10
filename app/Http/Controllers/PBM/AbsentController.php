<?php

namespace App\Http\Controllers\PBM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AbsentController extends Controller
{
    public function get(Request $request)
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->get(config('api.host') . "/api/pbm/absent");
        $data = json_decode($response);

        $absents = $data->data;
        return view('pages.absent.get', compact('absents'));
    }

    public function show(Request $request, string $id)
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->get(config('api.host') . "/api/pbm/absent/" . $id);
        $data = json_decode($response);

        $absent = $data->data;

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->get(config('api.host') . "/api/pbm/absent/" . $id . "/excuse");
        $excuse = null;
        $excuse_file = null;
        if ($response->status() == 200) {
            $data = json_decode($response);
            $excuse = $data->data;
            $excuse->status = $excuse->status ?? 0;
            $excuse_file = config('api.host') . '/files/' . $excuse->attachment;
        }


        return view('pages.absent.show', compact('absent', 'excuse', 'excuse_file'));
    }
}
