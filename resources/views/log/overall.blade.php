@extends('layouts.admin')
@section('navitem')
<nav class="mt-2 myNavtab">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
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
            <a href="{{ route('overallLogs')}}" class="nav-link active"
                onclick="toggle_active_class()">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    User Logs
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
            <a href="{{ route('changePassword') }}" class="nav-link " onclick="toggle_active_class()">
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
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Logs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Logs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
           
            <div class="row">
                <div class="col-12">
                  <div class="card">
                     
                      <div class="card-header">
                        <h3 class="card-title">User Logs Table</h3>
        
                        <div class="card-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
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
                              <th style="width: 10%">ID</th>
                              <th style="width: 30%">Username</th>
                              <th style="width: 15%">Time-in</th>
                              <th style="width: 15%">Time-out</th>
                              <th style="width: 15%">Date</th>
                              <th style="width: 15%">Status</th>
                            </tr>
                          </thead>
                          @if ($type == 1)
                          <tbody>
                            @foreach ($logs as $log)
                          <tr>
                            <td style="width: 10%">{{$log->user_id}}</td>
                            <td style="width: 30%">{{$log->user->first_name}} {{$log->user->middle_name}} {{$log->user->last_name}}</td>
                            <td style="width: 15%">{{$log->time_in}}</td>
                            <td style="width: 15%">{{$log->time_out}}</td>
                            <td style="width: 15%">{{$log->date}}</td>
                            <td><span class="badge bg-success">On-time</span></td>
                            @endforeach
                          </tr>
                        </tbody>
                          @else
                          <tbody>
                            @foreach ($logs as $log)
                          <tr>
                            <td style="width: 10%">{{$log->user_id}}</td>
                            <td style="width: 30%">{{$log->first_name}} {{$log->middle_name}} {{$log->last_name}}</td>
                            <td style="width: 15%"> - </td>
                            <td style="width: 15%"> - </td>
                            <td style="width: 15%">{{ date('Y-m-d') }}</td>
                            <td><span class="badge bg-danger">Absente</span></td>
                            @endforeach
                          </tr>
                        </tbody> 
                          @endif
                      
                        </table>
                        @endif
                      </div> <!-- /.card-body --> 
                  </div> <!-- /.card -->
                </div>
              </div>
        </div>
    </section>
@endsection
