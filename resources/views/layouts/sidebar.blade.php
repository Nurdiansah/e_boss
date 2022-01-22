<!-- Sidebar -->
<div class="sidebar sidebar-style-2 ">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{asset('/img/profile.jpeg')}}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{auth()->user()->name}}
                            <!-- <span class="user-level">Administrator</span> -->
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="{{route('home')}}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section"> Master Data</h4>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-database"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('agents')}}">
                                    <span class="sub-item">Agents</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Areas</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Checkers</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Clients</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Equipments</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Equipment Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Item Masters</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Jetties</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Port</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Vessels</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section"> Stevedoring</h4>
                </li>

                @hasrole('superuser|admin_ops')
                <li class="nav-item">
                    <a href="{{route('stevedoring.create')}}">
                        <i class="fas fas fa-ship"></i>
                        <p>Create</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('stevedoring.draft')}}">
                        <i class="fas fas fa-folder"></i>
                        <p>Draft</p>
                    </a>
                </li>

                @endhasrole

                @hasrole('checker')
                <li class="nav-item">
                    <a href="{{route('stevedoring.lolo')}}">
                        <i class="fas fas fa-truck-loading"></i>
                        <p>Proses</p>
                        <!-- <span class="badge badge-success">4</span> -->
                    </a>
                </li>
                @endhasrole

                @hasrole('spv_ops')
                <li class="nav-item">
                    <a href="{{route('stevedoring.app.spv')}}">
                        <i class="fas fas fa-check"></i>
                        <p>Approval</p>
                        <!-- <span class="badge badge-success">4</span> -->
                    </a>
                </li>
                @endhasrole

                @hasrole('manager_ops')
                <li class="nav-item">
                    <a href="{{route('stevedoring.app.mgr')}}">
                        <i class="fas fas fa-check"></i>
                        <p>Approval</p>
                        <!-- <span class="badge badge-success">4</span> -->
                    </a>
                </li>
                @endhasrole

                @hasrole('superuser|admin_ops|spv_ops|manager_ops|client')

                <li class="nav-item">
                    <a href="{{route('stevedoring.proses')}}">
                        <i class="fas fas fa-truck-loading"></i>
                        <p>Proses</p>
                        <!-- <span class="badge badge-success">4</span> -->
                    </a>
                </li>
                @endhasrole

                <li class="nav-item">
                    <a href="{{route('stevedoring.history')}}">
                        <i class="fas fas fa-history"></i>
                        <p>History</p>
                        <!-- <span class="badge badge-success">4</span> -->
                    </a>
                </li>

                <!-- </ul>
                    </div> -->
                <!-- </li> -->
                <!-- <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/jqvmap.html">
                                    <span class="sub-item">JQVMap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="mx-4 mt-2">
                    <!-- <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> -->
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->