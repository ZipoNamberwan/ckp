@extends('layouts.main')
@section('stylesheet')
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
                            <li class="breadcrumb-item active"><a href="{{url('/users')}}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah User</li>
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
                            <h2 class="mb-0">Ubah User</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4">
                        <form autocomplete="off" method="post" action="/users/{{$user->id}}" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{@old('email', $user->email)}}" id="email" name="email" placeholder="Email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label class="form-control-label" for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{@old('name', $user->name)}}" id="name" name="name" placeholder="Nama">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label class="form-control-label" for="unit">Unit Kerja</label>
                                    <select class="form-control @error('department') is-invalid @enderror" data-toggle="select" name="department">
                                        <option disabled selected>-- Pilih Unit Kerja --</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{ old('department', $user->department->id) == $department->id ? 'selected' : '' }}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <div class="error-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"> <label class="form-control-label" for="changepassword">Ganti Password?</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-2">
                                    <label class="custom-toggle">
                                        <input type="checkbox" onchange="ischangepassword()" name="changepassword" id="changepassword" @if(old('changepassword')) checked @endif>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" disabled>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label class="form-control-label" for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" disabled>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" id="sbmtbtn" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>

    function ischangepassword(){
        var changepassword = document.getElementById('changepassword');
        if (changepassword.checked){
            document.getElementById('password').disabled = false;
            document.getElementById('password_confirmation').disabled = false;
        } else {
            document.getElementById('password').disabled = true;
            document.getElementById('password_confirmation').disabled = true;
        }
    }

    ischangepassword();

</script>

@endsection