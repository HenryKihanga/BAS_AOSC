@extends('layouts.admin')
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
                <a href="{{ route('allUsers', Auth::user()->user_id) }}" class="nav-link active "
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
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault();
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
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">USER INFORMATIONS</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td style="width: 30%"><b>Employee ID</b></td>
                                        <td style="width: 70%">{{ $user->user_id }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Full Name</b></td>
                                        <td style="width: 70%">{{ $user->first_name }} {{ $user->middle_name }}
                                            {{ $user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Organization</b></td>
                                        <td style="width: 70%">{{ $user->Organization->organization_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Branch</b></td>
                                        <td style="width: 70%">{{ $user->branch->branch_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Department</b></td>
                                        <td style="width: 70%">{{ $user->department->department_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Phone </b></td>
                                        <td style="width: 70%">{{ $user->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Fingerprint Device</b></td>
                                        <td style="width: 70%">
                                            @if ($user->fingerprintDevice == [])
                                                -
                                            @else
                                                {{ $user->fingerprintDevice->device_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>

                                        <td style="width: 30%; display:block"><b>Fingerprint Status</b></td>
                                        @if ($user->status->enrollment_status && !$user->status->ready_to_enroll)
                                            <td style="width: 70%"><span class="badge bg-success">Enrolled</span></td>
                                            <td style="width: 100%">
                                                <div class="small-box bg-light " style="width: 50%; height:100%">
                                                    <div class="inner">
                                                        <h3 class="text-success"><i class="far fa-check-circle"></i></h3>
                                                        <h6 class="text-success">Fingerprint Captured</h6><br>
                                                    </div>
                                                    <div class="icon text-success">
                                                        <i class="fas fa-fingerprint"></i>
                                                    </div>
                                                </div>
                                            </td>

                                        @elseif(!$user->status->enrollment_status && $user->status->ready_to_enroll)
                                            <td style="width: 70%"><span class="badge bg-info">Waiting...</span></td>
                                            <td style="width: 100%">
                                                <div class="small-box bg-light" style="width: 50%; height:100%">
                                                    <div class="inner">

                                                        <h6 class="text-danger">Waiting User to...</h6>
                                                        <h6 class="text-danger">Press Finger onto Device for enrollment</h6>
                                                        <br>
                                                    </div>
                                                    <div class="icon ">
                                                        <i class="fas fa-fingerprint"></i>
                                                    </div>

                                                </div>
                                            </td>
                                        @else
                                            <td style="width: 70%"><span class="badge bg-danger">Not-enrolled</span></td>
                                        @endif


                                    </tr>
                                </tbody>
                            </table>
                            @error('duplicateReadyToEnroll')
                                <div class="alert alert-danger p-2">
                                    <span class="">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('duplicateReadyToAddCard')
                                <div class="alert alert-danger p-2">
                                    <span class="">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('noroomselected')
                            <div class="alert alert-danger p-2">
                                <span class="">{{ $message }}</span>
                            </div>
                        @enderror
                            


                        </div>
                        <div class="col-lg-6 col-12">
                            <table class="table table-bordered">
                                <tbody>

                                    <tr>
                                        <td style="width: 30%"><b>Finger ID</b></td>
                                        <td style="width: 70%">
                                            @if ($user->status->fingerprint_id == [])
                                                -
                                            @endif
                                            {{ $user->status->fingerprint_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Card ID</b></td>
                                        <td style="width: 70%">
                                            @if ($user->status->card_uid == [])
                                                -
                                            @endif
                                            {{ $user->status->card_uid }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Email</b></td>
                                        <td style="width: 70%">{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Date of Birth</b></td>
                                        <td style="width: 70%">{{ $user->birth_date }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Gender</b></td>
                                        <td style="width: 70%">Mail</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>RFID Device</b></td>
                                        <td style="width: 70%">
                                            @if ($user->rfidDevice == [])
                                                -
                                            @else
                                                {{ $user->rfidDevice->device_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Role(s)</b></td>
                                        <td style="width: 70%">
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }},
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Room(s)</b></td>
                                        <td style="width: 70%">
                                            @foreach ($user->rooms as $room)
                                                {{ $room->room_name }},
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr>

                                        <td style="width: 30%; display:block"><b>Card Status</b></td>
                                        @if ($user->status->card_registered)
                                            <td style="width: 70%"><span class="badge bg-success">card registered</span>
                                            </td>
                                            <td style="width: 100%">
                                                <div class="small-box bg-light " style="width: 50%; height:100%">
                                                    <div class="inner">
                                                        <h3 class="text-success"><i class="far fa-check-circle"></i></h3>
                                                        <h6 class="text-success">Card Added</h6><br>
                                                    </div>
                                                    <div class="icon text-success">
                                                        <i class="fas fa-id-card"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        @elseif($user->status->ready_to_add_card){
                                            <td style="width: 70%"><span class="badge bg-info">Waiting ..</span>
                                            </td>
                                            <td style="width: 100%">
                                                <div class="small-box bg-light " style="width: 50%; height:100%">
                                                    <div class="inner">
                                                        <h6 class="text-info">Waiting User to...</h6>
                                                        <h6 class="text-info">Swip card for succesful enrollment</h6>
                                                    </div>
                                                    <div class="icon text-info">
                                                        <i class="fas fa-id-card"></i>
                                                    </div>
                                                </div>
                                            </td>

                                            }
                                        @else
                                            <td style="width: 70%"><span class="badge bg-danger">card not-registered</span>
                                            </td>
                                        @endif


                                    </tr>

                                </tbody>
                            </table>
                            @error('cardfound')
                                <div class="alert alert-danger p-2">
                                    <span class="">{{ $message }}</span>
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix ">
                    <button type="button" class="btn btn-outline-info mr-2">Edit</button>
                    <a href="{{ route('deleteUser', $user->user_id) }}"><button type="button"
                            class="btn btn-outline-danger mr-2">Delete</button></a>
                    @if (!$user->status->enrollment_status && !$user->status->ready_to_enroll)
                        <button type="button" class="btn btn-dark" data-toggle="collapse"
                            data-target="#fingerprintEnrollUser" aria-expanded="false"
                            aria-controls="fingerprintEnrollUser">Fingerprint Enroll User </button>
                    @else
                        <a href="{{ route('userSpecificLogs', $user->user_id) }}"><button type="button"
                                class="btn btn-outline-dark mr-2">View Logs</button></a>
                    @endif
                    @if ($user->status->enrollment_status && !$user->status->ready_to_enroll && !$user->status->card_registered)
                        <a
                            onclick="event.preventDefault();
                                                                                  document.getElementById('rfid-enroll-form').submit();">
                            <button type="submit" class="btn btn-dark">RFID Enroll User</button>
                        </a>
                        <form id="rfid-enroll-form" action="{{ route('rfidEnroll') }}" method="POST" class="d-none">
                            <input type="hidden" name="userId" value="{{ $user->user_id }}">
                        </form>
                    @endif
                    @if ($user->status->enrollment_status && !$user->status->ready_to_enroll && $user->status->card_registered)
                        <button type="button" class="btn btn-dark" data-toggle="collapse" data-target="#assignRoom"
                            aria-expanded="false" aria-controls="assignRoom">Register Authorized Areas</button>
                    @endif
                </div>
            </div>


            {{-- COLLAPSE FOR FINGER ENROLLMENT --}}
            <div class="card collapse multi-collapse" id="fingerprintEnrollUser">
                <form action="{{ route('fingerprintEnroll') }}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <input type="hidden" name="userId" class="col-sm-8 form-control"
                                        value="{{ $user->user_id }}">
                                    <label>Fingerprint Id :</label>
                                    <input type="text" name="fingerPrintId"
                                        class="form-control @error('fingerPrintId') in-valid @enderror"
                                        value="{{ old('fingerPrintId') }}" placeholder="Enter Finger Id">
                                    @error('fingerPrintId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Device :</label>
                                    <select class="form-control " name="deviceId">
                                        @foreach ($devices as $device)
                                            @if ($device->device_type == 'fingerprint')
                                                <option value="{{ $device->device_token }}">{{ $device->device_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix ">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
            {{-- COLLAPSE FOR RFID ENROLLMENT --}}
            <div class="card collapse multi-collapse" id="rfidEnrollUser">
                <form action="{{ route('rfidEnroll') }}" method="POST">
                    <div class="card-body">

                        <div class="form-group row">
                            <input type="hidden" name="userId" value="{{ $user->user_id }}">
                            <div class="col-4"><label>Device :</label></div>

                            <div class="col-8"> <select class="form-control " name="deviceId">
                                    @foreach ($devices as $device)
                                        @if ($device->device_type == 'rfid')
                                            <option value="{{ $device->device_token }}">
                                                {{ $device->device_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select></div>

                        </div>

                    </div>
                    <div class="card-footer clearfix ">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>

            {{-- //COLLAPSE FOR ROOM ASSIGNMENT --}}
            <div>
                <form method="POST" action="{{ route('registerAuthorizedRooms') }}">
                    <div class="card collapse multi-collapse" id="assignRoom">
                        <div class="card-header">

                            <div class="card-tools">
                                <button type="submit" class="btn btn-dark">Submit Room(s) Details</button>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <input type="hidden" name="userId" class="col-sm-8 form-control"
                                    value="{{ $user->user_id }}">
                                <label for="exampleFormControlSelect2">Select Room(s) this Employee is authorized</label>
                                <select multiple class="form-control" id="exampleFormControlSelect2" name="rooms[]">
                                    @foreach ($rooms as $room)
                                        @if ($device->device_type == 'rfid')
                                            <option value="{{ $room->room_id }}">{{ $room->room_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>
    </section>
@endsection
