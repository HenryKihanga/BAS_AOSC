@extends('layouts/admin')
@push('scripts')
    <script>
        function add_department_then_exit() {
            $('#addDepartmentRegistrationNumberError').text('');
            $('#addDepartmentNameError').text('');
            $('#addDepartmentPhoneNumberError').text('');
            $('#addDepartmentEmailError').text('');
            $('#addDepartmentAddressError').text('');
            let url = "{{ route('storeDepartment') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addDepartmentForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#modal-lg-addDepartment").modal("hide");
                    $('#InputDepartmentRegistrationName').val('');
                    $('#InputDepartmentPhoneNumber').val('');
                    $('#InputDepartmentNumber').val('');
                    $('#InputDepartmentEmail').val('');
                    $('#InputDepartmentAddress').val('');
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Department have been succesfully added to this Branch'
                    });
                },
                error: function(response) {
                    $('#addDepartmentRegistrationNumberError').text(response.responseJSON.errors
                        .registrationNumber);
                    $('#addDepartmentNameError').text(response.responseJSON.errors.registrationName);
                    $('#addDepartmentPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#addDepartmentEmailError').text(response.responseJSON.errors.email);
                    $('#addDepartmentAddressError').text(response.responseJSON.errors.address);

                }
            });
        }

        function add_department_then_continue() {
            $('#addDepartmentRegistrationNumberError').text('');
            $('#addDepartmentNameError').text('');
            $('#addDepartmentPhoneNumberError').text('');
            $('#addDepartmentEmailError').text('');
            $('#addDepartmentAddressError').text('');
            let url = "{{ route('storeDepartment') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addDepartmentForm')),
                contentType: false,
                processData: false,
                success: function(res) {

                    $('#InputDepartmentNumber').val('');
                    $('#InputDepartmentRegistrationName').val('');
                    $('#InputDepartmentPhoneNumber').val('');
                    $('#InputDepartmentEmail').val('');
                    $('#InputDepartmentAddress').val('');
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Department have been succesfully added to this Branch'
                    });
                },
                error: function(response) {
                    $('#addDepartmentRegistrationNumberError').text(response.responseJSON.errors
                        .registrationNumber);
                    $('#addDepartmentNameError').text(response.responseJSON.errors.registrationName);
                    $('#addDepartmentPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#addDepartmentEmailError').text(response.responseJSON.errors.email);
                    $('#addDepartmentAddressError').text(response.responseJSON.errors.address);

                }
            });
        }

    </script>
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
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Branch</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Branch</li>
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
                <div class="col-lg-12">
                    <form id="editBranchForm" method="POST" action="{{ route('updateBranch') }}">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" id="branchNametoEdit">EDIT {{ $branch->branch_name }} BRANCH </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <input value="{{ $branch->branch_id }}" name="registrationNumber"
                                                type="hidden">
                                            <label>Name of Branch</label>
                                            <input value="{{ $branch->branch_name }}" name="registrationName" type="text"
                                                class="form-control @error('registrationName') in-valid @enderror">
                                            @error('registrationName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input value="{{ $branch->branch_phone_number }}" name="phoneNumber"
                                                type="text" class="form-control @error('phoneNumber') in-valid @enderror">
                                            @error('phoneNumber')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input value="{{ $branch->branch_email }}" name="email" type="text"
                                                class="form-control @error('email') in-valid @enderror">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input value="{{ $branch->branch_address }}" name="address" type="text"
                                                class="form-control @error('address') in-valid @enderror">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark" onclick="editBranch()">Submit</button>
                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                    data-target="#modal-lg-addDepartment">Add
                                    Department</button>
                            </div><!-- /.card-footer -->
                        </div><!-- /.card -->
                    </form>
                </div><!-- /.col -->

            </div> <!-- /.row -->
        </div><!-- /.edit organization form content fluid-->
        <div class="modal fade" id="modal-lg-addDepartment">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title " id="branchNametoAddOrganization">ADD DEPARTMENT FOR {{ $branch->branch_name }} BRANCH </h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div><!-- /.model-header-->
                    <div class="modal-body">
                        <div class="card card-primary ">

                            <!--/. card-header -->
                            <div class="card-body">
                                <form id="addDepartmentForm">
                                    @csrf
                                    <div class="form-group">
                                        <input value="{{ $branch->branch_id }}" name="branchId" type="hidden">
                                        <label for="InputRegistrationNumber">Registration Number :</label>
                                        <input type="text" class="form-control" id="InputDepartmentNumber"
                                            placeholder="Enter Registration Number" name="registrationNumber">
                                        <span class="text-danger" id="addDepartmentRegistrationNumberError"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofRegistrationName">Registration Name :</label>
                                        <input type="text" class="form-control" id="InputDepartmentRegistrationName"
                                            placeholder="Enter Registration Name" name="registrationName">
                                        <span class="text-danger" id="addDepartmentNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofPhoneNumber">Phone Number :</label>
                                        <input type="text" class="form-control" id="InputDepartmentPhoneNumber"
                                            placeholder="Enter Phone Number" name="phoneNumber">
                                        <span class="text-danger" id="addDepartmentPhoneNumberError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofEmail">Email :</label>
                                        <input type="text" class="form-control" id="InputDepartmentEmail"
                                            placeholder="Enter Email" name="email">
                                        <span class="text-danger" id="addDepartmentEmailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofAddress">Address :</label>
                                        <input type="text" class="form-control" id="InputDepartmentAddress"
                                            placeholder="Enter Address" name="address">
                                        <span class="text-danger" id="addDepartmentAddressError"></span>
                                    </div>
                                </form><!-- /.form -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /.model-body-->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" onclick="add_department_then_exit()"><i
                                class="fas fa-save pr-2"></i>Submit and Exit</button>
                        <button type="button" class="btn btn-dark" onclick="add_department_then_continue()"><i
                                class="fas fa-plus-circle pr-2"></i>Submit and Continue</button>
                    </div><!-- /.model-footer-->
                </div><!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endsection









































</section>
<!-- /.content -->
