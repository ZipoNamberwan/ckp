@extends('layouts.main')
@section('stylesheet')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
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
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-file-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    @if (session('success-approve'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-approve') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if (session('success-reject'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-reject') }}</span>
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
                            <h2 class="mb-0">Daftar Penilaian CKP</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="30%">Pesan</th>
                                <th width="15%">Status</th>
                                <th width="15%">Pada</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submittedckps as $ckp)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><b>{{$ckp->ckp->user->name}}</b> mengirim CKP <b>{{$ckp->ckp->month->name}} {{$ckp->ckp->year->name}}</b></td>
                                <td>
                                    <h3><span class="badge badge-{{$ckp->status->color}}">{{$ckp->status->name_2}}</span></h3>
                                </td>
                                <td>{{$ckp->created_at}}</td>
                                <td> @if($ckp->status->id != '6' && $ckp->status->id != '7')<a href="{{url('ratings/'.$ckp->id.'/edit')}}" class="btn btn-outline-info  btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-original-title="Isi Penilaian">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                    </a>@endif</td>
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
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        "responsive": true,
        "fixedColumns": true,
        "fixedHeader": true,
        "order": [],
        "columns": [{
                "responsivePriority": 5,
                "width": "5%",
            }, {
                "responsivePriority": 1,
                "width": "30%",
            }, {
                "responsivePriority": 2,
                "width": "15%",
            }, {
                "responsivePriority": 3,
                "width": "15%",
                "render": function(data, type, row) {
                    var unixTimestamp = new Date(data).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
                    if (type === 'display' || type === 'filter') {
                        return moment.unix(unixTimestamp).locale('id').fromNow();
                    }
                    return unixTimestamp;
                }
            },
            {
                "responsivePriority": 4,
                "width": "10%",
                "orderable": false
            }
        ],
        "language": {
            'paginate': {
                'previous': '<i class="fas fa-angle-left"></i>',
                'next': '<i class="fas fa-angle-right"></i>'
            }
        }
    });
</script>
@endsection