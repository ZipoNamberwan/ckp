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
                            <h2 class="mb-0">CKP {{$currentyear->name}}</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary btn-round btn-icon mb-2" data-toggle="modal" data-target="#modal-default"><i class="fas fa-question"></i></button>
                        </div>
                        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title" id="modal-title-default">FAQ</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>1. Apa</p>
                                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="form-row mx-3 my-3">
                    <div class="col-md-3">
                        <label class="form-control-label mb-3" for="year">Tahun</label>
                        <select class="form-control d-inline" data-toggle="select" name="year" id="year">
                            @foreach($years as $year)
                            <option value="{{$year->id}}" @if($year->id == $currentyear->id) selected @endif>{{$year->name}}</option>
                            @endforeach
                        </select>
                        <button onclick="getckpbyyear()" class="btn btn-primary mt-3 d-inline" type="button">Tampilkan</button>
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
                                    <h3><span class="badge badge-{{$ckp->status->color}}">{{$ckp->status->name_1}}</span></h3>
                                </td>
                                <td>
                                    <a href="{{url('/ckps/ckpt/'.$ckp->id.'/edit')}}" class="btn btn-outline-info btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-original-title="Entri CKP-T">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>CKP T
                                    </a>
                                    @if($ckp->status->id > 2)
                                    <a href="{{url('/ckps/ckpr/'.$ckp->id.'/edit')}}" class="btn btn-outline-primary  btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-original-title="Entri CKP-R">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>CKP R
                                    </a>
                                    @endif
                                    {{-- <button onclick="deleteallactivities('{{$ckp->id}}', '{{$ckp->month->name}}')" class="btn btn-icon btn-outline-danger btn-sm" type="button" data-toggle="tooltip" data-original-title="Hapus Data">
                                        <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                    </button> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col ml-3 mb-3">
                    <div class="row">
                        <strong>Catatan:*</strong>
                    </div>
                    <div class="row">
                        <p class="m-0">1. Entri CKP-T terlebih dahulu, kemudian entri CKP-R</p>
                    </div>
                    <div class="row">
                        <p class="m-0">2. CKP-R baru bisa dientri jika CKP-T sudah <strong>FINALISASI</strong></p>
                    </div>
                    <div class="row">
                        <p class="m-0">3. CKP-T yang sudah FINAL bisa diperbaiki menggunakan tombol <strong>PERBAIKI</strong></p>
                    </div>
                    <div class="row">
                        <p class="m-0">4. Perbaikan CKP-T tidak menghapus data CKP-R, hanya tidak bisa akses CKP-R sampai finalisasi CKP-T lagi</p>
                    </div>
                    <div class="row">
                        <p class="m-0">5. CKP-R yang sudah dientri bisa di-<strong>KIRIM</strong> untuk dinilai oleh atasan</p>
                    </div>
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
                        if (result.issuccess == true) {
                            Swal.fire({
                                icon: 'success',
                                title: result.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result.message,
                            });
                        }

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

<script>
    function getckpbyyear() {
        var year = document.getElementById('year').value;
        var url = "{{url('/ckps/year/')}}/" + year;

        window.location.assign(url);
    }
</script>

@endsection