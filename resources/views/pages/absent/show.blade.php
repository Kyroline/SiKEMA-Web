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
    @isset($absent)
    <div class="col-lg-6">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>Detail Mahasiswa</h3>
                </header>
                <div class="card-body py-0">
                    <div class="form-group">
                        <label for="formGroupExampleInput">NIM</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->student->Nim }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->student->Name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Angkatan</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->student->Year }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kelas</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->event->class->name }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>Detail Presensi</h3>
                </header>
                <div class="card-body py-0">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kode Mata Kuliah</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->event->course->code }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Mata Kuliah</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->event->course->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Dosen</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->event->lecturer->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Pertemuan</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" value="{{ $absent->event->meet }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col-12 mb-3">
            <div class="card">
                <header class="card-header">
                    <h3>Alasan Ketidakhadiran</h3>
                </header>
                <div class="card-body py-0">
                    @if (isset($excuse))
                    <form action="{{ route('pbm.excuse.update', $excuse->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="attachment">Attachments</label>
                            <input type="text" class="form-control form-control-sm" id="attachment" value="{{ $excuse->attachment }}" readonly>
                            <a href="{{ ($excuse_file ?? '') }}">Lihat</a>
                        </div>
                        <div class="form-group">
                            <label for="comment">Komentar</label>
                            <textarea name="excuse" type="text" class="form-control form-control-sm" id="comment">{{ $excuse->excuse }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="status" value="0" class="custom-control-input" {{ $excuse->status == 0 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customRadioInline2">Pending</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="status" value="1" class="custom-control-input" {{ $excuse->status == 1 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customRadioInline1">Tolak</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="status" value="2" class="custom-control-input" {{ $excuse->status == 2 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customRadioInline3">Terima</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-sm " id="formGroupExampleInput" />
                        </div>
                    </form>
                    @else
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control form-control-sm" id="status" value="Belum ada alasan" readonly />
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script>
    let table = new DataTable('#dtStudent');
</script>
@endsection