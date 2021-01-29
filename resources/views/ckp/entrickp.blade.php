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
                            <h2 class="mb-0">CKP {{$ckp->month->name}} {{$ckp->year->name}}</h2>
                        </div>
                    </div>
                </div>
                <form id="formupdate" autocomplete="off" method="post" action="/ckps/{{$ckp->id}}" class="needs-validation d-inline" enctype="multipart/form-data" novalidate>
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
                                                <th width="4%" class="px-1">Kualitas</th>
                                                <th width="15%" class="px-1">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="6"><b>Kegiatan Utama</b></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{old('activityname.0')}}"><input type="hidden" value="main" id="activitytype[]" name="activitytype[]">
                                                    @error('activityname.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityunit[]" name="activityunit[]" value="{{old('activityunit.0')}}">
                                                    @error('activityunit.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="number" min="0" id="activitytarget[]" name="activitytarget[]" value="{{old('activitytarget.0')}}">
                                                    @error('activitytarget.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="number" min="0" id="activityreal[]" name="activityreal[]" value="{{old('activityreal.0')}}">
                                                    @error('activityreal.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="text" disabled></td>
                                                <td class="pl-1 pr-5"><input class="form-control" type="text" id="activitynote[]" name="activitynote[]" value="{{old('activitynote.0')}}">
                                                    @error('activitynote.0')
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            @if (old('activityname'))
                                            @for($i = 1; $i < count(old('activityname')); $i++) @if(old('activitytype.'.$i)=='main' ) <tr>
                                                <td>{{($i + 1)}}</td>
                                                <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{old('activityname.'.$i)}}"><input type="hidden" value="main" id="activitytype[]" name="activitytype[]">
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
                                                <td class="px-1"><input class="form-control" type="number" min="0" id="activityreal[]" name="activityreal[]" value="{{old('activityreal.'.$i)}}">
                                                    @error('activityreal.'.$i)
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="px-1"><input class="form-control" type="text" disabled></td>
                                                <td class="pl-1 pr-5"><input class="form-control d-inline mr-2" type="text" id="activitynote[]" name="activitynote[]" value="{{old('activitynote.'.$i)}}"><button id="btnNamemain{{$i}}" onclick="removeactivity('btnNamemain{{$i}}','main')" class="btn btn-icon btn-sm btn-outline-danger d-inline" type="button">
                                                        <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                    </button>
                                                    @error('activitynote.'.$i)
                                                    <div class="error-feedback">
                                                        kosong
                                                    </div>
                                                    @enderror
                                                </td>
                                                </tr>
                                                @endif
                                                @endfor
                                                @endif
                                                <tr>
                                                    <td colspan="6">
                                                        <button id="select-processor-button" type="button" class="btn btn-secondary btn-sm" onclick="addactivity('main')">
                                                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                                            <span class="btn-inner--text">Tambah Kegiatan Utama</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><b>Kegiatan Tambahan</b></td>
                                                </tr>
                                                @if (old('activityname'))
                                                @for($i = 1; $i < count(old('activityname')); $i++) @if(old('activitytype.'.$i)=='additional' ) <tr>
                                                    <td>{{($i + 1)}}</td>
                                                    <td class="px-1"><input class="form-control" type="text" id="activityname[]" name="activityname[]" value="{{old('activityname.'.$i)}}"><input type="hidden" value="additional" id="activitytype[]" name="activitytype[]">
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
                                                    <td class="px-1"><input class="form-control" type="number" min="0" id="activityreal[]" name="activityreal[]" value="{{old('activityreal.'.$i)}}">
                                                        @error('activityreal.'.$i)
                                                        <div class="error-feedback">
                                                            kosong
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    <td class="px-1"><input class="form-control" type="text" disabled></td>
                                                    <td class="pl-1 pr-5"><input class="form-control d-inline mr-2" type="text" id="activitynote[]" name="activitynote[]" value="{{old('activitynote.'.$i)}}"><button id="btnNamemain{{$i}}" onclick="removeactivity('btnNamemain{{$i}}','additional')" class="btn btn-icon btn-sm btn-outline-danger d-inline" type="button">
                                                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                        </button>
                                                        @error('activitynote.'.$i)
                                                        <div class="error-feedback">
                                                            kosong
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    </tr>
                                                    @endif
                                                    @endfor
                                                    @endif
                                                    <tr>
                                                        <td colspan="6">
                                                            <button id="select-processor-button" type="button" class="btn btn-secondary btn-sm" onclick="addactivity('additional')">
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
                    <button onclick="onsave()" class="btn btn-icon btn-outline-primary ml-3 mb-3" type="button">
                        <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                        <span class="btn-inner--text">Simpan</span>
                    </button>
                    <button onclick="onsend()" class="btn btn-icon btn-primary mb-3" type="button">
                        <span class="btn-inner--icon"><i class="fas fa-paper-plane"></i></span>
                        <span class="btn-inner--text">Kirim</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')

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
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);

            cell2.className = 'px-1';
            cell3.className = 'px-1';
            cell4.className = 'px-1';
            cell5.className = 'px-1';
            cell6.className = 'px-1';
            cell7.className = 'pl-1 pr-5';

            if (type == 'main') {
                cell1.innerHTML = mainactivitycount;
                cell2.innerHTML = "<input class='form-control' type='text' id='activityname[]' name='activityname[]'><input type='hidden' value='main' id='activitytype[]' name='activitytype[]'>";
            } else {
                cell1.innerHTML = additionalactivitycount;
                cell2.innerHTML = "<input class='form-control' type='text' id='activityname[]' name='activityname[]'><input type='hidden' value='additional' id='activitytype[]' name='activitytype[]'>";
            }

            cell3.innerHTML = "<input class='form-control' type='text' id='activityunit[]' name='activityunit[]'>";
            cell4.innerHTML = "<input class='form-control' type='text' id='activitytarget[]' name='activitytarget[]'>";
            cell5.innerHTML = "<input class='form-control' type='text' id='activityreal[]' name='activityreal[]'>";
            cell6.innerHTML = "<input class='form-control' type='text' disabled>";

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

            var table = document.getElementById('ckp-table');
            var rowCount = table.rows.length;
            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                if (row.cells[6]) {
                    var rowObj = row.cells[6].childNodes[1];
                    if (rowObj) {
                        if (rowObj.id == btnName) {
                            table.deleteRow(i);
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

        function onsend() {
            document.getElementById('issend').value = "1";
            var form = document.getElementById('formupdate');
            form.submit();
        }

        function onsave() {
            document.getElementById('issend').value = "0";
            var form = document.getElementById('formupdate');
            form.submit();
        }
    </script>


    @if(old('activityname'))
    <script>
        reindex();
    </script>
    @endif
    @endsection