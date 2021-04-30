@push('scripts')
    <script>
        function new_organization() {
            let url = "{{ route('storeOrganization') }}"; //url for registering new organization
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('newOrganizationForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('newOrganizationForm').reset(); //clear registration form
                    //show confirmation message to user
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'New Organization has been added succesfully'
                    });
                    let organization = res.newOrganization; //get the new added organization from the controller
                    //prepend new organization to the table of organization
                    $('#tableData').prepend('<tr><td class="filterable-cell">' +
                        organization.organization_id + '</td> <td class="filterable-cell">' +
                        organization.organization_name + '</td> <td class="filterable-cell">' +
                        organization.organization_phone_number +
                        '</td> <td class="filterable-cell" style="width: 20%">' +
                        organization.organization_email +
                        '</td> <td class="filterable-cell" style="width: 13%">' +
                        organization.organization_address +
                        '</td> <td class="project-actions text-right" style="width: 22%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                        '<a class="btn btn-info btn-sm filterable-cell m-1" href="#" onclick="show_edit_organization(' +
                        organization.organization_id +
                        ')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                        ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                    );
                }
            });
        }

        function query_latest_organizations() {
            let url =
                "{{ route('showLatestTenOrganizations') }}"; //url to query last 10 added organizations from the database
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#tableData').html(''); //clear table data before showing queried organizations
                    //if there is no even a single organization display this message
                    if (res.organizations.length < 1) {
                        $('#tableData').text('There is no Organization Registered');
                    }
                    //Loop through organization array result query and display each organization
                    res.organizations.map(organization => {
                        let id = organization.organization_id;
                        $('#tableData').append('<tr>  <td class="filterable-cell">' +
                            organization.organization_id + '</td> <td class="filterable-cell">' +
                            organization.organization_name + '</td> <td class="filterable-cell">' +
                            organization.organization_phone_number +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            organization.organization_email +
                            '</td> <td class="filterable-cell" style="width: 13%">' +
                            organization.organization_address +
                            '</td> <td class="project-actions text-right" style="width: 22%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_organization(' +
                            id + ')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                            ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                        );

                    });
                }
            });
        }

    </script>
@endpush
{{-- ######################################################################################################################################### --}}
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Organization manage</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Organization Manage</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
{{-- ########################################################################################################################################### --}}
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- col -->
            <div class="col-md-3">
                <!-- card -->
                <div class="card card-primary">
                    <!-- card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Add New Organization</h3>
                    </div><!-- /.card-header -->
                    <!-- form start -->
                    <form id="newOrganizationForm">
                        @csrf
                        <!--card-body -->
                        <div class="card-body">
                            <!--Registration Number Field-->
                            <div class="form-group">
                                <label for="InputRegistrationNumber">Registration Number :</label>
                                <input type="text" class="form-control" id="newOrganizationRegistrationNumber"
                                    placeholder="Enter Registration Number" name="registrationNumber">
                                    {{-- @error('registrationNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                            <!--Registration Name Field-->
                            <div class="form-group">
                                <label for="InputNameofRegistrationName">Registration Name :</label>
                                <input type="text" class="form-control" id="newOrganizationRegistrationName"
                                    placeholder="Enter Registration Name" name="registrationName">
                            </div>
                            <!--Phone Number Field-->
                            <div class="form-group">
                                <label for="InputNameofPhoneNumber">Phone Number :</label>
                                <input type="text" class="form-control" id="newOrganizationPhoneNumber"
                                    placeholder="Enter Phone Number" name="phoneNumber">
                            </div>
                            <!--Email Field-->
                            <div class="form-group">
                                <label for="InputNameofEmail">Email :</label>
                                <input type="text" class="form-control" id="newOrganizationEmail"
                                    placeholder="Enter Email" name="email">
                            </div>
                            <!--Address Field-->
                            <div class="form-group">
                                <label for="InputNameofAddress">Address :</label>
                                <input type="text" class="form-control" id="newOrganizationAddress"
                                    placeholder="Enter Address" name="address">
                            </div>
                        </div><!-- /.card-body -->
                        <!-- card-footer -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="new_organization()">Submit</button>
                        </div><!-- /.card-footer -->
                    </form>
                </div><!-- /.card -->
            </div><!-- /.col -->
            {{-- ######################################################################################################################################## --}}
            <!-- col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List of Organizations</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">Registration Number</th>
                                    <th scope="col">Name of Organization</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col" style="width: 20%">Email of Organization</th>
                                    <th scope="col" style="width: 13%">Address</th>
                                    <th scope="col" style="width: 22%">.</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div> <!-- /.col -->
        </div><!-- /.row -->
        {{ $errors }}
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
