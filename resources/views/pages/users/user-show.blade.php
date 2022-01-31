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
                <a href="{{route('users')}}">User</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail</a>
            </li>

        </ul>
    </div>
</div>
<!--  -->

<!-- Detail User -->
<div class="row">
    <div class="col-md-6 ml-5">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="d-flex align-items-center">
                    <h4 class="card-title text-light">Detail User</h4>
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
                                <label for="inputFloatingLabel" class="placeholder">Name</label>
                                <input id="inputFloatingLabel" name="name" value="{{ $user->name }}" type="text" class="form-control input-border-bottom" required disabled>
                            </div>
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Created</label>
                                <input id="inputFloatingLabel" name="name" value="{{ $user->created_at }}" type="text" class="form-control input-border-bottom" required disabled>
                            </div>
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Updated</label>
                                <input id="inputFloatingLabel" name="name" value="{{ $user->updated_at }}" type="text" class="form-control input-border-bottom" required disabled>
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