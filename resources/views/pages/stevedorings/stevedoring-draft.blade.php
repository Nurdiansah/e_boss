@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Draft Stevedoring</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Index</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Draft Stevedoring</h4>
                        <a href="{{route('stevedoring.create')}}" class="ml-auto ">
                            <button class="btn btn-primary btn-round ">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Area</th>
                                    <th>Kapal</th>
                                    <th>Client</th>
                                    <th>Kegiatan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stevedorings as $key => $stevedoring)

                                {{-- <tr data-href="{{}}" style="cursor: pointer;" title="Klik untuk detail"> --}}
                                <a href="{{route('dana.create')}}">
                                    <tr>
                                        <td>{{$stevedoring->id}}</td>
                                        <td>{{date('Y-m-d H:i', strtotime($stevedoring->entry_date))}}</td>
                                        <td>{{$stevedoring->area->name}}</td>
                                        <td>{{$stevedoring->vessel->name}}</td>
                                        <td>{{$stevedoring->client->name}}</td>
                                        <td>{{$stevedoring->stevedoringcategory->name}}</td>
                                        <td>
                                            @if($stevedoring->status == 0)
                                            <span class="badge badge-warning">Belum direlease</span>
                                            @elseif($stevedoring->status == 1)
                                            <span class="badge badge-primary">Approval Manager</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('dana.edit', $stevedoring->id)}}">
                                                <button class="btn btn-dark">Detail</button>
                                            </a>
                                        </td>
                                    </tr>
                                </a>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <th>No Permohonan</th>
                                    <th>Order No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Tanggal Transfer</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection