<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    // By Lecturer
    function get(Request $request) {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('token'),
        ])->get(config('api.host') . '/api/lecturer/' . $user->lecturer->ID . '/course');
        $courses = json_decode($response)->data;

        return view('pages.course.get', compact('courses'));
    }
}
