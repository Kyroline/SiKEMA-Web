@extends('layouts.app', ['title' => 'SiKEMA | Buat presensi', 'parent' => '', 'isPBM' => true])

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@endsection

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
    <div class="col-lg-12">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>List Mahasiswa</h3>
                </header>
                <div class="card-body py-0">
                    @isset($students)
                    <table id="dtStudent" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">NIM</th>
                                <th class="th-sm">Nama</th>
                                <th class="th-sm">Angkatan</th>
                                <th class="th-sm">Jam Kompen</th>
                                <th class="th-sm"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->Nim }}</td>
                                <td>{{ $student->Name }}</td>
                                <td>{{ $student->Year }}</td>
                                <td>{{ $student->compensation_hours }}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-warning">Warning</button> -->
                                    <a href="{{ route('attendance.get') }}">
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
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Jam Kompen</th>
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
    let table = new DataTable('#dtStudent');
</script>
@endsection