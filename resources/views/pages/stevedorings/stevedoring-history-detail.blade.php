@extends('layouts.app')

@section('content')
<?php
$jumlahData = count($stevedoringmanifests);
?>

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Detail</h4>
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

    @if($stevedoring->status == '3')
    <div class="alert alert-warning" role="alert">
        Pekerjaan Stevedoring terjeda !
        <span>{{$break->description}}</span>
    </div>
    @endif
    <!-- Form Manifest -->
    <!--  -->
    <div class="row">

        @if ($stevedoring->status < '4' ) <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title text-light">Cargo Manifest</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <!-- <table id="add-row" class="display table table-striped table-hover"> -->
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-top">DOC NO</th>
                                    <th rowspan="2">QTY</th>
                                    <th rowspan="2">DESCRIPTION</th>
                                    <th rowspan="2">REMARKS</th>
                                    <th colspan="3" class="text-center">DIMENTION</th>
                                    <th rowspan="2">M<sup>3</sup></th>
                                    <th rowspan="2">TON</th>
                                    <th rowspan="2">TON/M<sup>3</sup></th>
                                </tr>
                                <tr>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>T</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stevedoringmanifests as $key => $stevedoringmanifest)

                                <tr>
                                    <td>{{$stevedoringmanifest->doc_no}}</td>
                                    <td>{{$stevedoringmanifest->qty}}</td>
                                    <td>{{$stevedoringmanifest->description}}</td>
                                    <td>{{$stevedoringmanifest->remarks}}</td>
                                    <td>{{$stevedoringmanifest->itemmaster->long}}</td>
                                    <td>{{$stevedoringmanifest->itemmaster->widht}}</td>
                                    <td>{{$stevedoringmanifest->itemmaster->height}}</td>
                                    <td>{{$stevedoringmanifest->m3}}</td>
                                    <td>{{$stevedoringmanifest->ton}}</td>
                                    <td>{{$stevedoringmanifest->revton}}</td>
                                </tr>

                                @endforeach

                                @if($jumlahData == 0)
                                <tr>
                                    <td colspan="11"><i class="fas fa-exclamation"></i> Tidak ada data tersedia</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    @else
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success">
                <div class="d-flex align-items-center">
                    <h4 class="card-title text-light">Cargo Tally Sheet</h4>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <!-- <table id="add-row" class="display table table-striped table-hover"> -->
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-top">DOC NO</th>
                                <th rowspan="2">QTY</th>
                                <th rowspan="2">DESCRIPTION</th>
                                <th rowspan="2">REMARKS</th>
                                <th colspan="3" class="text-center">DIMENTION</th>
                                <th rowspan="2">M<sup>3</sup></th>
                                <th rowspan="2">TON</th>
                                <th rowspan="2">TON/M<sup>3</sup></th>
                            </tr>
                            <tr>
                                <th>P</th>
                                <th>L</th>
                                <th>T</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stevedoringtallysheets as $key => $stevedoringtallysheet)

                            <tr>
                                <td>{{$stevedoringtallysheet->doc_no}}</td>
                                <td>{{$stevedoringtallysheet->qty}}</td>
                                <td>{{$stevedoringtallysheet->description}}</td>
                                <td>{{$stevedoringtallysheet->remarks}}</td>
                                <td>{{$stevedoringtallysheet->long}}</td>
                                <td>{{$stevedoringtallysheet->widht}}</td>
                                <td>{{$stevedoringtallysheet->height}}</td>
                                <td>{{$stevedoringtallysheet->m3}}</td>
                                <td>{{$stevedoringtallysheet->ton}}</td>
                                <td>{{$stevedoringtallysheet->revton}}</td>
                            </tr>

                            @endforeach

                            @if($jumlahData == 0)
                            <tr>
                                <td colspan="11"><i class="fas fa-exclamation"></i> Tidak ada data tersedia</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-4">

        <!-- start activity -->
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-success mr-3">
                    <i class="fa fa-play"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="#">Start Activity</a></b></h5>
                    @if(!is_null($stevedoring->start_activity))
                    <small class="text-muted">{{ date("d F Y H:s", strtotime($stevedoring->start_activity))}}</small>
                    @else
                    <small class="text-muted">Waiting...</small>
                    @endif
                </div>
            </div>
        </div>

        <!-- Finish Activity -->
        @if(!is_null($stevedoring->finish_activity))
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-primary mr-3">
                    <i class="fa fa-flag-checkered"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="#">Finish Activity</a></b></h5>
                    <small class="text-muted">{{ date("d F Y H:s", strtotime($stevedoring->finish_activity))}}</small>
                </div>
            </div>
        </div>

        <!-- Waktu -->
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-warning mr-3">
                    <i class="fa fa-clock"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="#">Duration Activity</a></b></h5>
                    <small class="text-muted">{{ $stevedoring->text_duration}}</small>
                </div>
            </div>
        </div>
        @endif

        <!-- progress -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        @if($stevedoring<'4') <h5><b>Progress Kegiatan</b></h5>
                            @else
                            <h5><b>Hasil Kegiatan</b></h5>
                            @endif
                            <p class="text-muted">Semua Kargo yang di bongkar/muat</p>
                    </div>
                    <h5 class="text-info fw-bold">{{$realisasiCargo}} TON/M<sup>2</sup></h5>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$changeCargo}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$changeCargo}}%"></div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    @if($stevedoring<'4') <p class="text-muted mb-0">Perubahan</p>
                        @else
                        <p class="text-muted mb-0">Hasil</p>
                        @endif
                        <p class="text-muted mb-0">{{$changeCargo}}%</p>
                </div>
            </div>
        </div>

        <!-- equipment -->
        <div class="card">
            <div class="card-header bg-primary">
                <div class="d-flex align-items-center">
                    <h4 class="card-title text-light">Using Equipment</h4>

                </div>
            </div>
            <div class="card-body">


                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <tbody>
                            @foreach ($stevedoringuseequipments as $key => $stevedoringuseequipment)

                            <tr>
                                <td>{{$stevedoringuseequipment->equipment->name}}</td>
                            </tr>


                            @endforeach

                            @if($jumlahData == 0)
                            <tr>
                                <td><i class="fas fa-exclamation"></i> Tidak ada data tersedia</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-6 col-lg-3"> -->

        <!-- </div> -->
    </div>
</div>
<!--  -->

<!-- Detail Stevedoring -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-warning">
                <div class="d-flex align-items-center">
                    <h4 class="card-title text-light">Detail Stevedoring</h4>
                    <!-- <a href="{{route('stevedoring.create')}}" class="ml-auto "> -->
                    <span class="ml-auto  ">
                        <i class="fa fa-window-minimize"></i>
                    </span>
                    <!-- </a> -->
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <!-- area -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Area</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="area_id" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($areas as $key => $area)

                                    @if (old('area_id') == $area->id || $stevedoring->area_id == $area->id)
                                    <option value="{{ $area->id }}" selected>{{ $area->name }}</option>
                                    @else
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endif

                                    @endforeach

                                </select>
                            </div>
                            @error('area_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- client -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Client</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="client_id" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($clients as $key => $client)
                                    @if (old('client_id') == $client->id || $stevedoring->client_id == $client->id)
                                    <option value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                    @else
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>
                            @error('client_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- vessel -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Vessel</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="vessel_id" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($vessels as $key => $vessel)
                                    @if (old('vessel_id') == $vessel->id || $stevedoring->vessel_id == $vessel->id)
                                    <option value="{{ $vessel->id }}" selected>{{ $vessel->name }}</option>
                                    @else
                                    <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>
                            @error('vessel_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- agent -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Agent</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="agent_id" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($agents as $key => $agent)
                                    @if (old('agent_id') == $agent->id || $stevedoring->agent_id == $agent->id)
                                    <option value="{{ $agent->id }}" selected>{{ $agent->name }}</option>
                                    @else
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('agent_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- jetty -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Jetty</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="jetty_id" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($jetties as $key => $jetty)
                                    @if (old('jetty_id') == $jetty->id || $stevedoring->jetty_id == $jetty->id)
                                    <option value="{{ $jetty->id }}" selected>{{ $jetty->name }}</option>
                                    @else
                                    <option value="{{ $jetty->id }}">{{ $jetty->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('jetty_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- stevedoringcategory -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Category</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="stevedoringcategory_id" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($stevedoringcategories as $key => $stevedoringcategory)
                                    @if (old('stevedoringcategory_id') == $stevedoringcategory->id || $stevedoring->stevedoringcategory_id == $stevedoringcategory->id)
                                    <option value="{{ $stevedoringcategory->id }}" selected>{{ $stevedoringcategory->name }}</option>
                                    @else
                                    <option value="{{ $stevedoringcategory->id }}">{{ $stevedoringcategory->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('stevedoringcategory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <!-- orign port -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Orign Port</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="orign_port" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($ports as $key => $port)
                                    @if (old('orign_port') == $port->name || $stevedoring->orign_port == $port->name)
                                    <option value="{{ $port->name }}" selected>{{ $port->name }}</option>
                                    @else
                                    <option value="{{ $port->name }}">{{ $port->name }}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>
                            @error('orign_port')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- destination port -->
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder"> Destination Port</label>
                                <select class="form-control input-border-bottom" id="selectFloatingLabel" name="destination_port" required disabled>
                                    <option value="">&nbsp;</option>
                                    @foreach($ports as $key => $port)
                                    @if (old('destination_port') == $port->name || $stevedoring->destination_port == $port->name)
                                    <option value="{{ $port->name }}" selected>{{ $port->name }}</option>
                                    @else
                                    <option value="{{ $port->name }}">{{ $port->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('destination_port')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Entry Date</label>
                                <input id="inputFloatingLabel" value="{{ datetimeLocal($stevedoring->entry_date) }}" name="entry_date" type="datetime-local" class="form-control input-border-bottom" required disabled>
                            </div>
                            @error('entry_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Exit Date</label>
                                <input id="inputFloatingLabel" name="exit_date" value="{{ datetimeLocal($stevedoring->exit_date) }}" type="datetime-local" class="form-control input-border-bottom" disabled>
                            </div>
                            @error('exit_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Command Document</label>
                                <input id="inputFloatingLabel" name="command_document" value="{{ $stevedoring->command_document }}" type="text" class="form-control input-border-bottom" required disabled>
                            </div>
                            @error('command_document')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">WO Number</label>
                                <input id="inputFloatingLabel" name="wo_number" value="{{ $stevedoring->wo_number }}" type="text" class="form-control input-border-bottom" required disabled>
                            </div>
                            @error('wo_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="form-group">
                                <label for="inputFloatingLabel" class="placeholder">Dokumen PTW</label>
                                <a href="{{route('link',$stevedoring->doc_ptw)}}" target="_blank" class="link-success">Preview Dokumen PTW</a>
                            </div>

                            <div class="form-group">
                                <label for="inputFloatingLabel" class="placeholder">Dokumen PJSM</label>
                                <a href="{{route('link',$stevedoring->doc_pjsm)}}" target="_blank" class="link-primary">Preview Dokumen PJSM</a>
                            </div>

                            <div class="form-group">
                                <label for="inputFloatingLabel" class="placeholder">Dokumen LSAP</label>
                                <a href="{{route('link',$stevedoring->doc_lsap)}}" target="_blank" class="link-primary">Preview Dokumen LSAP</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 ">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>


@endsection

@push('js-footer')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script>
@endpush