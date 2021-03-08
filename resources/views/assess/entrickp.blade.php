@extends('layouts.main')
@section('stylesheet')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />

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
                            <li class="breadcrumb-item" aria-current="page"><a href="{{url('/ratings')}}">Penilaian</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Isi Penilaian</li>
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
                            <h2 class="mb-0">Isi Penilaian CKP</h2>
                        </div>
                        <div class="col-6 text-right">
                            <a target="_blank" href="/ckps/{{$ckp->ckp->id}}" class="btn btn-outline-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Lihat CKP-T dan CKP-R">
                                <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                <span class="btn-inner--text">Lihat CKP</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="mb-0">
                                    Satuan Organisasi
                                </h5>
                            </div>
                            <div class="col-auto">
                                <h5>
                                    : {{$ckp->ckp->user->department->name}}
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="mb-0">
                                    Nama
                                </h5>
                            </div>
                            <div class="col-auto">
                                <h5>
                                    : {{$ckp->ckp->user->name}}
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="mb-0">
                                    Periode
                                </h5>
                            </div>
                            <div class="col-auto">
                                <h5>
                                    : {{$ckp->ckp->month->name}} {{$ckp->ckp->year->name}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="formupdate" autocomplete="off" method="post" action="/ratings/{{$ckp->id}}" class="needs-validation d-inline" enctype="multipart/form-data" novalidate>
                    @method('PATCH')
                    @csrf
                    <div class="form-row mb-3 mt-3">
                        <div class="col">
                            <div id="selection-container">
                                <div class="table-responsive py-2">
                                    <table class="table" width="90%" id="ckp-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="3%">No</th>
                                                <th width="30%" class="px-1">Nama Kegiatan</th>
                                                <th width="7%" class="px-1">Satuan</th>
                                                <th width="7%" class="px-1">Target</th>
                                                <th width="7%" class="px-1">Realisasi</th>
                                                <th width="7%" class="px-1">Kualitas</th>
                                                <th width="4%" class="px-1">Angka Kredit</th>
                                                <th width="15%" class="px-1">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7"><b>Kegiatan Utama</b></td>
                                            </tr>
                                            @if (old('activityquality'))
                                            @for($i = 0; $i < count(old('activityquality')); $i++) @if(old('activitytype.'.$i)=='main' ) <tr>
                                                <td>{{$i}}</td>
                                                <td class="px-1"><input class="form-control" type="text" name="activityname[]" value="{{old('activityname.'.$i)}}" readonly><input type="hidden" name="activitytype[]" value="{{old('activitytype.'.$i)}}">
                                                    <input type="hidden" name="activityid[]" value="{{old('activityid.'.$i)}}">
                                                </td>
                                                <td class="px-1">
                                                    <input class="form-control" type="text" name="activityunit[]" value="{{old('activityunit.'.$i)}}" readonly>
                                                </td>
                                                <td class="px-1">
                                                    <input class="form-control" type="text" name="activitytarget[]" value="{{old('activitytarget.'.$i)}}" readonly>
                                                </td>
                                                <td class="px-1">
                                                    <input class="form-control" type="text" name="activityreal[]" value="{{old('activityreal.'.$i)}}" readonly>
                                                </td>
                                                <td class="px-1">
                                                    <input class="form-control" min="0" max="100" type="number" name="activityquality[]" value="{{old('activityquality.'.$i)}}">
                                                    @error('activityquality.'.$i)
                                                    <div class="error-feedback">
                                                        error
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1">
                                                    <input class="form-control" type="text" name="activitycredit[]" value="{{old('activitycredit.'.$i)}}" readonly>
                                                </td>
                                                <td class="px-1">
                                                    <input class="form-control" type="text" name="activitynote[]" value="{{old('activitynote.'.$i)}}" readonly>
                                                </td>
                                                </tr>
                                                @endif
                                                @endfor
                                                @else
                                                @for($i = 0; $i < count($activities); $i++) @if($activities[$i]->type == 'main')
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td class="px-1"><input class="form-control" type="text" name="activityname[]" value="{{$activities[$i]->name}}" readonly><input type="hidden" name="activitytype[]" value="{{$activities[$i]->type}}">
                                                            <input type="hidden" name="activityid[]" value="{{$activities[$i]->id}}">
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activityunit[]" value="{{$activities[$i]->unit}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activitytarget[]" value="{{$activities[$i]->target}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activityreal[]" value="{{$activities[$i]->real}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" min="0" max="100" type="number" name="activityquality[]" value="{{$activities[$i]->quality}}">
                                                            @error('activityquality.'.$i)
                                                            <div class="error-feedback">
                                                                error
                                                            </div>
                                                            @enderror
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activitycredit[]" value="{{$activities[$i]->credit}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activitynote[]" value="{{$activities[$i]->note}}" readonly>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endfor
                                                    @endif
                                                    <tr>
                                                        <td colspan="7"><b>Kegiatan Tambahan</b></td>
                                                    </tr>
                                                    @if (old('activityquality'))
                                                    @for($i = 0; $i < count(old('activityquality')); $i++) @if(old('activitytype.'.$i)=='additional' ) <tr>
                                                        <td>{{$i}}</td>
                                                        <td class="px-1"><input class="form-control" type="text" name="activityname[]" value="{{old('activityname.'.$i)}}" readonly><input type="hidden" name="activitytype[]" value="{{old('activitytype.'.$i)}}">
                                                            <input type="hidden" name="activityid[]" value="{{old('activityid.'.$i)}}">
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activityunit[]" value="{{old('activityunit.'.$i)}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activitytarget[]" value="{{old('activitytarget.'.$i)}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activityreal[]" value="{{old('activityreal.'.$i)}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" min="0" max="100" type="number" name="activityquality[]" value="{{old('activityquality.'.$i)}}">
                                                            @error('activityquality.'.$i)
                                                            <div class="error-feedback">
                                                                error
                                                            </div>
                                                            @enderror
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activityreal[]" value="{{old('activityreal.'.$i)}}" readonly>
                                                        </td>
                                                        <td class="px-1">
                                                            <input class="form-control" type="text" name="activitynote[]" value="{{old('activitynote.'.$i)}}" readonly>
                                                        </td>
                                                        </tr>
                                                        @endif
                                                        @endfor @else
                                                        @for($i=0; $i < count($activities); $i++) @if($activities[$i]->type == 'additional')
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td class="px-1"><input class="form-control" type="text" name="activityname[]" value="{{$activities[$i]->name}}" readonly><input type="hidden" name="activitytype[]" value="{{$activities[$i]->type}}">
                                                                    <input type="hidden" name="activityid[]" value="{{$activities[$i]->id}}">
                                                                </td>
                                                                <td class="px-1">
                                                                    <input class="form-control" type="text" name="activityunit[]" value="{{$activities[$i]->unit}}" readonly>
                                                                </td>
                                                                <td class="px-1">
                                                                    <input class="form-control" type="text" name="activitytarget[]" value="{{$activities[$i]->target}}" readonly>
                                                                </td>
                                                                <td class="px-1">
                                                                    <input class="form-control" type="text" name="activityreal[]" value="{{$activities[$i]->real}}" readonly>
                                                                </td>
                                                                <td class="px-1">
                                                                    <input class="form-control" min="0" max="100" type="number" value="{{$activities[$i]->quality}}" name="activityquality[]">
                                                                    @error('activityquality.'.$i)
                                                                    <div class="error-feedback">
                                                                        error
                                                                    </div>
                                                                    @enderror
                                                                </td>
                                                                <td class="px-1">
                                                                    <input class="form-control" type="text" name="activitytarget[]" value="{{$activities[$i]->target}}" readonly>
                                                                </td>
                                                                <td class="px-1">
                                                                    <input class="form-control" type="text" name="activitynote[]" value="{{$activities[$i]->note}}" readonly>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endfor
                                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="isapprove" name="isapprove" value="1">
                    <input type="hidden" id="reasonreject" name="reasonreject">
                    <button onclick="onreject('{{$ckp->ckp->user->name}}')" class="btn btn-icon btn-outline-danger ml-3 mb-3" type="button">
                        <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                        <span class="btn-inner--text">Reject</span>
                    </button>
                    <button onclick="onapprove('{{$ckp->ckp->user->name}}','{{$ckp->ckp->month->name}}','{{$ckp->ckp->year->name}}')" class="btn btn-icon btn-primary mb-3" type="button">
                        <span class="btn-inner--icon"><i class="fas fa-check-circle"></i></span>
                        <span class="btn-inner--text">Approve</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

<script>
    function reindex() {
        var table = document.getElementById('ckp-table');
        var startmain = 1;
        var startadd = 1;
        for (var i = 1; i < table.rows.length; i++) {
            var row = table.rows[i];
            if (row.cells[1]) {
                var rowObj = row.cells[1].childNodes[1];
                if (rowObj.value == 'main') {
                    row.cells[0].innerHTML = startmain++;
                } else {
                    row.cells[0].innerHTML = startadd++;
                }
            }
        }
    }

    reindex();
</script>

<script>
    function onreject(name) {
        Swal.fire({
            title: "Reject CKP?",
            text: "*CKP akan dikembalikan ke " + name + ". Tulis alasan di bawah ini",
            icon: 'warning',
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('isapprove').value = "0";
                document.getElementById('reasonreject').value = result.value;
                var form = document.getElementById('formupdate');
                form.submit();
            }
        })
    }

    function onapprove(name, month, year) {
        Swal.fire({
            title: "Approve CKP?",
            text: "*CKP " + name + " " + month + " " + year,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('isapprove').value = "1";
                var form = document.getElementById('formupdate');
                form.submit();
            }
        })
    }
</script>
@endsection