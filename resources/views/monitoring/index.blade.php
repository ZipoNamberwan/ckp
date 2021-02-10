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
                            <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
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
                <div class="card-body px-0 ">
                    <div class="table-responsive py-2">
                        <table class="table" width="90%" id="ckp-table">
                            <thead class="thead-light">
                                <tr>
                                    <th width="3%" class="text-center">No</th>
                                    <th width="10%" class="px-1 text-center">Nama Pegawai</th>
                                    @foreach($months as $month)
                                    <th width="4%" class="px-1 text-center">{{$month->name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($users); $i++)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{$users[$i]->name}}</td>
                                    @for($j = 0; $j < count($months); $j++)
                                    @if (count($statuses[$i]) == 12)
                                    <td>@if($statuses[$i][$j]->status->id != '1') <a href="{{url('/ckps/'.$statuses[$i][$j]->id)}}" target="_blank"> {{$statuses[$i][$j]->status->name_1}} </a> @else {{$statuses[$i][$j]->status->name_1}} @endif </td>
                                    @else
                                    <td>Belum Entri</td>
                                    @endif
                                    @endfor
                                </tr>
                                @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')

@endsection