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
                            <li class="breadcrumb-item active" aria-current="page">Entri CKP-T</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    @if (session('success-save'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-save') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if($ckp->status_id == '5' || $ckp->status_id == '7')
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text">CKP tidak bisa diubah karena sudah dikirim</span>
    </div>
    @elseif($ckp->status_id > 2)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text">CKP-T tidak bisa diubah karena sudah finalisasi</span>
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
                            <h2 class="mb-0">CKP-T {{$ckp->month->name}} {{$ckp->year->name}}</h2>
                        </div>
                    </div>
                </div>
                <form id="formupdate" autocomplete="off" method="post" action="/ckps/ckpt/{{$ckp->id}}" class="needs-validation d-inline" enctype="multipart/form-data" novalidate>
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
                                                <th width="15%" class="px-1">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7"><b>Kegiatan Utama</b></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" @if(old('activityname.0')) value="{{old('activityname.0')}}" @elseif(count($ckp->activitiesT) > 0) value="{{$ckp->activitiesT[0]->name}}" @endif @if($ckp->status_id > 2) disabled @endif><input type="hidden" value="main" id="activitytype[]" name="activitytype[]"><input type="hidden" @if(old('activityid.0')) value="{{old('activityid.0')}}" @elseif(count($ckp->activitiesT) > 0) value="{{$ckp->activitiesT[0]->id}}" @endif id="activityid[]" name="activityid[]">
                                                    @error('activityname.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityunit[]" name="activityunit[]" @if(old('activityunit.0')) value="{{old('activityunit.0')}}" @elseif(count($ckp->activitiesT) > 0) value="{{$ckp->activitiesT[0]->unit}}" @endif @if($ckp->status_id > 2) disabled @endif>
                                                    @error('activityunit.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="number" min="0" id="activitytarget[]" name="activitytarget[]" @if(old('activitytarget.0')) value="{{old('activitytarget.0')}}" @elseif(count($ckp->activitiesT) > 0) value="{{$ckp->activitiesT[0]->target}}" @endif @if($ckp->status_id > 2) disabled @endif>
                                                    @error('activitytarget.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="pl-1 pr-5"><input class="form-control" type="text" id="activitynote[]" name="activitynote[]" @if(old('activitynote.0')) value="{{old('activitynote.0')}}" @elseif(count($ckp->activitiesT) > 0) value="{{$ckp->activitiesT[0]->note}}" @endif @if($ckp->status_id > 2) disabled @endif>
                                                </td>
                                            </tr>
                                            @if (old('activityname'))
                                            @for($i = 1; $i < count(old('activityname')); $i++) @if(old('activitytype.'.$i)=='main' ) <tr>
                                                <td>{{($i + 1)}}</td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{old('activityname.'.$i)}}"><input type="hidden" value="main" id="activitytype[]" name="activitytype[]"><input type="hidden" value="{{old('activityid.'.$i)}}" id="activityid[]" name="activityid[]">
                                                    @error('activityname.'.$i)
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityunit[]" name="activityunit[]" value="{{old('activityunit.'.$i)}}">
                                                    @error('activityunit.'.$i)
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="number" min="0" id="activitytarget[]" name="activitytarget[]" value="{{old('activitytarget.'.$i)}}">
                                                    @error('activitytarget.'.$i)
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="pl-1 pr-5"><input class="form-control d-inline mr-2" type="text" id="activitynote[]" name="activitynote[]" value="{{old('activitynote.'.$i)}}"><button id="btnName{{$i}}" onclick="removeactivity('btnName{{$i}}','main')" class="btn btn-icon btn-sm btn-outline-danger d-inline" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                    </button>
                                                </td>
                                                </tr>
                                                @endif
                                                @endfor
                                                @else
                                                @for($i = 1; $i < count($ckp->activitiesT); $i++) @if($ckp->activitiesT[$i]->type=='main') <tr>
                                                        <td>{{$i}}</td>
                                                        <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{$ckp->activitiesT[$i]->name}}" @if($ckp->status_id > 2) disabled @endif><input type="hidden" value="main" id="activitytype[]" name="activitytype[]"><input type="hidden" value="{{$ckp->activitiesT[$i]->id}}" id="activityid[]" name="activityid[]" value="{{$ckp->activitiesT[$i]->id}}">
                                                        </td>
                                                        <td class="px-1"><input class="form-control" type="text" id="activityunit[]" name="activityunit[]" value="{{$ckp->activitiesT[$i]->unit}}" @if($ckp->status_id > 2) disabled @endif>
                                                        </td>
                                                        <td class="px-1"><input class="form-control" type="number" min="0" id="activitytarget[]" name="activitytarget[]" value="{{$ckp->activitiesT[$i]->target}}" @if($ckp->status_id > 2) disabled @endif>
                                                        </td>
                                                        <td class="pl-1 pr-5"><input class="form-control d-inline mr-2" type="text" id="activitynote[]" name="activitynote[]" value="{{$ckp->activitiesT[$i]->note}}" @if($ckp->status_id > 2) disabled @endif><button id="btnName{{$i}}" onclick="removeactivity('btnName{{$i}}','main')" class="btn btn-icon btn-sm btn-outline-danger d-inline" type="button" @if($ckp->status_id > 2) disabled @endif>
                                                                <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endfor
                                                    @endif
                                                    <tr>
                                                        <td colspan="7">
                                                            <button id="select-processor-button" type="button" class="btn btn-secondary btn-sm" onclick="addactivity('main')" @if($ckp->status_id > 2) disabled @endif>
                                                                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                                                <span class="btn-inner--text">Tambah Kegiatan Utama</span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7"><b>Kegiatan Tambahan</b></td>
                                                    </tr>
                                                    @if (old('activityname'))
                                                    @for($i = 1; $i < count(old('activityname')); $i++) @if(old('activitytype.'.$i)=='additional' ) <tr>
                                                        <td>{{($i + 1)}}</td>
                                                        <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{old('activityname.'.$i)}}"><input type="hidden" value="additional" id="activitytype[]" name="activitytype[]"><input type="hidden" value="{{old('activityid.'.$i)}}" id="activityid[]" name="activityid[]">
                                                            @error('activityname.'.$i)
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                            @enderror
                                                        </td>
                                                        <td class="px-1"><input class="form-control" type="text" id="activityunit[]" name="activityunit[]" value="{{old('activityunit.'.$i)}}">
                                                            @error('activityunit.'.$i)
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                            @enderror
                                                        </td>
                                                        <td class="px-1"><input class="form-control" type="number" min="0" id="activitytarget[]" name="activitytarget[]" value="{{old('activitytarget.'.$i)}}">
                                                            @error('activitytarget.'.$i)
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                            @enderror
                                                        </td>
                                                        <td class="pl-1 pr-5"><input class="form-control d-inline mr-2" type="text" id="activitynote[]" name="activitynote[]" value="{{old('activitynote.'.$i)}}"><button id="btnName{{$i}}" onclick="removeactivity('btnName{{$i}}','additional')" class="btn btn-icon btn-sm btn-outline-danger d-inline" type="button">
                                                                <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                            </button>
                                                        </td>
                                                        </tr>
                                                        @endif
                                                        @endfor
                                                        @else
                                                        @for($i = 1; $i < count($ckp->activitiesT); $i++) @if($ckp->activitiesT[$i]->type=='additional') <tr>
                                                                <td>{{$i}}</td>
                                                                <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{$ckp->activitiesT[$i]->name}}" @if($ckp->status_id > 2) disabled @endif><input type="hidden" value="additional" id="activitytype[]" name="activitytype[]"><input type="hidden" value="{{$ckp->activitiesT[$i]->id}}" id="activityid[]" name="activityid[]" value="{{$ckp->activitiesT[$i]->id}}">
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="text" id="activityunit[]" name="activityunit[]" value="{{$ckp->activitiesT[$i]->unit}}" @if($ckp->status_id > 2) disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="number" min="0" id="activitytarget[]" name="activitytarget[]" value="{{$ckp->activitiesT[$i]->target}}" @if($ckp->status_id > 2) disabled @endif>
                                                                </td>
                                                                <td class="pl-1 pr-5"><input class="form-control d-inline mr-2" type="text" id="activitynote[]" name="activitynote[]" value="{{$ckp->activitiesT[$i]->note}}" @if($ckp->status_id > 2) disabled @endif><button id="btnName{{$i}}" onclick="removeactivity('btnName{{$i}}','additional')" class="btn btn-icon btn-sm btn-outline-danger d-inline" type="button" @if($ckp->status_id > 2) disabled @endif>
                                                                        <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endfor
                                                            @endif
                                                            <tr>
                                                                <td colspan="7">
                                                                    <button id="select-processor-button" type="button" class="btn btn-secondary btn-sm" onclick="addactivity('additional')" @if($ckp->status_id > 2) disabled @endif>
                                                                        <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                                                        <span class="btn-inner--text">Tambah Kegiatan Tambahan</span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="issend" name="issend" value="0">
                    <button onclick="onsave()" class="btn btn-icon btn-outline-primary ml-3 mb-3" type="button" @if($ckp->status_id > 2) disabled @endif>
                        <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                        <span class="btn-inner--text">Simpan</span>
                    </button>
                    @if($ckp->status_id < 3)
                    <button onclick="onfinal()" class="btn btn-icon btn-primary mb-3" type="button">
                        <span class="btn-inner--icon"><i class="fas fa-check-circle"></i></span>
                        <span class="btn-inner--text">Finalisasi</span>
                    </button>
                    @endif
                    @if($ckp->status_id > 2)
                    <button onclick="onfix()" class="btn btn-icon btn-primary mb-3" type="button" @if($ckp->status_id > 4) disabled @endif>
                        <span class="btn-inner--icon"><i class="fas fa-check-circle"></i></span>
                        <span class="btn-inner--text">Perbaiki</span>
                    </button>
                    @endif
                    @if (old('removedactivity'))
                    @foreach(old('removedactivity') as $activity)
                    <input type="hidden" id="removedactivity[]" name="removedactivity[]" value="{{$activity}}">
                    @endforeach
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

<script>
    var mainactivitycount = 1;
    var additionalactivitycount = 0;
</script>

@if(old('activityname'))
@for($i = 1; $i < count(old('activityname')); $i++) @if(old('activitytype.'.$i)=='main' ) <script>
    mainactivitycount++;
    </script>
    @else
    <script>
        additionalactivitycount++;
    </script>
    @endif
    @endfor
    @else
    @for($i = 1; $i < count($ckp->activitiesT); $i++) @if($ckp->activitiesT[$i]->type=='main')
        <script>
            mainactivitycount++;
        </script>
        @else
        <script>
            additionalactivitycount++;
        </script>
        @endif
        @endfor
        @endif

        <script>
            function addactivity(type) {
                var ckptable = document.getElementById('ckp-table');
                var row;
                if (type == 'main') {
                    mainactivitycount++;
                    row = ckptable.insertRow(mainactivitycount + 1);

                } else {
                    additionalactivitycount++;
                    row = ckptable.insertRow(mainactivitycount + additionalactivitycount + 3);
                }

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell7 = row.insertCell(4);

                cell2.className = 'px-1';
                cell3.className = 'px-1';
                cell4.className = 'px-1';
                cell7.className = 'pl-1 pr-5';

                if (type == 'main') {
                    cell1.innerHTML = mainactivitycount;
                    cell2.innerHTML = "<input class='form-control' type='text' id='activityname[]' name='activityname[]'><input type='hidden' value='main' id='activitytype[]' name='activitytype[]'><input type='hidden' id='activityid[]' name='activityid[]'>";
                } else {
                    cell1.innerHTML = additionalactivitycount;
                    cell2.innerHTML = "<input class='form-control' type='text' id='activityname[]' name='activityname[]'><input type='hidden' value='additional' id='activitytype[]' name='activitytype[]'><input type='hidden' id='activityid[]' name='activityid[]'>";
                }

                cell3.innerHTML = "<input class='form-control' type='text' id='activityunit[]' name='activityunit[]'>";
                cell4.innerHTML = "<input class='form-control' type='number' id='activitytarget[]' name='activitytarget[]'>";

                var buttonid = Date.now();
                if (type == 'main') {
                    cell7.innerHTML = "<input class='form-control d-inline mr-2' type='text' id='activitynote[]' name='activitynote[]'>" +
                        "<button id=\"btnName" + buttonid + "\" onclick=\"removeactivity('btnName" + buttonid + "', 'main')\" class=\"btn btn-icon btn-sm btn-outline-danger d-inline\" type=\"button\"><span class=\"btn-inner--icon\"><i class=\"fas fa-trash-alt\"i></span></button>";
                } else {
                    cell7.innerHTML = "<input class='form-control d-inline mr-2' type='text' id='activitynote[]' name='activitynote[]'>" +
                        "<button id=\"btnName" + buttonid + "\" onclick=\"removeactivity('btnName" + buttonid + "', 'additional')\" class=\"btn btn-icon btn-sm btn-outline-danger d-inline\" type=\"button\"><span class=\"btn-inner--icon\"><i class=\"fas fa-trash-alt\"i></span></button>";

                }
                //console.log("main=" + mainactivitycount + ", add=" + additionalactivitycount);
            }

            function removeactivity(btnName, type) {
                if (type == 'main') {
                    mainactivitycount--;
                } else {
                    additionalactivitycount--;
                }

                var id;
                var table = document.getElementById('ckp-table');
                var rowCount = table.rows.length;
                for (var i = 1; i < rowCount; i++) {
                    var row = table.rows[i];
                    if (row.cells[4]) {
                        var rowObj = row.cells[4].childNodes[1];
                        var rowId = row.cells[1].childNodes[2];
                        if (rowObj) {
                            if (rowObj.id == btnName) {
                                table.deleteRow(i);
                                id = rowId.value;
                                if (id) {
                                    appendremovedactivity(id);
                                }
                                rowCount--;
                            }
                        }
                    }
                }
                reindex();
                //console.log("main=" + mainactivitycount + ", add=" + additionalactivitycount);
            }

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

            function onfinal() {
                Swal.fire({
                    title: "Finalisasi CKP-T bulan ini? ",
                    text: "*CKP-T tidak bisa diedit lagi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('issend').value = "1";
                        var form = document.getElementById('formupdate');
                        form.submit();
                    }
                })
            }

            function onfix() {
                Swal.fire({
                    title: "Perbaiki CKP-T bulan ini?",
                    text: "*Data CKP-R tidak akan hilang",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('issend').value = "1";
                        var form = document.getElementById('formupdate');
                        form.submit();
                    }
                })
            }

            function onsave() {
                document.getElementById('issend').value = "0";
                var form = document.getElementById('formupdate');
                form.submit();
            }

            function appendremovedactivity(id) {
                var form = document.getElementById('formupdate');
                var hidden = document.createElement("input");
                hidden.setAttribute("type", "hidden");
                hidden.setAttribute("name", "removedactivity[]");
                hidden.setAttribute("id", "removedactivity[]");
                hidden.setAttribute("value", id);

                form.appendChild(hidden);
            }
        </script>


        <script>
            reindex();
        </script>
        @endsection