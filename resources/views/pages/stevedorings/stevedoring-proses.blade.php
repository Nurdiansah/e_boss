@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Proses Stevedoring</h4>
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
                        <h4 class="card-title">Daftar Proses Stevedoring</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
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
                                @if($stevedorings->count()==0)
                                <x-data-empty column="7" />
                                @else
                                @foreach ($stevedorings as $key => $stevedoring)
                                <tr>
                                    <td>{{tanggalWaktu($stevedoring->entry_date)}}</td>
                                    <td>{{$stevedoring->area->name}}</td>
                                    <td>{{$stevedoring->vessel->name}}</td>
                                    <td>{{$stevedoring->client->name}}</td>
                                    <td>{{$stevedoring->stevedoringcategory->name}}</td>
                                    <td>
                                        @if($stevedoring->status == 0)
                                        <span class="badge badge-warning">Belum direlease</span>
                                        @elseif($stevedoring->status == 1)
                                        <span class="badge badge-dark">Pekerjaan belum berlangsung</span>
                                        @elseif($stevedoring->status == 2)
                                        <span class="badge badge-success">Pekerjaan berlangsung</span>
                                        @elseif($stevedoring->status == 3)
                                        <span class="badge badge-warning">Pekerjaan berhenti</span>
                                        @elseif($stevedoring->status == 4)
                                        <span class="badge badge-success">Verifikasi Supervisor</span>
                                        @elseif($stevedoring->status == 5)
                                        <span class="badge badge-success">Verifikasi Manager</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('stevedoring.show', $stevedoring->id)}}">
                                            <button class="btn btn-dark">Detail</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            <tfoot>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <th>Area</th>
                                    <th>Kapal</th>
                                    <th>Client</th>
                                    <th>Kegiatan</th>
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