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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                        <div class="card card-primary">
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
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                @endcan
                <!-- col -->
                <div class="col-md-9">
                    <div class="card card-primary">
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
                                            <th scope="col" style="width: 10%">Device Name</th>
                                            <th scope="col" style="width: 20%">Device Department</th>
                                            <th scope="col" style="width: 15%">Location</th>
                                            @can('changeDeviceMode')
                                                <th scope="col" style="width: 25% ">mode</th>
                                            @endcan
                                            <th scope="col" style="width: 20%">.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $device)
                                            <tr>
                                                <td class="filterable-cell" style="width: 10%">
                                                    {{ $device->device_token }}
                                                </td>
                                                <td class="filterable-cell" style="width: 10%">{{ $device->device_name }}
                                                </td>
                                                <td class="filterable-cell" style="width: 20%">Department Name
                                                </td>
                                                <td class="filterable-cell" style="width: 15%">
                                                    {{ $device->device_location }}
                                                </td>
                                                @can('changeDeviceMode')
                                                    <td class="text-right" style="width: 20%">
                                                        @if ($device->device_mode)
                                                            <a class="btn btn-success btn-sm filterable-cell m-1"
                                                                href="{{ route('changeDeviceMode', ['token' => $device->device_token, 'mode' => 1]) }}">Attendance</a>
                                                            <a class="btn btn-danger btn-sm filterable-cell m-1"
                                                                href="{{ route('changeDeviceMode', ['token' => $device->device_token, 'mode' => 0]) }}">Enrollment</a>
                                                        @else
                                                            <a class="btn btn-danger btn-sm filterable-cell m-1"
                                                                href="{{ route('changeDeviceMode', ['token' => $device->device_token, 'mode' => 1]) }}">Attendance</a>
                                                            <a class="btn btn-success btn-sm filterable-cell m-1"
                                                                href="{{ route('changeDeviceMode', ['token' => $device->device_token, 'mode' => 0]) }}">Enrollment</a>
                                                        @endif
                                                    </td>
                                                @endcan
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
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="deviceNametoEdit">EDIT </h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div><!-- /.model-header-->
                    <div class="modal-body">
                        <div class="card card-primary ">
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
                        <button type="button" class="btn btn-primary" onclick="edit_device_details()"><i
                                class="fas fa-save pr-2"></i>Submit</button>
                    </div><!-- /.model-footer-->
                </div><!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section>
    <!-- /.content -->
@endsection
