@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Form Detail</h4>
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
                <a href="#">Stevedoring</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail</a>
            </li>

        </ul>
    </div>



    <!-- Form Manifest -->
    <!--  -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Cargo Manifest</h4>

                        @if($stevedoring->status == '0')

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
                                    <input type="hidden" name="permohonandana_id" value="{{$stevedoring->id}}">
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
                                    <th colspan="3">DOC NO</th>
                                    <th>QTY</th>
                                    <th>DESCRIPTION</th>
                                    <th>REMARKS</th>
                                    <th>DIMENTION</th>
                                    <th>M<sup>3</sup></th>
                                    <th>TON</th>
                                    <th>TON/M<sup>3</sup></th>
                                    <!-- <th style="width: 10%">Action</th> -->
                                </tr>
                            </thead>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->

    <!-- Detail Stevedoring -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Detail Stevedoring</h4>
                        <!-- <a href="{{route('stevedoring.create')}}" class="ml-auto "> -->
                        <span class="ml-auto  ">
                            <i class="fa fa-window-minimize"></i>
                        </span>
                        <!-- </a> -->
                    </div>
                </div>
                <form action="{{ route('stevedoring.update',$stevedoring->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <!-- area -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="area_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($areas as $key => $area)

                                        @if (old('area_id') == $area->id || $stevedoring->area_id == $area->id)
                                        <option value="{{ $area->id }}" selected>{{ $area->name }}</option>
                                        @else
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endif

                                        @endforeach

                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Area</label>
                                </div>
                                @error('area_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- client -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="client_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($clients as $key => $client)
                                        @if (old('client_id') == $client->id || $stevedoring->client_id == $client->id)
                                        <option value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                        @else
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Client</label>
                                </div>
                                @error('client_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- vessel -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="vessel_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($vessels as $key => $vessel)
                                        @if (old('vessel_id') == $vessel->id || $stevedoring->vessel_id == $vessel->id)
                                        <option value="{{ $vessel->id }}" selected>{{ $vessel->name }}</option>
                                        @else
                                        <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Vessel</label>
                                </div>
                                @error('vessel_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- agent -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="agent_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($agents as $key => $agent)
                                        @if (old('agent_id') == $agent->id || $stevedoring->agent_id == $agent->id)
                                        <option value="{{ $agent->id }}" selected>{{ $agent->name }}</option>
                                        @else
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Agent</label>
                                </div>
                                @error('agent_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- jetty -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="jetty_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($jetties as $key => $jetty)
                                        @if (old('jetty_id') == $jetty->id || $stevedoring->jetty_id == $jetty->id)
                                        <option value="{{ $jetty->id }}" selected>{{ $jetty->name }}</option>
                                        @else
                                        <option value="{{ $jetty->id }}">{{ $jetty->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Jetty</label>
                                </div>
                                @error('jetty_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- stevedoringcategory -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="stevedoringcategory_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($stevedoringcategories as $key => $stevedoringcategory)
                                        @if (old('stevedoringcategory_id') == $stevedoringcategory->id || $stevedoring->stevedoringcategory_id == $stevedoringcategory->id)
                                        <option value="{{ $stevedoringcategory->id }}" selected>{{ $stevedoringcategory->name }}</option>
                                        @else
                                        <option value="{{ $stevedoringcategory->id }}">{{ $stevedoringcategory->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Category</label>
                                </div>
                                @error('stevedoringcategory_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <!-- orign port -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="orign_port" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($ports as $key => $port)
                                        @if (old('orign_port') == $port->name || $stevedoring->orign_port == $port->name)
                                        <option value="{{ $port->name }}" selected>{{ $port->name }}</option>
                                        @else
                                        <option value="{{ $port->name }}">{{ $port->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Orign Port</label>
                                </div>
                                @error('orign_port')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- destination port -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="destination_port" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($ports as $key => $port)
                                        @if (old('destination_port') == $port->name || $stevedoring->destination_port == $port->name)
                                        <option value="{{ $port->name }}" selected>{{ $port->name }}</option>
                                        @else
                                        <option value="{{ $port->name }}">{{ $port->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Destination Port</label>
                                </div>
                                @error('destination_port')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Entry Date</label>
                                    <input id="inputFloatingLabel" value="{{ datetimeLocal($stevedoring->entry_date) }}" name="entry_date" type="datetime-local" class="form-control input-border-bottom" required>
                                </div>
                                @error('entry_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Exit Date</label>
                                    <input id="inputFloatingLabel" name="exit_date" value="{{ datetimeLocal($stevedoring->exit_date) }}" type="datetime-local" class="form-control input-border-bottom">
                                </div>
                                @error('exit_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" name="command_document" value="{{ $stevedoring->command_document }}" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">Command Document</label>
                                </div>
                                @error('command_document')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" name="wo_number" value="{{ $stevedoring->wo_number }}" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">WO Number</label>
                                </div>
                                @error('wo_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen PTW</label>
                                    <input id="inputFloatingLabel" name="doc_ptw" type="file" class="form-control input-border-bottom">
                                    <p class="text-danger"><i>* Kosongkan jika tidak ingin dirubah</i></p>
                                    <a href="{{route('link',$stevedoring->doc_ptw)}}" target="_blank" class="link-success">Preview Dokumen PTW</a>
                                </div>

                                <div class="form-group">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen PJSM</label>
                                    <input id="inputFloatingLabel" name="doc_pjsm" type="file" class="form-control input-border-bottom">
                                    <p class="text-danger"><i>* Kosongkan jika tidak ingin dirubah</i></p>
                                    <a href="{{route('link',$stevedoring->doc_pjsm)}}" target="_blank" class="link-primary">Preview Dokumen PJSM</a>
                                </div>

                                <div class="form-group">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen LSAP</label>
                                    <input id="inputFloatingLabel" name="doc_lsap" type="file" class="form-control input-border-bottom">
                                    <p class="text-danger"><i>* Kosongkan jika tidak ingin dirubah</i></p>
                                    <a href="{{route('link',$stevedoring->doc_lsap)}}" target="_blank" class="link-primary">Preview Dokumen LSAP</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 ">
                                <button class="btn btn-success float-right" type="submit"><i class="fa fa-save"></i> Update</button>
                                <button class="btn btn-danger float-right mr-2" type="reset"><i class="fa fas fa-undo"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


@endsection