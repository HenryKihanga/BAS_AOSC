@extends('layouts/admin')
@push('scripts')
    <script>
        toggle_active_class()
    </script>

@endpush
@section('navitem')
    <nav class="mt-2 myNavtab">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
                <a href="{{ route('home', Auth::user()->user_id) }}" class="nav-link  active"
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
                <a href="{{ route('allUsers', Auth::user()->user_id) }}" class="nav-link  "
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fingerprintoverallLogs', Auth::user()->user_id) }}" class="nav-link" onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Fingerprint Logs
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rfidoverallLogs', Auth::user()->user_id) }}" class="nav-link" onclick="toggle_active_class()">
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
                <a href="{{ route('manageDepartment', Auth::user()->user_id) }}" class="nav-link"
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                        Departments
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('showRoomManage') }}" class="nav-link ">
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
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-edit"></i>
                    <p>
                        Edit Profile
                    </p>
                </a>
            </li> --}}
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
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('showAllRooms') }}">list of rooms</a></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('showAllRooms') }}">list of rooms</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Rooms</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    @if (count($rooms) < 1)
                        There are no room(s) which has been registered
                    @endif
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%">SN</th>
                                <th scope="col" style="width: 30%">Room Name</th>
                                <th scope="col" style="width: 30%">Device Installed</th>
                                <th scope="col" style="width: 30%">Security Level</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $sn = 0;
                            @endphp
                            @foreach ($rooms as $room)
                                @php
                                    $sn++;
                                @endphp
                                <tr>
                                    <td class="filterable-cell" style="width: 10%">{{ $sn }}</td>
                                    <td class="filterable-cell" style="width: 30%">{{ $room->room_name }}
                                    </td>
                                    @if ($room->device != null)
                                    <td class="filterable-cell" style="width: 30%">{{ $room->device->device_name }}  </td>
                                    @else
                                    <td class="filterable-cell" style="width: 30%"> NO DEVICE INSTALLED </td>
                                    @endif
                                    
                                  
                                    <td class="filterable-cell" style="width: 30%">
                                        {{ $room->room_security_level }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
            </div><!-- /.card -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
