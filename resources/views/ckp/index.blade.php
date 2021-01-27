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
                            <li class="breadcrumb-item active" aria-current="page">CKP</li>
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
                            <h2 class="mb-0">CKP</h2>
                        </div>
                    </div>
                </div>
                <div class="form-row mx-3 my-3">
                    <div class="col-md-3">
                        <label class="form-control-label mb-3" for="validationCustom05">Tahun</label>
                        <select class="form-control d-inline" data-toggle="select" name="sockettype">
                            @foreach($years as $year)
                                <option value="{{$year->id}}">{{$year->name}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary mt-3 d-inline" type="button">Tampilkan</button>
                    </div>
                </div>
                
                <div class="table-responsive py-4">
                    <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th width="10%">#</th>
                            <th width="30%">Bulan</th>
                            <th width="20%">Status</th>
                            <th width="20%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($ckps as $ckp)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><b>{{$ckp->month->name}}</b></td>
                                <td>
                                    {{$ckp->status->name}}
                                </td>
                                <td>
                                    <a href="{{url('/entrickp/'.$ckp->month->id.'/'.$currentyear->id)}}" class="btn btn-outline-info  btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-original-title="Entri CKP">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                      </a>
                                    <form class="d-inline" method="POST" action="#">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-icon btn-outline-danger btn-sm" type="submit" data-toggle="tooltip" data-original-title="Hapus Data">
                                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                        </button>
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

@endsection