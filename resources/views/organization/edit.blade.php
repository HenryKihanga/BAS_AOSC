@extends('layouts/admin')
@push('scripts')

    <script>
        function add_branch_then_exit() {
            //delete error message
            $('#addBranchRegistrationNumberError').text('');
            $('#addBranchNameError').text('');
            $('#addBranchPhoneNumberError').text('');
            $('#addBranchEmailError').text('');
            $('#addBranchAddressError').text('');
            let url = "{{ route('storeBranch') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#modal-lg-addBranch").modal("hide"); //close model after succesful branch creation
                    //clear form fields
                    $('#addBranchRegistrationNumber').val('');
                    $('#addBranchName').val('');
                    $('#addBranchPhoneNumber').val('');
                    $('#addBranchEmail').val('');
                    $('#addBranchAddress').val('');
              
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Branch have been succesfully added to this Organization'
                    });
                },
                error: function(response) {
                    $('#addBranchRegistrationNumberError').text(response.responseJSON.errors
                        .registrationNumber);
                    $('#addBranchNameError').text(response.responseJSON.errors.registrationName);
                    $('#addBranchPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#addBranchEmailError').text(response.responseJSON.errors.email);
                    $('#addBranchAddressError').text(response.responseJSON.errors.address);

                }
            });
        }

        function add_branch_then_continue() {
            $('#addBranchRegistrationNumberError').text('');
            $('#addBranchNameError').text('');
            $('#addBranchPhoneNumberError').text('');
            $('#addBranchEmailError').text('');
            $('#addBranchAddressError').text('');
            let url = "{{ route('storeBranch') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('addBranchRegistrationNumber').value = '';
                    document.getElementById('addBranchName').value = '';
                    document.getElementById('addBranchPhoneNumber').value = '';
                    document.getElementById('addBranchEmail').value = '';
                    document.getElementById('addBranchAddress').value = '';
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Branch have been succesfully added to this Organization'
                    });
                },
                error: function(response) {

                    $('#addBranchRegistrationNumberError').text(response.responseJSON.errors
                        .registrationNumber);
                    $('#addBranchNameError').text(response.responseJSON.errors.registrationName);
                    $('#addBranchPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#addBranchEmailError').text(response.responseJSON.errors.email);
                    $('#addBranchAddressError').text(response.responseJSON.errors.address);

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
                <a href="{{ route('manageOrganization', Auth::user()->user_id) }}" class="nav-link active"
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
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Organization</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Organization</li>
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
                    <form id="editOrganizationForm" method="POST" action="{{ route('updateOrganization') }}">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" id="organizationNametoEdit">EDIT
                                    {{ $organization->organization_name }} ORGANIZATION </h3>
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
                                            <input name="registrationNumber" type="hidden"
                                                value="{{ $organization->organization_id }}">
                                            <label>Name of Organization</label>
                                            <input id="currentOrganizationname" name="registrationName" type="text"
                                                class="form-control @error('registrationName') in-valid @enderror"
                                                value="{{ $organization->organization_name }}">
                                            @error('registrationName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input id="currentOrganizationnumber" name="phoneNumber" type="text"
                                                class="form-control @error('phoneNumber') in-valid @enderror"
                                                value="{{ $organization->organization_phone_number }}">
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
                                            <input id="currentOrganizationemail" name="email" type="text"
                                                class="form-control @error('email') in-valid @enderror"
                                                value="{{ $organization->organization_email }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input id="currentOrganizationaddress" name="address" type="text"
                                                class="form-control @error('address') in-valid @enderror"
                                                value="{{ $organization->organization_address }}">

                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark " onclick="">Submit</button>
                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                    data-target="#modal-lg-addBranch">Add
                                    Branch</button>
                            </div><!-- /.card-footer -->
                        </div><!-- /.card -->
                    </form>
                </div><!-- /.col -->

            </div> <!-- /.row -->
        </div><!-- /.edit organization form content fluid-->


        <div class="modal fade" id="modal-lg-addBranch">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="organizationNametoAddBranch">ADD BRANCH FOR
                            {{ $organization->organization_name }} ORGANIZATION</h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div><!-- /.model-header-->
                    <div class="modal-body">
                        <div class="card card-primary ">
                            <div class="card-body">
                                <form id="addBranchForm">
                                    @csrf
                                    <div class="form-group">
                                        <input value={{ $organization->organization_id }} name="organizationId"
                                            type="hidden">
                                        <label for="InputRegistrationNumber">Registration Number :</label>
                                        <input type="text" class="form-control" id="addBranchRegistrationNumber"
                                            placeholder="Enter Registration Number" name="registrationNumber">
                                        <span class="text-danger" id="addBranchRegistrationNumberError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofRegistrationName">Registration Name :</label>
                                        <input type="text" class="form-control" id="addBranchName"
                                            placeholder="Enter Registration Name" name="registrationName">
                                        <span class="text-danger" id="addBranchNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofPhoneNumber">Phone Number :</label>
                                        <input type="text" class="form-control" id="addBranchPhoneNumber"
                                            placeholder="Enter Phone Number" name="phoneNumber">
                                        <span class="text-danger" id="addBranchPhoneNumberError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofEmail">Email :</label>
                                        <input type="text" class="form-control" id="addBranchEmail"
                                            placeholder="Enter Email" name="email">
                                        <span class="text-danger" id="addBranchEmailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofAddress">Address :</label>
                                        <input type="text" class="form-control" id="addBranchAddress"
                                            placeholder="Enter Address" name="address">
                                        <span class="text-danger" id="addBranchAddressError"></span>
                                    </div>
                                </form><!-- /.form -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /.model-body-->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" onclick="add_branch_then_exit()"><i
                                class="fas fa-save pr-2"></i>Submit and Exit</button>
                        <button type="button" class="btn btn-dark" onclick="add_branch_then_continue()"><i
                                class="fas fa-plus-circle pr-2"></i>Submit and Continue</button>
                    </div><!-- /.model-footer-->
                </div><!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </section>
    <!-- /.content -->
@endsection
