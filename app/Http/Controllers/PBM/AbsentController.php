<?php

namespace App\Http\Controllers\PBM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AbsentController extends Controller
{
    public function get() {
        $response = Http::get(config('api.host') . "/api/absent");
        $data = json_decode($response);

        $absents = $data->data;
        return view('pages.absent.get', compact('absents'));
    }

    public function show(string $id) {
        $response = Http::get(config('api.host') . "/api/absent/" . $id);
        $data = json_decode($response);

        $absent = $data->data;

        $response = Http::get(config('api.host') . "/api/absent/" . $id . "/excuse");
        $excuse = null;
        if ($response->status() == 200) {
            $data = json_decode($response);
            $excuse = $data->data;
            $excuse->status = $excuse->status ?? 0;
        }

        return view('pages.absent.show', compact('absent', 'excuse'));
    }
}
