@extends('layouts.app', ['title' => 'SiKEMA | Matakuliah Saya', 'parent' => 'kursus'])

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@endsection

@section('content')
<!-- Content Body -->
<div class="mb-4">
    <h1 class="h2 mb-2">Presensi</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Presensi</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>List Presensi</h3>
                </header>
                <div class="card-body py-0">
                    @isset($courses)
                    <table id="dtCourse" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Kode</th>
                                <th class="th-sm">Nama Matakuliah</th>
                                <th class="th-sm">Kelas</th>
                                <th class="th-sm"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->course->code }}</td>
                                <td>{{ $course->course->name }}</td>
                                <td>{{ $course->class->name }}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-warning">Warning</button> -->
                                    <a href="{{ route('attendance.get',['course_id'=> $course->course->id, 'class_id' => $course->class->id]) }}">
                                        <span class="badge badge-warning">
                                            <span class="material-symbols-outlined">
                                                edit_square
                                            </span>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Matakuliah</th>
                                <th>Kelas</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script>
    let table = new DataTable('#dtCourse');
</script>
@endsection