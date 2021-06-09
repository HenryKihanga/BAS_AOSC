@extends('layouts.admin')
@push('scripts')
@endpush
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
            <a href="{{ route('overallLogs')}}" class="nav-link"
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
                <a href="{{ route('manageBranch', Auth::user()->user_id) }}" class="nav-link active"
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Branch Manage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Branch Manage</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- ################################################################################################################################################################### --}}


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @can('registerBranch')
                    <div class="col-md-3">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">Add New Branch</h3>
                            </div><!-- /.card-header -->
                            <form method="POST" action="{{ route('storeBranch') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputRegistrationNumber">Registration Number :</label>
                                        <input type="text" class="form-control @error('registrationNumber') in-valid @enderror"
                                            value="{{ old('registrationNumber') }}" placeholder="Enter Registration Number"
                                            name="registrationNumber">
                                        @error('registrationNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofRegistrationName">Registration Name :</label>
                                        <input type="text" class="form-control @error('registrationName') in-valid @enderror"
                                            value="{{ old('registrationName') }}" placeholder="Enter Registration Name"
                                            name="registrationName">
                                        @error('registrationName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofPhoneNumber">Phone Number :</label>
                                        <input type="text" class="form-control @error('phoneNumber') in-valid @enderror"
                                            value="{{ old('phoneNumber') }}" placeholder="Enter Phone Number"
                                            name="phoneNumber">
                                        @error('phoneNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofEmail">Email :</label>
                                        <input type="text" class="form-control @error('email') in-valid @enderror"
                                            value="{{ old('email') }}" placeholder="Enter Email" name="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofAddress">Address :</label>
                                        <input type="text" class="form-control @error('address') in-valid @enderror"
                                            value="{{ old('address') }}" placeholder="Enter Address" name="address">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputOrganization">Select Organization</label>
                                        <select class="form-control " name="organizationId">
                                            @foreach ($organizations as $organization)
                                                <option value="{{ $organization->organization_id }}">
                                                    {{ $organization->organization_name }}</option>

                                            @endforeach
                                        </select>

                                    </div>
                                </div> <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </div><!-- /.card-footer -->
                            </form><!-- /.form -->
                        </div><!-- /.card -->
                    </div> <!-- /.col -->
                @endcan
                <div class="col-md-9">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">List of Branches</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th scope="col">Reg Number</th>
                                        <th scope="col">Reg Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col" style="width: 20%">Email</th>
                                        <th scope="col" style="width: 10%">Address</th>
                                        <th scope="col" style="width: 25%">.</th>
                                    </tr>
                                </thead>
                                <tbody id="tableAllBranches">
                                    @if (count($branches) < 1)
                                    <tr> <td colspan="4">No Branch which has been Registered</td></tr>
                                        
                                    @else
                                    @foreach ($branches as $branch)
                                    <tr>
                                        <td class="filterable-cell">{{ $branch->branch_id }}</td>
                                        <td class="filterable-cell">{{ $branch->branch_name }}</td>
                                        <td class="filterable-cell">{{ $branch->branch_phone_number }}</td>
                                        <td class="filterable-cell" style="width: 20%">{{ $branch->branch_email }}
                                        </td>
                                        <td class="filterable-cell" style="width: 10%">{{ $branch->branch_address }}
                                        </td>
                                        <td class="project-actions text-right" style="width: 25%"> <a
                                                class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i
                                                    class="fas fa-folder pr-1"> </i>View</a>
                                            @can('editBranch')
                                                <a class="btn btn-info btn-sm filterable-cell m-1"
                                                    href="{{ route('editBranch', [$branch->branch_id]) }}"><i
                                                        class="fas fa-pencil-alt pr-1">
                                                    </i>Edit</a>
                                            @endcan
                                            @can('deleteBranch')
                                                <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i
                                                        class="fas fa-trash pr-1"> </i>Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                    @endif
                                    

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
