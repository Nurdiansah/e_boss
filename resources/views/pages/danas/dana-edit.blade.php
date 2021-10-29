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
                <a href="{{route('dana.index')}}">Permohonan Dana</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail Permohonan Dana</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            @if($permohonandana->status == '0')
            <form action="{{route('dana.release', $permohonandana->id)}}" method="post">
                @csrf
                <button type="submit" id="addRowButton" class="btn btn-warning"><i class="fa fa-rocket"></i> Release</button>
            </form>
            @else
            <span class="badge badge-success">Released</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Permohonan Dana Operasional</div>
                </div>
                <form action="{{route('dana.update', $permohonandana->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$permohonandana->id}}" id="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="area_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($areas as $key => $area)
                                        <option value="{{$area->id}}" <?php echo $area->id == $stevedoring->area_id ? "selected='selected'" : ''; ?>>{{$area->name}}</option>
                                        @endforeach

                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Pilih area</label>
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Order No</label>
                                    <input id="inputFloatingLabel" <?php echo ($permohonandana->status == '0') ? '' : 'readonly'; ?> name="order_no" value="{{$permohonandana->order_no}}" type="text" class="form-control input-border-bottom">
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Tanggal Pengajuan</label>
                                    <input id="inputFloatingLabel" <?php echo ($permohonandana->status == '0') ? '' : 'readonly'; ?> name="tanggal_pengajuan" value="{{ date('Y-m-d', strtotime($permohonandana->tanggal_pengajuan)) }}" type="date" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Tanggal Transfer</label>
                                    <input id="inputFloatingLabel" <?php echo ($permohonandana->status == '0') ? '' : 'readonly'; ?> name="tanggal_transfer" value="{{date('Y-m-d', strtotime($permohonandana->tanggal_transfer)) }}" type="date" class="form-control input-border-bottom" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if($permohonandana->status == '0')
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="addRowButton" class="btn btn-success float-right"><i class="fa fa-edit"></i> Update</button>
                            </div>
                        </div>
                    </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Deskripsi</h4>

                        @if($permohonandana->status == '0')

                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                        @endif
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
                                <form action="{{ route('subdanaone.store') }}" name="form" method="POST">
                                    @csrf
                                    <input type="hidden" name="permohonandana_id" value="{{$permohonandana->id}}">
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
                                                        <input id="addDasarHarga" name="dasar_harga" value="0" type="text" class="form-control" placeholder="1.000.000">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-0">
                                                    <div class="form-group form-group-default">
                                                        <label>PPN</label>
                                                        <input id="addPPn" name="ppn" value="0" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>PPh</label>
                                                        <input id="addPPh" name="pph" value="0" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Pengajuan</label>
                                                        <input id="addPengajuan" readonly name="pengajuan" type="text" class="form-control text-bold" placeholder="0">
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

@push('js-footer')
<script>
    $(".perhitungan").keyup(function() {

        var dasarHarga = parseInt($("#addDasarHarga").val())
        var ppn = parseInt($("#addPPn").val())
        var pph = parseInt($("#addPPh").val())

        var total = (dasarHarga + ppn) - pph;

        document.form.addPengajuan.value = tandaPemisahTitik(total);

    });
</script>
@endpush