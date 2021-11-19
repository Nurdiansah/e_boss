@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Form</h4>
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
                <a href="#">Create</a>
            </li>

        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Create Stevedoring</div>
                </div>
                <form action="{{ route('stevedoring.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <!-- area -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="area_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($areas as $key => $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Area</label>
                                </div>
                                <!-- client -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="client_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($clients as $key => $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Client</label>
                                </div>
                                <!-- vessel -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="vessel_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($vessels as $key => $vessel)
                                        <option value="{{$vessel->id}}">{{$vessel->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Vessel</label>
                                </div>
                                <!-- agent -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="agent_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($agents as $key => $agent)
                                        <option value="{{$agent->id}}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Agent</label>
                                </div>
                                <!-- jetty -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="jetty_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($jetties as $key => $jetty)
                                        <option value="{{$jetty->id}}">{{$jetty->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Jetty</label>
                                </div>
                                <!-- stevedoringcategory -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="stevedoringcategory_id" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($stevedoringcategories as $key => $stevedoringcategory)
                                        <option value="{{$stevedoringcategory->id}}">{{$stevedoringcategory->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Category</label>
                                </div>
                                <!-- orign port -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="orign_port" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($ports as $key => $port)
                                        <option value="{{$port->name}}">{{$port->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Orign Port</label>
                                </div>
                                <!-- destination port -->
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="destination_port" required>
                                        <option value="">&nbsp;</option>
                                        @foreach($ports as $key => $port)
                                        <option value="{{$port->name}}">{{$port->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Destination Port</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Entry Date</label>
                                    <input id="inputFloatingLabel" name="entry_date" type="datetime-local" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Exit Date</label>
                                    <input id="inputFloatingLabel" name="exit_date" type="datetime-local" class="form-control input-border-bottom">
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" name="command_document" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">Command Document</label>
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" name="wo_number" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">WO Number</label>
                                </div>
                                <div class="form-group">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen PTW</label>
                                    <input id="inputFloatingLabel" name="doc_ptw" type="file" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen PJSM</label>
                                    <input id="inputFloatingLabel" name="doc_pjsm" type="file" class="form-control input-border-bottom" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputFloatingLabel" class="placeholder">Dokumen LSAP</label>
                                    <input id="inputFloatingLabel" name="doc_lsap" type="file" class="form-control input-border-bottom" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 ">
                                <button class="btn btn-primary float-right" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                <button class="btn btn-danger float-right mr-2" type="reset"><i class="fa fa-save"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection