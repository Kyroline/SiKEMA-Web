@extends('layouts.app', ['title' => 'SiKEMA | Buat presensi', 'parent' => ''])

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@endsection

@section('content')
<!-- Content Body -->
<div class="mb-4">
    <h1 class="h2 mb-2">Detail Presensi</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Presensi</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                    <div class="form-group">
                        <label for="formGroupExampleInput">Matakuliah</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" placeholder="{{ $course_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kelas</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" placeholder="{{ $class_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Pertemuan</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" placeholder="{{ $meet_n }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>QR Code</h3>
                </header>
                <div class="card-body py-0">
                    <img class="img-fluid" src="https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg" alt="">
                </div>
                <a class="btn btn-primary btn-sm text-uppercase mb-4 ml-4 mr-4 mr-md-4" href="#" data-toggle="modal" data-target="#qr-modal">Detail</a>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>List Mahasiswa</h3>
                </header>
                <div class="card-body py-0">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">NIM</th>
                                <th class="th-sm">Name</th>
                                <th class="th-sm">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->Nim }}</td>
                                <td>{{ $student->Name }}</td>
                                <td>
                                    @if ($student->status == 1)
                                    <a href=""><span class="badge badge-success">Hadir</span></a>
                                    @else
                                    <a href=""><span class="badge badge-danger">Tidak hadir</span></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>NIM</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Modal -->
<div id="qr-modal" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" src="https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection

@section('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script>
    let table = new DataTable('#dtBasicExample');
</script>
@endsection