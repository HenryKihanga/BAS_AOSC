@extends('layouts.admin')
@push('scripts')
@endpush
@section('navitem')
<nav class="mt-2 myNavtab">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item ">
            <a href="{{ route('home', Auth::user()->user_id) }}" class="nav-link  active" onclick="toggle_active_class()">
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
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('unenrolledUser', Auth::user()->user_id) }}">list of unenrolled users</a></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('unenrolledUser', Auth::user()->user_id) }}">list of unenrolled users</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Not Enrolled Users</h3>
                </div>
                @if (count($users) < 0)
                    No data found
                @else
                    <div class="card-body p-0" style="max-height: 80%;">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 10%">
                                        User ID
                                    </th>
                                    <th style="width: 20%">
                                        Avatar/ User Name
                                    </th>
                                    <th style="width: 20%">
                                        Organization
                                    </th>
                                    <th style="width: 15%">
                                        Branch
                                    </th>
                                    <th style="width: 10%">
                                        Department
                                    </th>
                                    <th style="width: 10%" class="text-center">
                                        Fingerprint Status
                                    </th>
                                    <th style="width: 10%" class="text-center">
                                        Card Status
                                    </th>
                                    <th style="width: 5%">.</th>

                                </tr>

                            </thead>
                            <tbody id="tableAllUsers">
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="width: 10%">{{ $user->user_id }}</td>
                                        <td style="width: 20%">
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><img alt="Avatar" class="table-avatar mr-2"
                                                        src="{{ asset('template/dist/img/avatar-default.jpg') }}"></li>
                                                <li class="list-inline-item">{{ $user->first_name }}
                                                    {{ $user->last_name }}</li>
                                            </ul>
                                        </td>
                                        <td style="width: 20%">{{$user->organization->organization_name}}</td>
                                        <td style="width: 15%">{{$user->branch->branch_name}}</td>
                                        <td style="width: 10%">{{$user->department->department_name}}</td>
                                        <td class="project-state" style="width: 10%">
                                            @if ($user->status->enrollment_status && !$user->status->ready_to_enroll)
                                                <span class="badge bg-success">Enrolled</span>
                                            @elseif(!$user->status->enrollment_status && $user->status->ready_to_enroll)
                                                <span class="badge bg-info">Waiting...</span>
                                            @else
                                                <span class="badge bg-danger">Not-enrolled</span>
                                            @endif
                                        </td>
                                        <td class="project-state" style="width: 10%">
                                            @if ($user->status->card_registered)
                                                <span class="badge bg-success">Card added</span>
             
                                            @else
                                                <span class="badge bg-danger">Card not-added</span>
                                            @endif
                                        </td>
                                        <td class="clickable-btn" style="width: 5%"> <a
                                                href="{{ route('showUserDetails', [$user->user_id]) }}"><i
                                                    class="fas fa-cogs"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                       <a href="{{ route('exportAllUsers') }}"> <button type="button" class="btn btn-success">Export</button></a>
                    </div>
                    <!-- /.card-body -->
                @endif

            </div>
            <!-- /.card -->
        </div>


    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
