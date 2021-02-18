@extends('layouts.main')
@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">

@endsection

@section('container')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="ni ni-app"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/settings')}}">Pengaturan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Periode Tahun</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="mb-0">Ubah Periode Tahun</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form autocomplete="off" method="post" action="/years/{{$year->id}}" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="name">Tahun</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{@old('name', $year->name)}}" id="name" name="name" placeholder="Tahun">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" id="sbmtbtn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

@endsection