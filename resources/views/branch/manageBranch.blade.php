@push('scripts')
    <script>
        function new_branch() {
            $('#newBranchRegistrationNumberError').text('');
            $('#newBranchRegistrationNameError').text('');
            $('#newBranchPhoneNumberError').text('');
            $('#newBranchEmailError').text('');
            $('#newBranchAddressError').text('');
            $('#newBranchOrganizationError').text('');
            let url = "{{ route('storeBranch') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('newBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {

                    document.getElementById('newBranchForm').reset();
                    //show confirmation message to user
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'New Branch has been added succesfully'
                    });
                    let branch = res.branch;
                    $('#tableAllBranches').prepend('<tr><td class="filterable-cell">' +
                        branch.branch_id + '</td> <td class="filterable-cell">' +
                        branch.branch_name + '</td> <td class="filterable-cell">' +
                        branch.branch_phone_number +
                        '</td> <td class="filterable-cell" style="width: 20%">' +
                        branch.branch_email +
                        '</td> <td class="filterable-cell" style="width: 10%">' +
                        branch.branch_address +
                        '</td> <td class="project-actions text-right" style="width: 25%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                        '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_branch(' +
                        branch.branch_id + ')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                        ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                    );
                },
                error: function(response) {
                    $('#newBranchRegistrationNumberError').text(response.responseJSON.errors
                    .registrationNumber);
                    $('#newBranchRegistrationNameError').text(response.responseJSON.errors.registrationName);
                    $('#newBranchPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#newBranchEmailError').text(response.responseJSON.errors.email);
                    $('#newBranchAddressError').text(response.responseJSON.errors.address);
                    $('#newBranchOrganizationError').text(response.responseJSON.errors.organizationId);
                }
            });
        }

        function query_all_branches() {
            let url = "{{ route('showAllBranches') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#tableAllBranches').html('')
                    res.branches.map(branch => {
                        $('#tableAllBranches').append('<tr><td class="filterable-cell">' +
                            branch.branch_id + '</td> <td class="filterable-cell">' +
                            branch.branch_name + '</td> <td class="filterable-cell">' +
                            branch.branch_phone_number +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            branch.branch_email +
                            '</td> <td class="filterable-cell" style="width: 10%">' +
                            branch.branch_address +
                            '</td> <td class="project-actions text-right" style="width: 25%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_branch(' +
                            branch.branch_id +
                            ')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                            ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                        );
                    });
                }
            });
        }

    </script>
@endpush
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Branche Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Branche Manage</li>
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
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Branch</h3>
                    </div><!-- /.card-header -->
                    <form id="newBranchForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputRegistrationNumber">Registration Number :</label>
                                <input type="text" class="form-control" id="newBranchRegistrationNumber"
                                    placeholder="Enter Registration Number" name="registrationNumber">
                                <span class="text-danger" id="newBranchRegistrationNumberError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputNameofRegistrationName">Registration Name :</label>
                                <input type="text" class="form-control" id="newBranchRegistrationName"
                                    placeholder="Enter Registration Name" name="registrationName">
                                <span class="text-danger" id="newBranchRegistrationNameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputNameofPhoneNumber">Phone Number :</label>
                                <input type="text" class="form-control" id="newBranchPhoneNumber"
                                    placeholder="Enter Phone Number" name="phoneNumber">
                                <span class="text-danger" id="newBranchPhoneNumberError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputNameofEmail">Email :</label>
                                <input type="text" class="form-control" id="newBranchEmail" placeholder="Enter Email"
                                    name="email">
                                <span class="text-danger" id="newBranchEmailError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputNameofAddress">Address :</label>
                                <input type="text" class="form-control" id="newBranchAddress"
                                    placeholder="Enter Address" name="address">
                                <span class="text-danger" id="newBranchAddressError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputOrganization">Select Organization</label>
                                <select class="form-control inputOrganizations" id="inputOrganizations"
                                    name="organizationId">
                                    {{-- organization data are populate by java script method all_organizations() --}}
                                </select>
                                <span class="text-danger" id="newBranchOrganizationError"></span>
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="new_branch()">Submit</button>
                        </div><!-- /.card-footer -->
                    </form><!-- /.form -->
                </div><!-- /.card -->
            </div> <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
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
