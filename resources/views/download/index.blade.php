@extends('layouts.main')
@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
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
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-file-alt"></i></a></li>
                            <li class="breadcrumb-item active"><a href="{{url('/ckps')}}">CKP</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Entri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    @if (session('success-download'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-download') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    @if (session('error-download'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-times"></i></span>
        <span class="alert-text"><strong>Error! </strong>{{ session('error-download') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="mb-0">Download CKP</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formupdate" autocomplete="off" method="post" action="/download" class="needs-validation d-inline" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="year">Tahun</label>
                                <select class="form-control @error('year') is-invalid @enderror" data-toggle="select" name="year">
                                    @foreach($years as $year)
                                    <option value="{{$year->id}}" {{ old('year') == $year->id ? 'selected' : '' }}>{{$year->name}}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                <div class="error-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="month">Bulan</label>
                                <select class="form-control @error('month') is-invalid @enderror" data-toggle="select" name="month">
                                    @foreach($months as $month)
                                    <option value="{{$month->id}}" {{ old('month') == $month->id ? 'selected' : '' }}>{{$month->name}}</option>
                                    @endforeach
                                </select>
                                @error('month')
                                <div class="error-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3" id="sbmtbtn" type="submit">Unduh</button>
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