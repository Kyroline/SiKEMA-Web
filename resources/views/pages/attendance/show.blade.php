@extends('layouts.app', ['title' => 'SiKEMA | Buat presensi', 'parent' => 'presensi'])

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
                <form method="POST" action="{{ route('attendance.finalize', $id) }}">
                    @method('patch')
                    @csrf
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
                        @if ($status != 2)
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-sm" id="formGroupExampleInput" value="Finalize">
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @if ($status == 1)
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>QR Code</h3>
                </header>
                <div class="card-body py-0">
                    <div id="qrcode-sm"></div>
                </div>
                <a class="btn btn-primary btn-sm text-uppercase mb-4 ml-4 mr-4 mr-md-4" href="#" data-toggle="modal" data-target="#qr-modal">Detail</a>
            </div>
        </div>
        @elseif ($status == 0)
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>QR Code</h3>
                </header>
                <div class="card-body py-0">
                    <div class="alert alert-info alert-sm" role="alert">
                        Aktifkan QR Code melalui aplikasi
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="col-lg-7">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>List Mahasiswa</h3>
                    @if ($status != 2)
                    <div id="confirm-changes" style="display: none;">
                        <h5>Terdeteksi perubahan</h5>
                        <button class="btn btn-sm btn-primary" id="confirm-changes_btn">Konfirmasi</button>
                    </div>
                    @endif
                </header>
                <div class="card-body py-0">
                    @isset($students)
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
                                    <a href="#">
                                        <span class="badge badge-success">Hadir</span>
                                    </a>
                                    @if ($status != 2)
                                    <input value="{{ $student->Nim }}" class="attendance-cb" type="checkbox" checked>
                                    @endif
                                    @else
                                    <a href="#">
                                        <span class="badge badge-danger">Tidak hadir</span>
                                    </a>
                                    @if ($status != 2)
                                    <input value="{{ $student->Nim }}" class="attendance-cb" type="checkbox">
                                    @endif
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
                    @endisset
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
                <div id="qrcode"></div>
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
@if ($status != 3)
<script>
    var addedStudent = []
    var removedStudent = []
    $("div#confirm-changes").hide();
    var changeListener = {
        isChanged: true,

        setChanged: function(newValue) {
            this.isChanged = newValue;
            $(document).trigger('attendanceChanged', [newValue]);
        }
    };

    $("input.attendance-cb").each(function() {
        var currentElement = $(this)
        var defaultState = currentElement.prop("checked");

        currentElement.change(function() {
            if (currentElement.prop("checked") !== defaultState) {
                changeListener.setChanged(true)
                $("div#confirm-changes").show()
                if (currentElement.prop("checked")) {
                    addedStudent.push(currentElement.val())
                } else {
                    removedStudent.push(currentElement.val())
                }
            } else {
                if (currentElement.prop("checked")) {
                    var indexOfElementToRemove = removedStudent.indexOf(currentElement.val());
                    if (indexOfElementToRemove !== -1) {
                        removedStudent.splice(indexOfElementToRemove, 1);
                    }
                } else {
                    var indexOfElementToRemove = addedStudent.indexOf(currentElement.val());
                    if (indexOfElementToRemove !== -1) {
                        addedStudent.splice(indexOfElementToRemove, 1);
                    }
                }
            }
        })
    })

    $('button#confirm-changes_btn').click(function() {
        $.ajax({
            url: '{{ route("attendance.add_student", $id) }}',
            type: 'POST',
            // contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "added_student": addedStudent,
                "removed_student": removedStudent
            },
            success: function(response) {
                console.log('Request successful!', response);
                window.location = "{{ route('attendance.show', $id) }}"
                // Optionally, handle the response here
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    })

    $(document).on('attendanceChanged', function(event, newValue) {
        console.log('myVariable changed to:', newValue);
    });
</script>
@endif
<script src="{{ asset('assets/js/qrcode.min.js') }}"></script>
<script type="text/javascript">
    new QRCode(document.getElementById("qrcode-sm"), "http://jindo.dev.naver.com/collie");
    new QRCode(document.getElementById("qrcode"), "http://jindo.dev.naver.com/collie");
</script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script>
    // let table = new DataTable('#dtBasicExample');
    $(document).ready(function() {
        $('#dtBasicExample').DataTable({
            "columnDefs": [{
                "targets": [1], // Replace [0] with the index of the column you want to adjust
                "render": function(data, type, row) {
                    // Adjust the length (e.g., 20 characters) based on your requirements
                    return "<div style='white-space:normal; width:250px;'>" + data + "</div>"
                    // return '<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">' + data + '</div>';
                }
            }]
        });
    });
</script>
@endsection