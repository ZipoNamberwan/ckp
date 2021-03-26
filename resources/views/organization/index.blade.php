@extends('layouts.main')
@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />

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
                            <li class="breadcrumb-item active" aria-current="page">Unit Kerja</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    @if (session('success-create') || session('success-edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-create') }}{{ session('success-edit') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if (session('success-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-delete') }}</span>
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
                            <h2 class="mb-0">Daftar Unit Kerja</h2>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{url('/organizations/create')}}" class="btn btn-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Tambah Unit Kerja">
                                <span class="btn-inner--icon"><i class="fas fa-plus-circle"></i></span>
                                <span class="btn-inner--text">Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="30%">Unit Kerja</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organizations as $organization)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><b>{{$organization->name}}</b></td>
                                <td> 
                                    <a href="{{url('/organizations/'.$organization->id.'/edit')}}" class="btn btn-outline-info  btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-original-title="Ubah Data">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                    </a>
                                    <form class="d-inline" id="formdelete{{$organization->id}}" name="formdelete{{$organization->id}}" onsubmit="deleteorganization('{{$organization->id}}','{{$organization->name}}')" method="POST" action="{{url('/organizations/'.$organization->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-icon btn-outline-danger btn-sm" type="submit" data-toggle="tooltip" data-original-title="Hapus Unit Kerja">
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
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        "responsive": true,
        "fixedColumns": true,
        "fixedHeader": true,
        "order": [],
        "language": {
            'paginate': {
                'previous': '<i class="fas fa-angle-left"></i>',
                'next': '<i class="fas fa-angle-right"></i>'
            }
        }
    });
</script>

<script>
    function deleteorganization(id, name) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin Hapus Unit Kerja Ini?',
            text: name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formdelete' + id).submit();
            }
        })
    }
</script>

@if (session('error-delete'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Hapus',
        text: "{{session('error-delete')}}",
    });
</script>
@endif
@endsection