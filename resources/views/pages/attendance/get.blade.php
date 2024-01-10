@extends('layouts.app', ['title' => 'SiKEMA | Buat presensi', 'parent' => 'presensi', 'child' => 'histori'])

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
                    @isset($events)
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Kelas</th>
                                <th class="th-sm">Nama Matakuliah</th>
                                <th class="th-sm">Tanggal Pembuatan</th>
                                <th class="th-sm">Week</th>
                                <th class="th-sm">Rasio</th>
                                <th class="th-sm">%</th>
                                <th class="th-sm">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $event->class->name }}</td>
                                <td>{{ $event->course->name }}</td>
                                <td>{{ $event->created_at }}</td>
                                <td>{{ $event->meet }}</td>
                                <td>{{ $event->student_count ?? '0' }} / {{ $event->class->student_count }}</td>
                                <td>{{ number_format(($event->student_count ?? 0) / $event->class->student_count * 100, 0) }}%</td>
                                <td>
                                    <a href="{{route('attendance.show', ['id' => $event->id])}}">
                                        @switch($event->status)
                                        @case(0)
                                        <span class="badge badge-success">Open</span>
                                        @break

                                        @case(1)
                                        <span class="badge badge-info">Open / QR</span>
                                        @break

                                        @case(2)
                                        <span class="badge badge-primary">Closed</span>
                                        @break

                                        @default

                                        @endswitch
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kelas</th>
                                <th>Matakuliah</th>
                                <th>Dosen</th>
                                <th>Week</th>
                                <th>Rasio</th>
                                <th>%</th>
                                <th>Status</th>
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
    let table = new DataTable('#dtBasicExample');
</script>
@endsection