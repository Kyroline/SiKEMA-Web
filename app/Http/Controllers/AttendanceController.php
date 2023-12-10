<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Config;

class AttendanceController extends Controller
{
    public function new()
    {
        return view('pages.blank', ['parent' => 'dashboard', 'child' => 'buat']);
    }

    public function get(Request $request)
    {
        return view('');
    }

    public function edit(Request $request, string $id)
    {
        return view('');
    }

    public function show(Request $request, string $id)
    {
        // $response = Http::get(config('api.host') . "/api/class/1");
        $response = Http::get("http://localhost:8080/api/lecturer/1/event/" . $id);
        $data = json_decode($response);

        $course_name = $data->data->course->name;
        $class_name = $data->data->class->name;
        $meet_n = $data->data->meet;

        $presents = array();
        if (!empty($data->data->students)){
        foreach ($data->data->students as $student) {
            array_push($presents, $student->Nim);
        }}

        $response = Http::get("http://localhost:8080/api/class/" . $data->data->class->id);
        $data = json_decode($response);
        $students = $data->data->students;

        foreach ($students as &$student) {
            $student->status = in_array($student->Nim, $presents);
        }

        return view('pages.attendance.show', compact('students', 'course_name', 'class_name', 'meet_n'));
    }

    public function update(Request $request, string $id)
    {
        return view('', compact(''));
    }

    public function create(Request $request)
    {
        return view('', compact(''));
    }
}
