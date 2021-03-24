@extends('layouts.main')
@section('stylesheet')

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
                                <li class="breadcrumb-item active"><a href="{{ url('/monitoring') }}">Monitoring</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View</li>
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
                                <h2 class="mb-0">Monitoring CKP</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#ckpt" role="tab" data-toggle="tab">CKP-T</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ckpr" role="tab" data-toggle="tab">CKP-R</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="ckpt">
                                <div class="col mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="mb-0">
                                                Satuan Organisasi
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <h5>
                                                : {{ $ckp->user->department->name }}
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
                                                : {{ $ckp->user->name }}
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
                                                : {{ $ckp->month->name }} {{ $ckp->year->name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div id="selection-container">
                                    <div class="table-responsive py-2">
                                        <table class="table" width="90%" id="ckp-table-t">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="3%">No</th>
                                                    <th width="30%" class="px-1">Nama Kegiatan</th>
                                                    <th width="7%" class="px-1">Satuan</th>
                                                    <th width="7%" class="px-1">Target Kuantitas</th>
                                                    <th width="7%" class="px-1">Target Angka Kredit</th>
                                                    <th width="15%" class="px-1">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><b>Kegiatan Utama</b></td>
                                                </tr>
                                                @for ($i = 0; $i < count($ckp->activities); $i++)
                                                    @if ($ckp->activities[$i]->type == 'main')
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td class="px-1">{{ $ckp->activities[$i]->name }}<input
                                                                    type="hidden" name="activitytype[]"
                                                                    value="{{ $ckp->activities[$i]->type }}">
                                                                <input type="hidden" name="activityid[]"
                                                                    value="{{ old('activityid.' . $i) }}">
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->unit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->target }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->credit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->note }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                                <tr>
                                                    <td colspan="7"><b>Kegiatan Tambahan</b></td>
                                                </tr>
                                                @for ($i = 0; $i < count($ckp->activities); $i++)
                                                    @if ($ckp->activities[$i]->type == 'additional')
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td class="px-1">{{ $ckp->activities[$i]->name }}<input
                                                                    type="hidden" name="activitytype[]"
                                                                    value="{{ $ckp->activities[$i]->type }}">
                                                                <input type="hidden" name="activityid[]"
                                                                    value="{{ old('activityid.' . $i) }}">
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->unit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->target }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->credit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->note }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="ckpr">
                                <div class="col mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="mb-0">
                                                Satuan Organisasi
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <h5>
                                                : {{ $ckp->user->department->name }}
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
                                                : {{ $ckp->user->name }}
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
                                                : {{ $ckp->month->name }} {{ $ckp->year->name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div id="selection-container">
                                    <div class="table-responsive py-2">
                                        <table class="table" width="90%" id="ckp-table-r">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="3%">No</th>
                                                    <th width="30%" class="px-1">Nama Kegiatan</th>
                                                    <th width="7%" class="px-1">Satuan</th>
                                                    <th width="7%" class="px-1">Target</th>
                                                    <th width="7%" class="px-1">Realisasi</th>
                                                    <th width="7%" class="px-1">Kualitas</th>
                                                    <th width="7%" class="px-1">Capaian Angka Kredit</th>
                                                    <th width="15%" class="px-1">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><b>Kegiatan Utama</b></td>
                                                </tr>
                                                @for ($i = 0; $i < count($ckp->activities); $i++)
                                                    @if ($ckp->activities[$i]->type == 'main')
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td class="px-1">{{ $ckp->activities[$i]->name }}<input
                                                                    type="hidden" name="activitytype[]"
                                                                    value="{{ $ckp->activities[$i]->type }}">
                                                                <input type="hidden" name="activityid[]"
                                                                    value="{{ old('activityid.' . $i) }}">
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->unit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->target }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->real }}
                                                            </td>
                                                            <td class="px-1">
                                                                @if ($ckp->status->id == '7')
                                                                    {{ $ckp->activities[$i]->quality }}
                                                                @endif
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->credit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->note }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                                <tr>
                                                    <td colspan="7"><b>Kegiatan Tambahan</b></td>
                                                </tr>
                                                @for ($i = 0; $i < count($ckp->activities); $i++)
                                                    @if ($ckp->activities[$i]->type == 'additional')
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td class="px-1">{{ $ckp->activities[$i]->name }}<input
                                                                    type="hidden" name="activitytype[]"
                                                                    value="{{ $ckp->activities[$i]->type }}">
                                                                <input type="hidden" name="activityid[]"
                                                                    value="{{ old('activityid.' . $i) }}">
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->unit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->target }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->real }}
                                                            </td>
                                                            <td class="px-1">
                                                                @if ($ckp->status->id == '7')
                                                                    {{ $ckp->activities[$i]->quality }}
                                                                @endif
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->credit }}
                                                            </td>
                                                            <td class="px-1">
                                                                {{ $ckp->activities[$i]->note }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endfor
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

    <script>
        function reindex(table) {
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
        reindex(document.getElementById('ckp-table-t'));
        reindex(document.getElementById('ckp-table-r'));

    </script>
@endsection
