@extends('layouts.app')

@section('content')

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

    <!-- Button -->
    <div class="row mb-3">

        @if($stevedoring->start_activity == null)
        <button class="btn btn-primary mr-1" data-toggle="modal" data-target="#modalStart">
            <i class="fa fa-play"> Start</i>
        </button>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalStart" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd bg-primary">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                                Konfirmasi</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('stevedoring.start', $stevedoring->id) }}" name="form" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{$stevedoring->id}}">
                        <div class="perhitungan">
                            <div class="modal-body">
                                <h5 class="text-center">Apa anda yakin ingin memulai kegiatan?</h5 class="text-center">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" id="addRowButton" class="btn btn-primary"><i class="fa fa-submit"></i> Ya, saya yakin</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Modal Tambah -->


        @else
        <button class="btn btn-primary mr-1" disabled="disabled"><i class="fa fa-play"> Start</i></button>
        @endif

        <!-- Tombol Stop -->
        @if($stevedoring->start_activity != null && $stevedoring->status == '2' )
        <!-- <button class="btn btn-danger mr-1"><i class="fa fa-stop"> Stop</i></button> -->
        <button class="btn btn-danger mr-1" data-toggle="modal" data-target="#modalStop">
            <i class="fa fa-stop"> Stop</i>
        </button>

        <!-- Modal Stop -->
        <div class="modal fade" id="modalStop" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd bg-danger">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                                Konfirmasi</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('stevedoring.stop', $stevedoring->id) }}" name="form" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{$stevedoring->id}}">
                        <div class="perhitungan">
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Keterangan Berhenti</label>
                                    <textarea id="inputFloatingLabel" name="description" value="" type="text" class="form-control input-border-bottom" placeholder="Contoh : Istirahat" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" id="addRowButton" class="btn btn-danger"><i class="fa fa-check"></i> Stop</button>
                                <button type="button" class="btn btn-" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Modal Stop -->
        @else
        <button class="btn btn-danger mr-1" disabled="disabled"><i class="fa fa-stop"> Stop</i></button>
        @endif

        <!-- Tombol Continue -->
        @if($stevedoring->status == '3' )
        <button class="btn btn-warning mr-1" data-toggle="modal" data-target="#modalContinue">
            <i class="fa fa-play-circle"> Continue</i>
        </button>
        <!-- Modal Continue -->
        <div class="modal fade" id="modalContinue" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd bg-warning">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                                Konfirmasi</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('stevedoring.continue', $stevedoring->id) }}" name="form" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{$stevedoring->id}}">
                        <div class="perhitungan">
                            <div class="modal-body">
                                <h5 class="text-center">Apa anda yakin ingin melanjutkan kegiatan?</h5 class="text-center">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" id="addRowButton" class="btn btn-warning"><i class="fa fa-check"></i> Ya, saya yakin</button>
                                <button type="button" class="btn btn-" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Modal Continue -->
        @else
        <button class="btn btn-warning mr-1" disabled="disabled"><i class="fa fa-play-circle"> Continue</i></button>
        @endif
        <!-- End Tombol Continue -->


        <!-- <button class="btn btn-primary" disabled="disabled"><i class="fa fa-flag-checkered"> Finish</i></button> -->
        <!-- Tombol Finish -->
        @if($cargoQuantity == '0' && $stevedoring->status == '2' )
        <button class="btn btn-success mr-1" data-toggle="modal" data-target="#modalFinish">
            <i class="fa fa-flag-checkered"> Finish</i>
        </button>
        <!-- Modal Finish -->
        <div class="modal fade" id="modalFinish" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd bg-success">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">
                                Konfirmasi</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('stevedoring.finish', $stevedoring->id) }}" name="form" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{$stevedoring->id}}">
                        <div class="perhitungan">
                            <div class="modal-body">
                                <h5 class="text-center">Apa anda yakin ingin mengakhiri kegiatan?</h5 class="text-center">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" id="addRowButton" class="btn btn-success"><i class="fa fa-check"></i> Ya, saya yakin</button>
                                <button type="button" class="btn btn-" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Modal Finish -->
        @else
        <button class="btn btn-success mr-1" disabled="disabled"><i class="fa fa-flag-checkered"> Finish</i></button>
        @endif
        <!-- End Tombol Finish -->

    </div>




    <!-- Form Manifest -->
    <!--  -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Cargo Manifest</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="manifestTable" class="display table table-striped table-hover">
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
                <form action="" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <!-- area -->
                                <div class="form-group ">
                                    <label for="selectFloatingLabel" class="placeholder"> Area</label>
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="area_id" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="client_id" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="vessel_id" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="agent_id" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="jetty_id" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="stevedoringcategory_id" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="orign_port" required readonly>
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
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" name="destination_port" required readonly>
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
                                    <input id="inputFloatingLabel" value="{{ datetimeLocal($stevedoring->entry_date) }}" name="entry_date" type="datetime-local" class="form-control input-border-bottom" required readonly>
                                </div>
                                @error('entry_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Exit Date</label>
                                    <input id="inputFloatingLabel" name="exit_date" value="{{ datetimeLocal($stevedoring->exit_date) }}" type="datetime-local" class="form-control input-border-bottom" readonly>
                                </div>
                                @error('exit_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">Command Document</label>
                                    <input id="inputFloatingLabel" name="command_document" value="{{ $stevedoring->command_document }}" type="text" class="form-control input-border-bottom" required readonly>
                                </div>
                                @error('command_document')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group ">
                                    <label for="inputFloatingLabel" class="placeholder">WO Number</label>
                                    <input id="inputFloatingLabel" name="wo_number" value="{{ $stevedoring->wo_number }}" type="text" class="form-control input-border-bottom" required readonly>
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
        // $('#manifestTable').DataTable({});

        let id = <?= $stevedoring->id ?>;

        console.log(id);

        var table = $('#manifestTable').DataTable({
            "ajax": 'http://127.0.0.1:8000/api/stevedoring-manifest/' + id,
            "columns": [{
                    data: "doc_no"
                },
                {
                    data: "qty"
                },
                {
                    data: "description"
                },
                {
                    data: "remarks"
                },
                {
                    data: "long"
                },
                {
                    data: "width"
                },
                {
                    data: "height"
                },
                {
                    data: "m3"
                },
                {
                    data: "ton"
                },
                {
                    data: "revton"
                },
                {
                    // defaultContent: "<button type='button' class='btn btn-success' data-toggle='modal' data-id='' data-target='#addModal'><i class='fa fa-edit'></i></button>",
                    // data: "id",
                    // "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    //     $(nTd).html("<a href='/" + oData.id + "'>" + oData.id + "</a>");
                    // }
                    data: "id",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<button type='button' class='btn btn-success' data-toggle='modal' data-id='" + oData.id + "' data-target='#addModal'><i class='fa fa-edit'></i></button>");
                    }
                }
            ]
        });

        // Reload the table data every 30 seconds (paging retained):
        setInterval(function() {
            table.ajax.reload(null, false); // user paging is not reset on reload
        }, 50000);
    });
</script>
@endpush