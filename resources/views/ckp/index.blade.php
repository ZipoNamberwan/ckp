@extends('layouts.main')
@section('stylesheet')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    @if (session('success-send'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-send') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
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
                                    {{$ckp->status->name_1}}
                                </td>
                                <td>
                                    <a href="{{url('/ckps/'.$ckp->id.'/edit')}}" class="btn btn-outline-info  btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-original-title="Entri CKP">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                    </a>
                                    <button onclick="deleteallactivities('{{$ckp->id}}', '{{$ckp->month->name}}')" class="btn btn-icon btn-outline-danger btn-sm" type="button" data-toggle="tooltip" data-original-title="Hapus Data">
                                        <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                    </button>
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
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

<script>
    function deleteallactivities(id, month) {
        Swal.fire({
            title: "Hapus Semua Kegiatan di CKP bulan " + month + "?",
            text: "*Kegiatan yang sudah dientri di CKP bulan ini akan hilang semua",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                var loading = document.getElementById('loading-background');
                loading.style.display = 'block';
                $.ajax({
                    url: "{{url('ckps/deleteallactivities')}}",
                    success: function(result, status, xhr) {
                        loading.style.display = 'none';
                        Swal.fire({
                            icon: 'success',
                            title: 'Semua Kegiatan Sudah Dihapus'
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        loading.style.display = 'none';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    },
                    data: {
                        id: id,
                    },
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        })
    }
</script>

@endsection