@extends('layouts.main')
@section('stylesheet')
    <link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
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
                                <li class="breadcrumb-item"><a href="#"><i class="ni ni-app"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ url('/organizations') }}">Unit Kerja</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
                                <h2 class="mb-0">Ubah Unit Kerja</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form autocomplete="off" method="post" action="/organizations/{{ $organization->id }}"
                            class="needs-validation" enctype="multipart/form-data" novalidate>
                            @method('patch')
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-control-label" for="name">Nama Unit Kerja</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ @old('name', $organization->name) }}" id="name" name="name"
                                        placeholder="Nama Unit Kerja">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @if ($organization->parent->id != '1')
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-control-label" for="parent">Unit Kerja Induk</label>
                                        <select class="form-control @error('parent') is-invalid @enderror"
                                            data-toggle="select" name="parent">
                                            <option disabled selected>-- Pilih Unit Kerja --</option>
                                            @foreach ($organizations as $o)
                                                @if ($o->id != $organization->id)
                                                    <option value="{{ $o->id }}"
                                                        {{ old('parent', $organization->parent->id) == $o->id ? 'selected' : '' }}>
                                                        {{ $o->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('parent')
                                            <div class="error-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-control-label" for="name">Unit Kerja Induk</label>
                                        <input type="text" class="form-control" value="{{ $organization->parent->name }}"
                                            disabled>
                                        <input type="hidden" name="parent value=" {{ $organization->parent->id }}">
                                    </div>
                                </div>
                            @endif
                            <button class="btn btn-primary" id="sbmtbtn" type="submit">Submit</button>
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
