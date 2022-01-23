@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Equipment</h4>
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
                <a href="{{route('home')}}">Index</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Equipment</h4>
                        <button class="btn btn-primary btn-round float-right ml-auto " data-toggle="modal" data-target="#modalAdd" ">
                            <i class=" fa fa-plus"></i>
                            Tambah
                        </button>

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd bg-primary">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                Add Equipment</span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('equipment.store')}}" name="form" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="">
                                        <div class="perhitungan">
                                            <div class="modal-body">
                                                <div class="form-group ">
                                                    <label for="inputFloatingLabel" class="placeholder">Name</label>
                                                    <input id="inputFloatingLabel" name="name" value="" type="text" class="form-control input-border-bottom" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="submit" id="addRowButton" class="btn btn-primary"><i class="fa fa-submit"></i> Save</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- Modal Tambah -->
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->

                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipments as $key => $equipment)
                                <tr>
                                    <td> <a href="{{route('equipment.show', $equipment->id)}}"> {{$equipment->name}} </a></td>
                                    <td>{{$equipment->created_at}}</td>
                                    <td>{{$equipment->updated_at}}</td>
                                    <td>
                                        <!-- route('equipment.edit', $equipment->id -->
                                        <a href="">
                                            <a href="{{route('equipment.edit', $equipment->id)}}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete&id={{ $equipment->id }}"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="modalDelete&id={{ $equipment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd bg-danger">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        Delete Equipment</span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('equipment.delete', $equipment->id)}}" name="form" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" name="id" value="">
                                                <div class="perhitungan">
                                                    <div class="modal-body">
                                                        <h4 class="text-center">Apakah anda yakin ingin menghapus equipment {{$equipment->name}} ?</h4>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" id="addRowButton" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- Modal Delete -->

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Created</th>
                                    <th>Updated</th>
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

@push('js-footer')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script>
@endpush