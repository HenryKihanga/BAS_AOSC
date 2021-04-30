@push('scripts')
    <script>
        function new_device() {
            let url = "{{ route('storeDevice') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('newDeviceForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('newDeviceForm').reset();
                     //show confirmation message to user
                     var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'New Device has been added succesfully'
                    });
                    $('#tableDataDevice').html();
                    let device = res.newDevice;
                    if (device.device_mode) {
                        $('#tableDataDevice').prepend(
                            '<tr> <td class="filterable-cell" style="width: 10%">' +
                            device.device_token +
                            '</td> <td class="filterable-cell" style="width: 10%">' +
                            device.device_name +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            device.organization_id +
                            '</td> <td class="filterable-cell" style="width: 15%">' +
                            device.device_location +
                            '</td> <td class="text-right" style="width: 25%"> <a class="btn btn-success btn-sm filterable-cell m-1" onclick="attendance_mode(456456)"><i class="fas fa-folder pr-1"> </i>Attendance</a>' +
                            '<a class="btn btn-danger btn-sm filterable-cell m-1" onclick="enrollment_mode(456456)"><i class="fas fa-pencil-alt pr-1"> </i>Enrollment</a>' +
                            '</td> <td class="text-right" style="width: 20%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="populate_device_data_for_editing(' +
                            device.device_token +
                            ')" data-toggle="modal" data-target="#modal-lg-editDevice"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                            ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                        );
                    } else {
                        $('#tableDataDevice').prepend(
                            '<tr> <td class="filterable-cell" style="width: 10%">' +
                            device.device_token +
                            '</td> <td class="filterable-cell" style="width: 10%">' +
                            device.device_name +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            device.organization_id +
                            '</td> <td class="filterable-cell" style="width: 15%">' +
                            device.device_location +
                            '</td> <td class="text-right" style="width: 25%"> <a class="btn btn-danger btn-sm filterable-cell m-1" onclick="attendance_mode(456456)"><i class="fas fa-folder pr-1"> </i>Attendance</a>' +
                            '<a class="btn btn-success btn-sm filterable-cell m-1" onclick="enrollment_mode(456456)"><i class="fas fa-pencil-alt pr-1"> </i>Enrollment</a>' +
                            '</td> <td class="text-right" style="width: 20%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="populate_device_data_for_editing(' +
                            device.device_token +
                            ')" data-toggle="modal" data-target="#modal-lg-editDevice"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                            ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                        );
                    }
                }
            });
        }

        function query_all_devices() {
            let url = "{{ route('showAllDevices') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                   
                    $('#tableDataDevice').html('');
                    if (res.devices.length < 1) {
                        $('#tableDataDevice').text('There is no devices Registered')
                    }
                    res.devices.map(device => {
                        if (device.device_mode) {
                            $('#tableDataDevice').prepend(
                                '<tr> <td class="filterable-cell" style="width: 10%">' +
                                device.device_token +
                                '</td> <td class="filterable-cell" style="width: 10%">' +
                                device.device_name +
                                '</td> <td class="filterable-cell" style="width: 20%">' +
                                device.organization_id +
                                '</td> <td class="filterable-cell" style="width: 15%">' +
                                device.device_location +
                                '</td> <td class="text-right" style="width: 25%"> <a class="btn btn-success btn-sm filterable-cell m-1" onclick="change_mode_to_attendance('+device.device_token+')"><i class="fas fa-folder pr-1"> </i>Attendance</a>' +
                                '<a class="btn btn-danger btn-sm filterable-cell m-1" onclick="change_mode_to_enrollement('+device.device_token+')"><i class="fas fa-pencil-alt pr-1"> </i>Enrollment</a>' +
                                '</td> <td class="text-right" style="width: 20%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                                '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="populate_device_data_for_editing(' +
                                device.device_token +
                                ')" data-toggle="modal" data-target="#modal-lg-editDevice"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                                ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                            );
                        } else {
                            $('#tableDataDevice').prepend(
                                '<tr> <td class="filterable-cell" style="width: 10%">' +
                                device.device_token +
                                '</td> <td class="filterable-cell" style="width: 10%">' +
                                device.device_name +
                                '</td> <td class="filterable-cell" style="width: 20%">' +
                                device.organization_id +
                                '</td> <td class="filterable-cell" style="width: 15%">' +
                                device.device_location +
                                '</td> <td class="text-right" style="width: 25%"> <a class="btn btn-danger btn-sm filterable-cell m-1" onclick="change_mode_to_attendance('+device.device_token+')"><i class="fas fa-folder pr-1"> </i>Attendance</a>' +
                                '<a class="btn btn-success btn-sm filterable-cell m-1" onclick="change_mode_to_enrollement('+device.device_token+')"><i class="fas fa-pencil-alt pr-1"> </i>Enrollment</a>' +
                                '</td> <td class="text-right" style="width: 20%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                                '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="populate_device_data_for_editing(' +
                                device.device_token +
                                ')" data-toggle="modal" data-target="#modal-lg-editDevice"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                                ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                            );
                        }

                    });
                }
            });
        }

        function populate_device_data_for_editing(device_id) {
            let base_url = '{{ url('') }}'
            let path = "/device/showOne/" + device_id;
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
            let url = "{{ route('updateDevice') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editDeviceForm')),
                contentType: false,
                processData: false,
                success: function(res) {
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
                    show_device_manage();

                }
            });
        }

        function enrollment_mode(device_token) {
           
            let base_url = '{{ url('') }}'
            let path = "/device/changeMode/" + device_token;
            let url = base_url + path
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'device_mode': 0
                },
                // contentType: false,
                // processData: false,
                success: function(res) {
                    query_all_devices();
                   

                }
            });
        }

        function attendance_mode(device_token) {
            let base_url = '{{ url('') }}'
            let path = "/device/changeMode/" + device_token;
            let url = base_url + path
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'device_mode': 1
                },
                // contentType: false,
                // processData: false,
                success: function(res) {
                    query_all_devices();
                    

                }
            });
        }

    </script>
@endpush
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
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Device</h3>
                    </div><!-- /.card-header -->
                    <!-- form start -->
                    <form id="newDeviceForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputDeviceToken">Device Token</label>
                                <input type="text" name="deviceToken" class="form-control" id="InputDeviceToken"
                                    placeholder="Enter Device Token">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofDevice">Device Name</label>
                                <input type="text" name="deviceName" class="form-control" id="InputNameofDevice"
                                    placeholder="Enter Device Name">
                            </div>
                            <div class="form-group">
                                <label for="InputOrganization">Select Organization</label>
                                <select class="form-control inputOrganizations" id="InputOrganization"
                                    name="organizationId">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputLocationofDevice">Device Location</label>
                                <input type="text" name="deviceLocation" class="form-control" id="InputLocationofDevice"
                                    placeholder="Enter Device Location">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="new_device()">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List of Devices</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">Device Token</th>
                                    <th scope="col" style="width: 10%">Device Name</th>
                                    <th scope="col" style="width: 20%">Device Organization</th>
                                    <th scope="col" style="width: 15%">Location</th>
                                    <th scope="col" style="width: 25% ">mode</th>
                                    <th scope="col" style="width: 20%">.</th>
                                </tr>
                            </thead>
                            <tbody id="tableDataDevice">
                            </tbody>
                        </table>
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
                                    <input id="currentDeviceName" name="deviceName" type="text" class="form-control"
                                        placeholder="Enter ...">
                                </div>

                                <div class="form-group">
                                    <label>Device Location</label>
                                    <input id="currentDeviceLocation" name="deviceLocation" type="text"
                                        class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                    <label for="InputOrganization">Select Organization</label>
                                    <select class="form-control inputOrganizations" id="InputOrganization"
                                        name="deviceOrganization">

                                    </select>
                                </div>

                            </form><!-- /.form -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.model-body-->
                <div class="modal-footer ">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="edit_device_details()"><i class="fas fa-save pr-2"></i>Submit</button>
                </div><!-- /.model-footer-->
            </div><!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<!-- /.content -->
