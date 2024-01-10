<?php

namespace App\Http\Controllers\PBM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function get(Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token'),
        ])->get(config('api.host') . "/api/pbm/compensation");
        $data = json_decode($response);

        // echo $request->session()->get('token');
        $students = $data->data;
        return view('pages.student.pbm.get', compact('students'));
    }

    public function show(Request $request, string $id) {
        
    }
}
