<?php

namespace App\Http\Controllers\PBM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function get() {
        $response = Http::get(config('api.host') . "/api/compensation");
        $data = json_decode($response);

        $students = $data->data;
        return view('pages.student.pbm.get', compact('students'));
    }
}
