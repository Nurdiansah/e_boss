@extends('layouts.app')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Edit</h4>
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
                <a href="{{route('agents')}}">Agent</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit</a>
            </li>

        </ul>
    </div>
</div>
<!--  -->

<!-- Detail Agent -->
<div class="row">
    <div class="col-md-6 ml-5">
        <div class="card">
            <div class="card-header bg-success">
                <div class="d-flex align-items-center">
                    <h4 class="card-title text-light">Edit Agent</h4>
                    <!-- <a href="{{route('stevedoring.create')}}" class="ml-auto "> -->
                    <span class="ml-auto  ">
                        <i class="fa fa-window-minimize"></i>
                    </span>
                    <!-- </a> -->
                </div>
            </div>
            <form action="{{route('agent.update', $agent->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Name</label>
                                <input id="inputFloatingLabel" name="name" value="{{ $agent->name }}" type="text" class="form-control input-border-bottom" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 ">
                            <button class="btn btn-primary" name="save" type="submit"><i class="fa fa-save"></i> Simpan</button>
                            <button class="btn btn-danger" type="reset"><i class="fa fa-reply"></i> Reset</button>
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