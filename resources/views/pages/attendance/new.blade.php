@extends('layouts.app', ['title' => 'SiKEMA | Buat presensi', 'parent' => 'presensi', 'child' => 'buat'])

@section('content')
<!-- Content Body -->
<div class="mb-4">
    <h1 class="h2 mb-2">Blank Page</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>Detail</h3>
                </header>
                <div class="card-body py-0">
                    <form action="{{ route('attendance.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="matakuliah">Matakuliah</label>
                            <select class="form-control form-control-sm" id="matakuliah" name="id_course">
                                <option></option>
                                @foreach ($courses as $course)
                                <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control form-control-sm" id="kelas" name="id_class">
                                <option></option>
                                @foreach ($classes as $class)
                                <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pertemuan">Pertemuan</label>
                            <select class="form-control form-control-sm" id="pertemuan" name="meet">
                                @for ($i = 1; $i <= 16; $i++) <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-sm btn-primary" id="confirm-changes_btn" type="submit" value="Buat"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection