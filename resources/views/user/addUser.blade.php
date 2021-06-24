@extends('layouts.admin')
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            <a href="{{ route('addUser') }}" class="nav-link active" onclick="toggle_active_class()">
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
            <a href="{{ route('overallLogs')}}" class="nav-link "
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
                    <h1>Add User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">


            <!-- PRIMARY DETAILS CONTENT -->
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">New User Details</h3>
                </div>
                <form id="addUserForm" method="POST" action="{{ route('addUser') }}">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputFirstName">First Name</label>
                                    <input type="text" name="firstName" value="{{ old('firstName') }}"
                                        class="form-control @error('firstName') is-invalid @enderror" id="InputFirstName"
                                        placeholder="First Name">
                                    @error('firstName')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="InputMiddleName">Middle Name</label>
                                    <input type="text" name="middleName" value="{{ old('middleName') }}"
                                        class="form-control @error('middleName') is-invalid @enderror" id="InputMiddleName"
                                        placeholder="Middle Name">
                                    @error('middleName')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="InputLastName">Last Name</label>
                                    <input type="text" name="lastName" value="{{ old('lastName') }}"
                                        class="form-control @error('lastName') is-invalid @enderror" id="InputLastName"
                                        placeholder="Last Name">
                                    @error('lastName')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="InputStaffId">User ID</label>
                                    <input class="form-control @error('userID') is-invalid @enderror" name="userID"
                                        value="{{ old('userID') }}" type="number " placeholder="4223567" id="InputStaffId">
                                    @error('userID')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                        placeholder="Enter email">
                                    @error('email')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="InputPhoneNumber">Telephone</label>
                                    <input class="form-control @error('phoneNumber') is-invalid @enderror"
                                        name="phoneNumber" value="{{ old('phoneNumber') }}" type="tel"
                                        placeholder="+255654383729" id="InputPhoneNumber">
                                    @error('phoneNumber')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="InputBirthDate">Birth Date</label>

                                    <input class="form-control @error('birthDate') is-invalid @enderror" name="birthDate"
                                        value="{{ old('birthDate') }}" type="date" placeholder="2001-08-19"
                                        id="InputBirthDate">
                                    @error('birthDate')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputOrganization">Select Organization</label>
                                    <select class="form-control inputOrganizations " name="organizationId"
                                        id="InputOrganization">
                                        @foreach ($organizations as $organization)
                                            <option value="{{ $organization->organization_id }}">
                                                {{ $organization->organization_name }} </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="InputBranch">Select Branch</label>
                                    <select class="form-control inputBranches " name="branchId" id="InputBranch">
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->branch_id }}">
                                                {{ $branch->branch_name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputDepartment">Select Department</label>
                                    <select class="form-control inputDeparments " name="departmentId" id="InputDepartment">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->department_id }}">
                                                {{ $department->department_name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- checkbox -->
                                @can('isAdmin')
                                    <div class=" myCheckbox form-group row">
                                        <div>
                                            <label class="mylabel" for="">Choose Role</label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" value="1" name="roles[]">
                                                <span>admin</span>
                                            </label>
                                        </div>

                                        <div>
                                            <label>
                                                <input type="checkbox" value="2" name="roles[]">
                                                <span>organizationHead</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" value="3" name="roles[]">
                                                <span>branchHead</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" value="4" name="roles[]">
                                                <span>departmentHead</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="checkbox" value="5" name="roles[]">
                                                <span>staff</span>
                                            </label>
                                        </div>
                                    </div>
                                    @error('roles')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                @endcan
                                {{-- <div class="form-group">
                                <label for="exampleInputFile">Profile Picture</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div> --}}
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>
                <!-- /.card-body -->
                <!-- /.card-body -->

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
