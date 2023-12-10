@extends('layouts.app', ['parent' => 'dashboard'])

@section('content')
<div class="row">
    <div class="col-lg-7">

        <div class="card" style="background-color:#FFC439;">

            <header class="notice-header">
                <h3>Interaksi Manusia Komputer</h3>
            </header>
            <div class="notice-body py-0" style="color: #fff">
                <div class="row">
                    <div class="col-9">
                        <h3>Kelas <span>TI-3B</span></h3>
                        <h3><strong>Pertemuan <span>1</span></strong></h3>
                    </div>
                    <div class="col-3" style="display: flex; justify-content: flex-end; align-items: flex-end;">
                        <button type="button" class="btn btn-sm btn-outline-dark text-uppercase">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection