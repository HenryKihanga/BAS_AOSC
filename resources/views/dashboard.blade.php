@extends('layouts.admin')
@push('scripts')
    <script>
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        $('#h').text(h + ":" + m + ":" + s);

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            $('#h').text(h + ":" + m + ":" + s);
        }
        setInterval(startTime, 1000);

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }

        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                    label: 'Absentees',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Presentees',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })




        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    </script>
@endpush
@section('navitem')
    <nav class="mt-2 myNavtab">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
                <a href="{{ route('home', Auth::user()->user_id) }}" class="nav-link active "
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('addUser') }}" class="nav-link " onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Add User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('allUsers', Auth::user()->user_id) }}" class="nav-link "
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fingerprintoverallLogs') }}" class="nav-link" onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Fingerprint Logs
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rfidoverallLogs') }}" class="nav-link" onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        RFID Logs
                    </p>
                </a>
            </li>
            @can('manageOrganization')
                <li class="nav-item">
                    <a href="{{ route('manageOrganization', Auth::user()->user_id) }}" class="nav-link "
                        onclick="toggle_active_class()">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Organizations
                        </p>
                    </a>
                </li>
            @endcan
            @can('manageBranch')
                <li class="nav-item">
                    <a href="{{ route('manageBranch', Auth::user()->user_id) }}" class="nav-link "
                        onclick="toggle_active_class()">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Branches
                        </p>
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route('manageDepartment', Auth::user()->user_id) }}" class="nav-link "
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                        Departments
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('showRoomManage') }}" class="nav-link">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                        Rooms
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('deviceManage', Auth::user()->user_id) }}" class="nav-link "
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-microchip"></i>
                    <p>
                        Devices
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('showUserProfile', [Auth::user()->user_id]) }}" class="nav-link "
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                        View Profile
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-edit"></i>
                    <p>
                        Edit Profile
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('showChangePassword') }}" class="nav-link " onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Change Password
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>

@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <!-- ROW YENYE MA BOX MA NNE  -->
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $registeredUsers }}</h3>
                                    <p>Total Users Available</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{ route('allUsers', Auth::user()->user_id) }}" class="small-box-footer">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $presentUsers }}<sup style="font-size: 20px">%</sup></h3>
                                    <p>Users Present Today</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <a href="{{ route('userPresentToday') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> <!-- ./col -->
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $absentUsers }}<sup style="font-size: 20px">%</sup></h3>
                                    <p>Absentees</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-times"></i>
                                </div>
                                <a href="{{ route('usersAbsenteToday') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                    </div>
                    {{-- DATA FOR AOSC ############################ --}}
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $rooms }}</h3>
                                    <p>Registered Rooms</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-person-booth"></i>
                                </div>
                                <a href="{{ route('showAllRooms') }}"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                   
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>{{ $usersWithCard }}</h3>
                                    <p>Users With Card</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <a href="{{ route('usersWithCard', Auth::user()->user_id) }}"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>

                        </div>
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $usersWithoutCard }}</h3>
                                    <p>Users Without Card</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-id-card" ><sup style="font-size: 40px"><i class="fas fa-times-circle"></i></sup></i>
                                </div>
                                <a href="{{ route('usersWithoutCard', Auth::user()->user_id) }}"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>


                        </div>
                        {{-- END OF DATA FOR AOSC ############################ --}}
                    </div>
                </div> <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="small-box ">
                                <div class="inner">
                                    <h3 id="h"></h3>
                                    <p>Current Time</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="small-box-footer"><i class="fas fa-clock"></i></div>
                            </div>
                        </div>
                    </div>
                      {{--  DATA FOR AOSC ############################ --}}
                    <div class="row">
                        <div class="col-lg-12 col-12">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $sensitiveLogs }}</h3>
                                <p>Users Visited Sensitive Rooms</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <a href="{{ route('sensitiveLogs') }}"
                                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        </div>
                    </div>
                      {{-- END OF DATA FOR AOSC ############################ --}}
            
                </div><!-- ./col -->
            </div>
            {{-- ++++++++++===========================================+++++++++++++++++++++++ --}}
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $registeredDevices }}</h3>
                                    <p>Devices</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-microchip"></i>
                                </div>
                                <a href="{{ route('showAllDevices') }}"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            @can('isAdmin')
                                <!-- small box -->
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ $registeredOrganizations }}</h3>
                                        <p>Registerd Organization</p>
                                    </div>
                                    <div class="icon">
                                        <i class="nav-icon fas fa-university"></i>
                                    </div>
                                    <a href="{{ route('showAllOrganizations') }}"
                                        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endcan
                            @can('isOrganizationHead')
                                <!-- small box -->
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3>{{ $registeredBranches }}</h3>
                                        <p>Registered Branches</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-sitemap"></i>
                                    </div>
                                    <a href="{{ route('showAllBranches') }}"
                                        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endcan
                            @can('isBranchHead')
                                <!-- small box -->
                                <div class="small-box bg-light">
                                    <div class="inner">
                                        <h3>{{ $registeredDepartments }}</h3>
                                        <p>Registerd Departments</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fab fa-dyalog"></i>
                                    </div>
                                    <a href="{{ route('showAllDepartments') }}"
                                        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endcan

                        </div>
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $enrolledUsers }}</h3>
                                    <p>Enrolled Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-fingerprint"></i>
                                </div>
                                <a href="{{ route('enrolledUser', Auth::user()->user_id) }}"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            @can('isAdmin')
                                <!-- small box -->
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3>{{ $registeredBranches }}</h3>
                                        <p>Registered Branches</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-sitemap"></i>
                                    </div>
                                    <a href="{{ route('showAllBranches') }}"
                                        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endcan
                            @can('isOrganizationHead')
                                <!-- small box -->
                                <div class="small-box bg-light">
                                    <div class="inner">
                                        <h3>{{ $registeredDepartments }}</h3>
                                        <p>Registerd Departments</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fab fa-dyalog"></i>
                                    </div>
                                    <a href="{{ route('showAllDepartments') }}"
                                        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endcan
                        </div>
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>{{ $unenrolledUsers }}</h3>
                                    <p>Not Enrolled Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-fingerprint"><sup style="font-size: 40px"><i class="fas fa-times-circle"></i></sup></i>
                                </div>
                                <a href="{{ route('unenrolledUser', Auth::user()->user_id) }}"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            @can('isAdmin')
                                <!-- small box -->
                                <div class="small-box bg-light">
                                    <div class="inner">
                                        <h3>{{ $registeredDepartments }}</h3>
                                        <p>Registerd Departments</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fab fa-dyalog"></i>
                                    </div>
                                    <a href="{{ route('showAllDepartments') }}"
                                        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div> <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="card bg-gradient-success">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Calendar
                                    </h3>
                                    <!-- tools card -->
                                    <div class="card-tools">

                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pt-0">
                                    <!--The calendar -->
                                    <div id="calendar"
                                        style="min-height: 150px; height: 200px; max-height: 200px; max-width: 100%;"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div> <!-- ./col -->
            </div>

            <!-- /.row -->
            <!-- ###MWISHO WA ROW YENYE MA BOX MA NNE-->


            <!-- MAIN ROW -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-area mr-1"></i>
                                Attendance
                            </h3>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>


                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <section class="col-lg-5 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Attendance
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>



                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <!-- Map card -->
                    <div class="card bg-gradient-primary" style="display: none">

                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white">Visitors</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white">Online</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white">Sales</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
            </div>
            <!-- ###MWISHO WA MAIN ROW -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
