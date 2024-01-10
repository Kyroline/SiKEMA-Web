<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

use Config;

function remove_duplicateKeys($key, $data)
{

    $_data = array();

    foreach ($data as $v) {
        if (isset($_data[$v[$key]])) {
            // found duplicate
            continue;
        }
        // remember unique item
        $_data[$v[$key]] = $v;
    }
    // if you need a zero-based array
    // otherwise work with $_data
    $data = array_values($_data);
    return $data;
}

class AttendanceController extends Controller
{

    public function new(Request $request)
    {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('token'),
        ])->get(config('api.host') . '/api/lecturer/' . $user->lecturer->ID . '/course');

        $enrollments = json_decode($response)->data;
        $courses = array();
        $classes = array();

        foreach ($enrollments as $enrollment) {
            array_push($courses, ["id" => $enrollment->course->id, "name" => $enrollment->course->name]);
            array_push($classes, ["id" => $enrollment->class->id, "name" => $enrollment->class->name]);
        }
        $courses = remove_duplicateKeys('id', $courses);
        $classes = remove_duplicateKeys('id', $classes);
        return view('pages.attendance.new', compact('courses', 'classes'));
    }

    public function get(Request $request)
    {
        $course_id = '';
        $class_id = '';
        if ($request->has('course_id'))
            $course_id = $request->input('course_id');
        if ($request->has('class_id'))
            $class_id = $request->input('class_id');
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('token'),
        ])->get(config('api.host') . '/api/lecturer/' . $user->lecturer->ID . '/event?course_id=' . $course_id . '&class_id=' . $class_id);

        $events = json_decode($response)->data;
        foreach ($events as &$event) {
            $date = Carbon::parse($event->created_at);
            $event->created_at = $date->format('d-m-Y H:i:s');
        }
        return view('pages.attendance.get', compact('events', 'user'));
    }

    public function edit(Request $request, string $id)
    {
        return view('');
    }

    public function show(Request $request, string $id)
    {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('token'),
        ])->get(config('api.host') . "/api/lecturer/" . $user->lecturer->ID . "/event/" . $id);
        $data = json_decode($response);

        $course_name = $data->data->course->name;
        $class_name = $data->data->class->name;
        $meet_n = $data->data->meet;
        $status = $data->data->status;

        $presents = array();
        if (!empty($data->data->students)) {
            foreach ($data->data->students as $student) {
                array_push($presents, $student->Nim);
            }
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('token'),
        ])->get(config('api.host') . "/api/class/" . $data->data->class->id);
        $data = json_decode($response);
        $students = $data->data->students;

        foreach ($students as &$student) {
            $student->status = in_array($student->Nim, $presents);
        }


        return view('pages.attendance.show', compact('status', 'students', 'course_name', 'class_name', 'meet_n', 'id'));
    }

    public function update(Request $request, string $id)
    {
        return view('', compact(''));
    }

    public function create(Request $request)
    {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->post(config('api.host') . '/api/lecturer/' . $user->lecturer->ID . '/event', [
            "lecturer_id" => $user->lecturer->ID,
            "class_id" => (int)$request->id_class,
            "course_id" => (int)$request->id_course,
            "meet" => (int)$request->meet,
            'status' => 0,
        ]);

        $data = json_decode($response)->data;
        return redirect()->route('attendance.show', $data->id);
    }

    public function add_student(Request $request, string $id)
    {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->post(config('api.host') . "/api/lecturer/" . $user->lecturer->ID . "/event/" . $id . "/student", [
            "student_id" => $request->added_student
        ]);

        if ($response->status() <= 400)
            return route('attendance.show', $id);

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->delete(config('api.host') . "/api/lecturer/1/event/" . $id . "/student", [
            "student_id" => $request->removed_student
        ]);

        if ($response->status() <= 400)
            return redirect()->route('attendance.show', $id);

        return redirect()->route('attendance.show', $id);
    }

    public function finalize(Request $request, string $id)
    {
        $user = $request->session()->get('user');
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $request->session()->get('token')
        ])->patch(config('api.host') . "/api/lecturer/" . $user->lecturer->ID . "/event/" . $id . "/finalize");

        if ($response->status() <= 400)
            return route('attendance.show', $id);

        return redirect()->route('attendance.show', $id);
    }
}
