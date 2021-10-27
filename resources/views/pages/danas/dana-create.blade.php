@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Forms</h4>
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
                <a href="#">Forms</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Permohonan Dana Operasional</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Permohonan Dana Operasional</div>
                </div>
                <form action="{{ route('dana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" name="order_no" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">Order No</label>
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Tanggal Pengajuan</label>
                                    <input id="inputFloatingLabel" name="tanggal_pengajuan" type="date" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Tanggal Transfer</label>
                                    <input id="inputFloatingLabel" name="tanggal_transfer" type="date" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen</label>
                                    <input id="inputFloatingLabel" name="dokumen" type="file" class="form-control input-border-bottom" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                <button class="btn btn-danger" type="reset"><i class="fa fa-save"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection