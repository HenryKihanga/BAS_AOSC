@extends('layouts/admin')
@push('scripts')
    <script>
        function populate_device_data_for_editing(device_token) {
            let base_url = '{{ url('') }}'
            let path = "/device/edit/" + device_token;
            let url = base_url + path
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    let device = result.device;
                    // Set data to the edit organization form
                    document.getElementById("currentDeviceToken").value = device.device_token;
                    document.getElementById("currentDeviceName").value = device.device_name;
                    document.getElementById("currentDeviceLocation").value = device.device_location;
                    document.getElementById("deviceNametoEdit").append(device.device_name);

                }
            });
        }

        function edit_device_details() {
            $('#editDeviceNameError').text('');
            $('#editDeviceLocationError').text('');
            let url = "{{ route('updateDevice') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editDeviceForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#modal-lg-editDevice").modal("hide");
                    //show confirmation message to user
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Device details has been updated succesfully'
                    });


                },
                error: function(response) {

                    $('#editDeviceNameError').text(response.responseJSON.errors.deviceName);
                    $('#editDeviceLocationError').text(response.responseJSON.errors.deviceLocation);

                }
            });
        }
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
                <a href="{{ route('overallLogs') }}" class="nav-link" onclick="toggle_active_class()">
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
                <a href="{{ route('deviceManage', Auth::user()->user_id) }}" class="nav-link active"
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


    {{-- ####################################################################################################################################################### --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Device Manage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
                        <li class="breadcrumb-item active">Device Manage</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @can('registerDevice')
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Device</h3>
                            </div><!-- /.card-header -->
                            <!-- form start -->
                            <form id="newDeviceForm" method="POST" action="{{ route('storeDevice') }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputDeviceToken">Device Token</label>
                                        <input type="text" name="deviceToken"
                                            class="form-control @error('deviceToken') in-valid @enderror"
                                            value="{{ old('deviceToken') }}" placeholder="Enter Device Token">
                                        @error('deviceToken')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="InputNameofDevice">Device Name</label>
                                        <input type="text" name="deviceName"
                                            class="form-control @error('deviceName') in-valid @enderror"
                                            value="{{ old('deviceName') }}" placeholder="Enter Device Name">
                                        @error('deviceName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDeviceType">Device Type</label>
                                        <select class="form-control" name="deviceType">
                                            <option value="fingerprint">fingerprint</option>
                                            <option value="rfid">rfid</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="InputLocationofDevice">Device Location</label>
                                        <input type="text" name="deviceLocation"
                                            class="form-control @error('deviceLocation') in-valid @enderror"
                                            value="{{ old('deviceLocation') }}" placeholder="Enter Device Location">
                                        @error('deviceLocation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputOrganization">Select Organization</label>
                                        <select class="form-control" name="organizationId">
                                            @foreach ($organizations as $organization)
                                                <option value="{{ $organization->organization_id }}">
                                                    {{ $organization->organization_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputOrganization">Select Branch</label>
                                        <select class="form-control" name="branchId">
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputOrganization">Select Department</label>
                                        <select class="form-control" name="departmentId">
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->department_id }}">
                                                    {{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                @endcan
                <!-- col -->
                <div class="col-md-9">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">List of Devices</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($devices) < 1)
                                There are no Device(s) registered

                            @else
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10%">Device Token</th>
                                            <th scope="col" style="width: 15%">Device Name</th>
                                            <th scope="col" style="width: 20%">Device Department</th>
                                            <th scope="col" style="width: 20%">Location</th>

                                            <th scope="col" style="width: 10%">mode</th>

                                            <th scope="col" style="width: 25%">.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $device)
                                            <tr>
                                                <td class="filterable-cell" style="width: 10%">
                                                    {{ $device->device_token }}
                                                </td>
                                                <td class="filterable-cell" style="width: 15%">{{ $device->device_name }}
                                                </td>
                                                <td class="filterable-cell" style="width: 20%">Department Name
                                                </td>
                                                <td class="filterable-cell" style="width: 20%">
                                                    {{ $device->device_location }}
                                                </td>

                                                <td class="tilterable-cell" style="width: 10%">
                                                    @if ($device->device_mode)
                                                        <div class="btn btn-success btn-sm filterable-cell m-1">Attendance
                                                        </div>
                                                    @else
                                                        <div class="btn btn-danger btn-sm filterable-cell m-1">Enrollment
                                                        </div>
                                                    @endif
                                                </td>

                                                <td class="text-right" style="width: 25%"> <a
                                                        class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i
                                                            class="fas fa-folder pr-1"> </i>View</a>
                                                    @can('editDevice')
                                                        <a class="btn btn-info btn-sm filterable-cell m-1"
                                                            onclick="populate_device_data_for_editing({{ $device->device_token }})"
                                                            data-toggle="modal" data-target="#modal-lg-editDevice"><i
                                                                class="fas fa-pencil-alt pr-1"> </i>Edit</a>
                                                    @endcan
                                                    @can('deleteDevice')
                                                        <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i
                                                                class="fas fa-trash pr-1"> </i>Delete</a>
                                                    @endcan
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->


        <div class="modal fade" id="modal-lg-editDevice">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="deviceNametoEdit">EDIT </h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div><!-- /.model-header-->
                    <div class="modal-body">
                        <div class="card">
                            <!--/. card-header -->
                            <div class="card-body">
                                <form id="editDeviceForm">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name of Device</label>
                                        <input id="currentDeviceToken" name="deviceToken" type="hidden">
                                        <input id="currentDeviceName" name="deviceName" type="text" class="form-control">
                                        <span class="text-danger" id="editDeviceNameError"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Device Location</label>
                                        <input id="currentDeviceLocation" name="deviceLocation" type="text"
                                            class="form-control">
                                        <span class="text-danger" id="editDeviceLocationError"></span>
                                    </div>
                                    {{-- <div class="form-group">
                                    <label for="InputOrganization">Select Organization</label>
                                    <select class="form-control inputOrganizations" id="InputOrganization"
                                        name="deviceOrganization">

                                    </select>
                                </div> --}}

                                </form><!-- /.form -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /.model-body-->
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-dark" onclick="edit_device_details()"><i
                                class="fas fa-save pr-2"></i>Submit</button>
                    </div><!-- /.model-footer-->
                </div><!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section>
    <!-- /.content -->
@endsection
