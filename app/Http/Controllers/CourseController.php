<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    function get() {
        $response = Http::get(config('api.host') . '/api/lecturer/1/course');
        $courses = json_decode($response)->data;

        return view('pages.course.get', compact('courses'));
    }
}
