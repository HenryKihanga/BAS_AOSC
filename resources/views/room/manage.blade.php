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
                <a href="{{ route('home', Auth::user()->user_id) }}" class="nav-link  " onclick="toggle_active_class()">
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
                <a href="{{ route('manageDepartment', Auth::user()->user_id) }}" class="nav-link"
                    onclick="toggle_active_class()">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                        Departments
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('showRoomManage') }}" class="nav-link active">
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
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Room Manage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Room Manage</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Department</h3>
                        </div><!-- /.card-header -->
                        <form id="newRoomForm" method="POST" action="{{ route('storeRoom') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputRoomId">Room ID :</label>
                                    <input type="text" class="form-control @error('roomId') @enderror"
                                        value="{{ old('roomId') }}" placeholder="Enter Room ID" name="roomId">
                                    @error('roomId')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="InputRoomName">Room Name :</label>
                                    <input type="text" class="form-control @error('roomName') @enderror"
                                        value="{{ old('roomName') }}" placeholder="Enter Room Name" name="roomName">
                                    @error('roomName')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="InputRoomSecurityStatus">Security Status</label>
                                    <select class="form-control" name="roomSecurity">
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="SENSITIVE">SENSITIVE</option>
                                    </select>
                                </div>
                            </div> <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Submit</button>
                            </div><!-- /.card-footer -->

                        </form><!-- /.form -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->

                <div class="col-md-8">
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
                                            <th scope="col" style="width: 33%">Room Number</th>
                                            <th scope="col" style="width: 33%">Room Name</th>
                                            <th scope="col" style="width: 34%">Security Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rooms as $room)
                                            <tr>
                                                <td class="filterable-cell" style="width: 33%">{{ $room->room_id }}</td>
                                                <td class="filterable-cell" style="width: 33%">{{ $room->room_name }}
                                                </td>
                                                <td class="filterable-cell" style="width: 34%">
                                                    {{  $room->room_security_level }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
