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
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="mb-0">CKP {{$month->name}} {{$year->name}}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row mb-3 mt-3">
                        <div class="col">
                            <label class="form-control-label">Kegiatan Utama</label>
                            <div id="selection-container">
                                <div class="table-responsive py-2">
                                    <table class="table" width="100%" id="main-component-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Nama Kegiatan</th>
                                                <th width="10%">Satuan</th>
                                                <th width="10%">Target</th>
                                                <th width="10%">Realisasi</th>
                                                <th width="10%">Kualitas</th>
                                                <th width="20%">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>

                                            </tr>
                                            <tr>
                                                <td><b>Utama</b>
                                                    @error('activities')
                                                    <div class="error-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button id="select-processor-button" type="button" class="btn btn-secondary btn-sm" onclick="addactivity()">
                                                        <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                                        <span class="btn-inner--text">Tambah Kegiatan</span>
                                                    </button>
                                                </td>
                                                <td></td><td></td><td></td><td></td><td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')

@endsection