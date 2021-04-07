@extends('layouts.main')
@section('stylesheet')
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
    <link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
    <link rel="stylesheet" href="/assets/style.css" />

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
                                <li class="breadcrumb-item active"><a href="{{ url('/ckps') }}">CKP</a></li>
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

        @if ($ckp->status_id == '5' || $ckp->status_id == '7')
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                <span class="alert-text">CKP tidak bisa diubah karena sudah dikirim</span>
            </div>
        @elseif($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                <span class="alert-text">CKP-T tidak bisa diubah karena sudah finalisasi. Gunakan Tombol Perbaiki untuk
                    Memperbaiki CKP-T</span>
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
                                <h2 class="mb-0">CKP-T {{ $ckp->month->name }} {{ $ckp->year->name }}</h2>
                            </div>
                        </div>
                    </div>
                    <form id="formupdate" autocomplete="off" method="post" action="/ckps/ckpt/{{ $ckp->id }}"
                        class="needs-validation d-inline" enctype="multipart/form-data" novalidate>
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
                                                    <th width="7%" class="px-1">Target Kuantitas</th>
                                                    <th width="7%" class="px-1">Butir Kegiatan</th>
                                                    <th width="7%" class="px-1">Target Angka Kredit</th>
                                                    <th width="15%" class="px-1">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><b>Kegiatan Utama</b></td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="px-1"><input class="form-control" type="text"
                                                            id="activitynamefirst" name="activityname[]" @if (old('activityname.0')) value="{{ old('activityname.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->name }}" @endif @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
                                                        disabled @endif><input type="hidden" value="main"
                                                            name="activitytype[]"><input type="hidden" @if (old('activityid.0')) value="{{ old('activityid.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->id }}" @endif id="activityid[]" name="activityid[]">
                                                        @error('activityname.0')
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td class="px-1"><input class="form-control" type="text"
                                                            id="activityunitfirst" name="activityunit[]" @if (old('activityunit.0')) value="{{ old('activityunit.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->unit }}" @endif @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
                                                        disabled @endif>
                                                        @error('activityunit.0')
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td class="px-1"><input class="form-control" type="number" min="0"
                                                            name="activitytarget[]" @if (old('activitytarget.0')) value="{{ old('activitytarget.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->target }}" @endif @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
                                                        disabled @endif>
                                                        @error('activitytarget.0')
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td class="px-1"><input class="form-control" type="text" min="0"
                                                            name="activitycreditcode[]" @if (old('activitycreditcode.0')) value="{{ old('activitycreditcode.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->creditcode }}" @endif @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
                                                        disabled @endif>
                                                        @error('activitycreditcode.0')
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td class="px-1"><input class="form-control" type="number" min="0"
                                                            name="activitycredit[]" @if (old('activitycredit.0')) value="{{ old('activitycredit.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->credit }}" @endif @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
                                                        disabled @endif>
                                                        @error('activitycredit.0')
                                                            <div class="error-feedback">
                                                                kosong
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td class="pl-1 pr-5"><input class="form-control" type="text"
                                                            name="activitynote[]" @if (old('activitynote.0')) value="{{ old('activitynote.0') }}" @elseif(count($ckp->activities) > 0) value="{{ $ckp->activities[0]->note }}" @endif @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6')
                                                        disabled @endif>
                                                    </td>
                                                </tr>
                                                @if (old('activityname'))
                                                    @for ($i = 1; $i < count(old('activityname')); $i++) @if (old('activitytype.' . $i) == 'main') <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="text"
                                                        name="activityname[]"
                                                        value="{{ old('activityname.' . $i) }}"><input
                                                        type="hidden" value="main"
                                                        name="activitytype[]"><input type="hidden"
                                                        value="{{ old('activityid.' . $i) }}"
                                                        id="activityid[]" name="activityid[]">
                                                        @error('activityname.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="text"
                                                        name="activityunit[]"
                                                        value="{{ old('activityunit.' . $i) }}">
                                                        @error('activityunit.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="number"
                                                        min="0" name="activitytarget[]"
                                                        value="{{ old('activitytarget.' . $i) }}">
                                                        @error('activitytarget.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="text"
                                                        min="0" name="activitycreditcode[]"
                                                        value="{{ old('activitycreditcode.' . $i) }}">
                                                        @error('activitycreditcode.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="number"
                                                        min="0" name="activitycredit[]"
                                                        value="{{ old('activitycredit.' . $i) }}">
                                                        @error('activitycredit.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="pl-1 pr-5"><input
                                                        class="form-control d-inline mr-2" type="text"
                                                        name="activitynote[]"
                                                        value="{{ old('activitynote.' . $i) }}"><button
                                                        id="btnName{{ $i }}"
                                                        onclick="removeactivity('btnName{{ $i }}','main')"
                                                        class="btn btn-icon btn-sm btn-outline-danger d-inline"
                                                        type="button">
                                                        <span class="btn-inner--icon"><i class="fas
                                                        fa-trash-alt"></i></span>
                                                        </button>
                                                        </td>
                                                        </tr> @endif
                                                    @endfor
                                                @else
                                                    @for ($i = 1; $i < count($ckp->activities); $i++)
                                                        @if ($ckp->activities[$i]->type == 'main')
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td class="px-1"><input class="form-control" type="text"
                                                                        name="activityname[]"
                                                                        value="{{ $ckp->activities[$i]->name }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif><input
                                                                        type="hidden" value="main"
                                                                        name="activitytype[]"><input type="hidden"
                                                                        value="{{ $ckp->activities[$i]->id }}"
                                                                        id="activityid[]" name="activityid[]"
                                                                        value="{{ $ckp->activities[$i]->id }}">
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="text"
                                                                        name="activityunit[]"
                                                                        value="{{ $ckp->activities[$i]->unit }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="number"
                                                                        min="0" name="activitytarget[]"
                                                                        value="{{ $ckp->activities[$i]->target }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="text"
                                                                        min="0" name="activitycreditcode[]"
                                                                        value="{{ $ckp->activities[$i]->creditcode }}"
                                                                        @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="number"
                                                                        min="0" name="activitycredit[]"
                                                                        value="{{ $ckp->activities[$i]->credit }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="pl-1 pr-5"><input
                                                                        class="form-control d-inline mr-2" type="text"
                                                                        name="activitynote[]"
                                                                        value="{{ $ckp->activities[$i]->note }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif><button
                                                                        id="btnName{{ $i }}"
                                                                        onclick="removeactivity('btnName{{ $i }}','main')"
                                                                        class="btn btn-icon btn-sm btn-outline-danger d-inline"
                                                                        type="button" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                        <span class="btn-inner--icon"><i
                                                                                class="fas fa-trash-alt"></i></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endfor
                                                @endif
                                                <tr>
                                                    <td colspan="7">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            onclick="addactivity('main', '', '')" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                                            <span class="btn-inner--text">Tambah Kegiatan Utama</span>
                                                        </button>
                                                        <button type="button" onclick="getactivity('main')"
                                                            class="btn btn-secondary btn-sm" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif data-toggle="modal"
                                                            data-target="#modal-default">
                                                            <span class="btn-inner--icon"><i
                                                                    class="fas fa-mobile-alt"></i></span>
                                                            <span class="btn-inner--text">Tambah Dari Laporan WFH
                                                                (Android)</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7"><b>Kegiatan Tambahan</b></td>
                                                </tr>
                                                @if (old('activityname'))
                                                    @for ($i = 1; $i < count(old('activityname')); $i++) @if (old('activitytype.' . $i) == 'additional') <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="text"
                                                        name="activityname[]"
                                                        value="{{ old('activityname.' . $i) }}"><input
                                                        type="hidden" value="additional"
                                                        name="activitytype[]"><input type="hidden"
                                                        value="{{ old('activityid.' . $i) }}"
                                                        id="activityid[]" name="activityid[]">
                                                        @error('activityname.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="text"
                                                        name="activityunit[]"
                                                        value="{{ old('activityunit.' . $i) }}">
                                                        @error('activityunit.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="number"
                                                        min="0" name="activitytarget[]"
                                                        value="{{ old('activitytarget.' . $i) }}">
                                                        @error('activitytarget.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="text"
                                                        min="0" name="activitycreditcode[]"
                                                        value="{{ old('activitycreditcode.' . $i) }}">
                                                        @error('activitycreditcode.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="px-1"><input
                                                        class="form-control" type="number"
                                                        min="0" name="activitycredit[]"
                                                        value="{{ old('activitycredit.' . $i) }}">
                                                        @error('activitycredit.' . $i)
                                                            <div class="error-feedback">
                                                            kosong
                                                            </div>
                                                        @enderror
                                                        </td>
                                                        <td class="pl-1 pr-5"><input
                                                        class="form-control d-inline mr-2" type="text"
                                                        name="activitynote[]"
                                                        value="{{ old('activitynote.' . $i) }}"><button
                                                        id="btnName{{ $i }}"
                                                        onclick="removeactivity('btnName{{ $i }}','additional')"
                                                        class="btn btn-icon btn-sm btn-outline-danger d-inline"
                                                        type="button">
                                                        <span class="btn-inner--icon"><i class="fas
                                                        fa-trash-alt"></i></span>
                                                        </button>
                                                        </td>
                                                        </tr> @endif
                                                    @endfor
                                                @else
                                                    @for ($i = 1; $i < count($ckp->activities); $i++)
                                                        @if ($ckp->activities[$i]->type == 'additional')
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td class="px-1"><input class="form-control" type="text"
                                                                        name="activityname[]"
                                                                        value="{{ $ckp->activities[$i]->name }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif><input
                                                                        type="hidden" value="additional"
                                                                        name="activitytype[]"><input type="hidden"
                                                                        value="{{ $ckp->activities[$i]->id }}"
                                                                        id="activityid[]" name="activityid[]"
                                                                        value="{{ $ckp->activities[$i]->id }}">
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="text"
                                                                        name="activityunit[]"
                                                                        value="{{ $ckp->activities[$i]->unit }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="number"
                                                                        min="0" name="activitytarget[]"
                                                                        value="{{ $ckp->activities[$i]->target }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="text"
                                                                        min="0" name="activitycreditcode[]"
                                                                        value="{{ $ckp->activities[$i]->creditcode }}"
                                                                        @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="px-1"><input class="form-control" type="number"
                                                                        min="0" name="activitycredit[]"
                                                                        value="{{ $ckp->activities[$i]->credit }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                </td>
                                                                <td class="pl-1 pr-5"><input
                                                                        class="form-control d-inline mr-2" type="text"
                                                                        name="activitynote[]"
                                                                        value="{{ $ckp->activities[$i]->note }}" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif><button
                                                                        id="btnName{{ $i }}"
                                                                        onclick="removeactivity('btnName{{ $i }}','additional')"
                                                                        class="btn btn-icon btn-sm btn-outline-danger d-inline"
                                                                        type="button" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                                        <span class="btn-inner--icon"><i
                                                                                class="fas fa-trash-alt"></i></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endfor
                                                @endif
                                                <tr>
                                                    <td colspan="7">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            onclick="addactivity('additional', '', '')" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                                                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                                            <span class="btn-inner--text">Tambah Kegiatan Tambahan</span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            onclick="getactivity('additional')" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif data-toggle="modal"
                                                            data-target="#modal-default">
                                                            <span class="btn-inner--icon"><i
                                                                    class="fas fa-mobile-alt"></i></span>
                                                            <span class="btn-inner--text">Tambah Dari Laporan WFH
                                                                (Android)</span>
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
                        <button onclick="onsave()" class="btn btn-icon btn-outline-primary ml-3 mb-3" type="button" @if ($ckp->status_id == '3' || $ckp->status_id == '5' || $ckp->status_id == '6') disabled @endif>
                            <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                            <span class="btn-inner--text">Simpan</span>
                        </button>
                        @if (old('removedactivity'))
                            @foreach (old('removedactivity') as $activity)
                                <input type="hidden" id="removedactivity[]" name="removedactivity[]"
                                    value="{{ $activity }}">
                            @endforeach
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-default" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Pilih Kegiatan dari Laporan WFH</h6>
                    <button id="dialog-close-button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table" width="100%" id="datatable-activity">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Kegiatan</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ohsnap" id="ohsnap"></div>
            </div>
        </div>
    </div>
@endsection

@section('optionaljs')
    <script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
    <script src="/assets/vendor/datatables2/datatables.min.js"></script>
    <script src="/assets/vendor/momentjs/moment-with-locales.js"></script>
    <script src="/assets/vendor/ohsnap/ohsnap.js"></script>

    <script>
        var mainactivitycount = 1;
        var additionalactivitycount = 0;

    </script>

    @if (old('activityname'))
        @for ($i = 1; $i < count(old('activityname')); $i++) @if (old('activitytype.' . $i) == 'main') <script>
            mainactivitycount++;
            </script>
        @else
            <script>
            additionalactivitycount++;
            </script> @endif
        @endfor
    @else
        @for ($i = 1; $i < count($ckp->activities); $i++)
            @if ($ckp->activities[$i]->type == 'main')
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
        function addactivity(type, namakegiatan, satuankegiatan) {
            var ckptable = document.getElementById('ckp-table');
            //console.log(namakegiatan);
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
                cell2.innerHTML =
                    "<input class='form-control' type='text' value='" + namakegiatan +
                    "' name='activityname[]'><input type='hidden' value='main' name='activitytype[]'><input type='hidden' name='activityid[]'>";
            } else {
                cell1.innerHTML = additionalactivitycount;
                cell2.innerHTML =
                    "<input class='form-control' type='text' value='" + namakegiatan +
                    "' name='activityname[]'><input type='hidden' value='additional' name='activitytype[]'><input type='hidden' name='activityid[]'>";
            }

            cell3.innerHTML = "<input class='form-control' type='text' value='" + satuankegiatan +
                "' name='activityunit[]'>";
            cell4.innerHTML = "<input class='form-control' type='number' name='activitytarget[]'>";
            cell5.innerHTML =
                "<input class='form-control' type='text' name='activitycreditcode[]'>";
            cell6.innerHTML = "<input class='form-control' type='number' name='activitycredit[]'>";

            var buttonid = Date.now();
            if (type == 'main') {
                cell7.innerHTML =
                    "<input class='form-control d-inline mr-2' type='text' name='activitynote[]'>" +
                    "<button id=\"btnName" + buttonid + "\" onclick=\"removeactivity('btnName" + buttonid +
                    "', 'main')\" class=\"btn btn-icon btn-sm btn-outline-danger d-inline\" type=\"button\"><span class=\"btn-inner--icon\"><i class=\"fas fa-trash-alt\"i></span></button>";
            } else {
                cell7.innerHTML =
                    "<input class='form-control d-inline mr-2' type='text' name='activitynote[]'>" +
                    "<button id=\"btnName" + buttonid + "\" onclick=\"removeactivity('btnName" + buttonid +
                    "', 'additional')\" class=\"btn btn-icon btn-sm btn-outline-danger d-inline\" type=\"button\"><span class=\"btn-inner--icon\"><i class=\"fas fa-trash-alt\"i></span></button>";

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
                if (row.cells[6]) {
                    var rowObj = row.cells[6].childNodes[1];
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
                    document.getElementById('issend').value = "0";
                    document.getElementById('isfix').value = "1";
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

    <script>
        var table;
        $('#modal-default').on('shown.bs.modal', function() {
            if (!table) {
                table = $('#datatable-activity').DataTable({
                    "order": [],
                    "ajax": {
                        "url": "{{ url('/wfhactivity/' . $ckp->month->id) }}",
                        "dataSrc": ""
                    },
                    "processing": true,
                    "responsive": true,
                    "columnDefs": [{
                        "responsivePriority": 4,
                        "width": "3%",
                        "targets": 0,
                        "data": "id",
                        "visible": false,
                    }, {
                        "responsivePriority": 4,
                        "width": "3%",
                        "targets": 1,
                        "data": "id",
                        "searchable": false,
                    }, {
                        "responsivePriority": 1,
                        "width": "10%",
                        "targets": 2,
                        "data": "tanggal",
                        "render": function(data, type, row) {
                            moment.locale('id');
                            return moment(data).format('dddd') + ", " + moment(data).format(
                                'LL');
                        }
                    }, {
                        "responsivePriority": 3,
                        "width": "15%",
                        "targets": 3,
                        "data": "namakegiatan",
                    }, {
                        "responsivePriority": 2,
                        "width": "5%",
                        "targets": 4,
                        "data": "volume",
                    }, {
                        "responsivePriority": 2,
                        "width": "5%",
                        "targets": 5,
                        "data": "satuankegiatan",
                    }, {
                        "responsivePriority": 2,
                        "width": "5%",
                        "targets": 6,
                        "data": "id",
                        "render": function(data, rendertype, row) {
                            return "<button onclick=\"addWfHActivity('" + row.namakegiatan +
                                "','" +
                                row.satuankegiatan + "')\" id=\"button" + row.id +
                                "\" class=\"btn btn-icon btn-primary btn-sm\" type=\"button\">" +
                                "<span class=\"btn-inner--icon\"><i class=\"fas fa-hand-pointer\"></i></span>" +
                                "</button>";
                        },
                    }, ],
                    "language": {
                        'paginate': {
                            'previous': '<i class="fas fa-angle-left"></i>',
                            'next': '<i class="fas fa-angle-right"></i>'
                        }
                    }
                });
            }
            table.on('order.dt search.dt', function() {
                table.column(1, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table.columns.adjust();
        })

        wfhtype = "main";

        function getactivity(type) {
            wfhtype = type;
        }

        function addWfHActivity(namakegiatan, satuankegiatan) {
            if (wfhtype == 'main' && document.getElementById('activitynamefirst').value == '' && document.getElementById(
                    'activityunitfirst')
                .value == '') {
                document.getElementById('activitynamefirst').value = namakegiatan;
                document.getElementById('activityunitfirst').value = satuankegiatan;
            } else {
                addactivity(wfhtype, namakegiatan, satuankegiatan);
            }
            ohSnap('Aktivitas berhasil ditambahkan', {
                color: 'green'
            });
        }

    </script>
@endsection
