@push('scripts')
    <script>
        function store_device() {
            let url = "{{ route('storeDevice', [20]) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addDeviceForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('addDeviceForm').reset();
                    let device = res.newDevice;
                    let token = device.device_token;
                    $('#tableDataDevice').prepend('<tr> <td class="filterable-cell" style="width: 10%">' +
                        device.device_token + '</td> <td class="filterable-cell" style="width: 10%">' +
                        device.device_name + '</td> <td class="filterable-cell" style="width: 20%">' +
                        device.organization_id +
                        '</td> <td class="filterable-cell" style="width: 20%">' +
                        device.device_location +
                        '</td> <td class="filterable-cell" style="width: 10%">' +
                        device.device_mode +
                        '</td> <td class="project-actions text-right" style="width: 30%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                        '<a class="btn btn-info btn-sm filterable-cell m-1" href="#" onclick="show_edit_organization(' +
                        token + ')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                        ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                    );
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
                    if (res.devices.length < 1) {
                        $('#tableDataDevice').text('There is no devices Registered')
                    }

                    let sn = 1;
                    res.devices.map(device => {
                        let token = device.device_token;
                        $('#tableDataDevice').prepend(
                            '<tr> <td class="filterable-cell" style="width: 10%">' +
                            device.device_token +
                            '</td> <td class="filterable-cell" style="width: 10%">' +
                            device.device_name +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            device.organization_id +
                            '</td> <td class="filterable-cell" style="width: 15%">' +
                            device.device_location +
                            '</td> <td class="text-right" style="width: 25%"> <a class="btn btn-primary btn-sm filterable-cell m-1" onclick="attendance_mode(456456)"><i class="fas fa-folder pr-1"> </i>Attendance</a>' +
                            '<a class="btn btn-success btn-sm filterable-cell m-1" onclick="enrollment_mode(456456)"><i class="fas fa-pencil-alt pr-1"> </i>Enrollment</a>' +
                            '</td> <td class="text-right" style="width: 20%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="populate_device_data_for_editing(' +
                            token +
                            ')" data-toggle="modal" data-target="#modal-lg-editDevice"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                            ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                        );
                    });
                }
            });
        }

        function populate_device_data_for_editing(id) {
            let url = "{{ route('showOneDevice', 456456) }}"
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result)
                    // Set data to the edit organization form
                    document.getElementById("currentDeviceName").value = result.device.device_name;
                    document.getElementById("currentDeviceLocation").value = result.device.device_location;

                }
            });
        }

        function edit_device_details(device_id) {
            let url = "{{ route('updateDevice', 456456) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editDeviceForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)

                }
            });
        }

        function enrollment_mode(device_id) {
            let url = "{{ route('changeDeviceMode', 456456) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'device_mode': 0
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)

                }
            });
        }
        function attendance_mode(device_id) {
            let url = "{{ route('changeDeviceMode', 456456) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'device_mode': 1
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)

                }
            });
        }

    </script>

    {{-- <script src="{{ asset('js/custome.js') }}"></script> --}}
@endpush

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Device</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Device</li>
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
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Device</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="addDeviceForm">
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
                                <select class="form-control" id="InputOrganization">
                                    <option>e-Government Authority</option>
                                    <option>Univeristy of Dar es Salaam</option>
                                    <option>UTUMISHI</option>
                                    <option>TAMISEMI</option>
                                    <option>Tanzania Portal Authority</option>
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
                            <button type="button" class="btn btn-primary" onclick="store_device()">Submit</button>
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
                <div class="modal-header">
                    <h4 class="modal-title">EDIT DEVICE</h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div><!-- /.model-header-->
                <div class="modal-body">
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title">DEVICE Details</h3>
                        </div>
                        <!--/. card-header -->
                        <div class="card-body">
                            <form id="editDeviceForm">
                                @csrf
                                <div class="form-group">
                                    <label>Name of Device</label>
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
                                    <select class="form-control" id="InputOrganization">
                                        <option>e-Government Authority</option>
                                        <option>Univeristy of Dar es Salaam</option>
                                        <option>UTUMISHI</option>
                                        <option>TAMISEMI</option>
                                        <option>Tanzania Portal Authority</option>
                                    </select>
                                </div>

                            </form><!-- /.form -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.model-body-->
                <div class="modal-footer ">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="edit_device_details(456456)"><i class="fas fa-save pr-2"></i>Submit</button>
                </div><!-- /.model-footer-->
            </div><!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<!-- /.content -->
