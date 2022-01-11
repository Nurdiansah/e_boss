@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Stevedoring</h4>
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
                        <h4 class="card-title">Daftar History Stevedoring</h4>
                        <!-- <a href="{{route('stevedoring.create')}}" class="ml-auto ">
                            <button class="btn btn-primary btn-round ">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </button>
                        </a> -->
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stevedorings as $key => $stevedoring)
                                <tr>
                                    <td>{{tanggalWaktu($stevedoring->entry_date)}}</td>
                                    <td>{{$stevedoring->area->name}}</td>
                                    <td>{{$stevedoring->vessel->name}}</td>
                                    <td>{{$stevedoring->client->name}}</td>
                                    <td>{{$stevedoring->stevedoringcategory->name}}</td>
                                    <td>
                                        <a href="{{route('stevedoring.history.detail', $stevedoring->id)}}">
                                            <button class="btn btn-dark">Detail</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <th>Area</th>
                                    <th>Kapal</th>
                                    <th>Client</th>
                                    <th>Kegiatan</th>
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