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
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('sensitiveLogs', Auth::user()->user_id) }}">sensitive rooms logs</a></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('sensitiveLogs', Auth::user()->user_id) }}">sensitive rooms logs</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">LOGS FOR SENSITIVE ROOMS</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="max-height: 80%;">
                            @if (count($logs) < 1)
                                <p class="p-4"> There is no data </p>
                            @else
                            <table class="table table-head-fixed">
                                {{-- <table class="table table-head-fixed text-nowrap"> --}}
                                <thead>
                                    <tr>
                                        <th style="width: 10%">SN</th>
                                        <th style="width: 20%">Username</th>
                                        <th style="width: 10%">Time-in</th>
                                        <th style="width: 10%">Time-out</th>
                                        <th style="width: 10%">Date</th>
                                        <th style="width: 10%">Device</th>
                                        <th style="width: 10%">Room</th>
                                        <th style="width: 10%">Security</th>
                                        <th style="width: 10%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                      $sn = 0;  
                                    @endphp
                                    @foreach ($logs as $log)
                                    @php
                                      $sn ++;  
                                    @endphp
                                        <tr>
                                            <td style="width: 10%">
                                                {{ $sn }}</td>
                                            <td style="width: 20%">
                                                {{ $log->user->first_name }}
                                                {{ $log->user->middle_name }}
                                                {{ $log->user->last_name }}</td>
                                            <td style="width: 10%">
                                                {{ $log->time_in }}</td>
                                            <td style="width: 10%">
                                                {{ $log->time_out }}</td>
                                            <td style="width: 10%">{{ $log->date }}
                                            </td>
                                            <td style="width: 10%">
                                                {{ $log->device->device_name}}</td>
                                            </td>
                                            <td style="width: 10%">
                                                {{ $log->device->room->room_name}}</td>
                                            </td>
                                            <td style="width: 10%">
                                                {{ $log->device->room->room_security_level}}</td>
                                            </td>
                                            @php
                                                $auhorized = false;
                                            @endphp
                                            @foreach ($log->user->rooms as $room)
                                                @if ($room->room_name == $log->device->room->room_name)
                                                    @php
                                                        $auhorized = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($auhorized)
                                                <td style="width: 10%"><span class="badge bg-success">authorized</span>
                                                @else
                                                <td style="width: 10%"><span
                                                        class="badge bg-danger">not-authorized</span>
                                            @endif
    
    
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @endif
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div>
            </div>


            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection