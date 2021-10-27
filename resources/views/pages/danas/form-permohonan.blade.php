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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group form-floating-label">
                                <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom" required>
                                <label for="inputFloatingLabel" class="placeholder">Order No</label>
                            </div>
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Tanggal Pengajuan</label>
                                <input id="inputFloatingLabel" type="date" class="form-control input-border-bottom" required>
                            </div>
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Tanggal Transfer</label>
                                <input id="inputFloatingLabel" type="date" class="form-control input-border-bottom" required>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Deskripsi</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Data</span>
                                        <span class="fw-light">
                                            Baru
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('subdanaone.store') }}" method="POST">
                                    @csrf
                                    <div class="perhitungan">
                                        <div class="modal-body">
                                            <p class="small">Tambahkan rincian permohonan dana, pada kolom di bawah ini</p>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Keterangan</label>
                                                        <textarea id="addDeskripsi" name="deskripsi" type="text" class="form-control" placeholder="Pengiriman Barang Premier Oil, Biaya Pengiriman Barang Premier Oil Mobil CDE Tujuan Kalijapat 5 - Tanggerang"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Dasar Harga</label>
                                                        <input id="addDasarHarga" name="dasar_harga" type="text" class="form-control" placeholder="1.000.000">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-0">
                                                    <div class="form-group form-group-default">
                                                        <label>PPN</label>
                                                        <input id="addPPn" name="ppn" value="0" type="text" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>PPh</label>
                                                        <input id="addPPh" name="pph" value="0" type="text" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Pengajuan</label>
                                                        <input id="addPengajuan" name="pengajuan" type="text" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Kode Transaksi</label>
                                                        <input id="addKdTransaksi" name="kd_transaksi" type="text" class="form-control" placeholder="5-211">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="submit" id="addRowButton" class="btn btn-primary"><i class="fa fa-save"></i> Tambah</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script>
                            let test = 10;


                            $(".perhitungan").keyup(function() {

                                var DasarHarga = parseInt($("#addDasarHarga").val())

                                console.log(DasarHarga);

                            });
                        </script>

                    </div>

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">KETERANGAN</th>
                                    <th>DASAR HARGA</th>
                                    <th>PPN</th>
                                    <th>PPh</th>
                                    <th>PENGAJUAN</th>
                                    <th>KODE TRANSAKSI</th>
                                    <!-- <th style="width: 10%">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0
                                @endphp
                                @foreach ($permohonandanasubones as $key => $permohonandanasubone)

                                <tr>
                                    <td colspan="3">{{$permohonandanasubone->deskripsi}}</td>
                                    <td>{{$permohonandanasubone->dasar_harga}}</td>
                                    <td>{{$permohonandanasubone->ppn}}</td>
                                    <td>{{$permohonandanasubone->pph}}</td>
                                    <td>{{$permohonandanasubone->pengajuan}}</td>
                                    <td>{{$permohonandanasubone->kd_transaksi}}</td>
                                </tr>

                                @php
                                $total += $permohonandanasubone->pengajuan;
                                @endphp
                                @endforeach
                            <tfoot>
                                <tr>
                                    <th colspan="6">Total</th>
                                    <th>Rp.{{$total}}</th>
                                    <th></th>
                                    <!-- <th></th> -->
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