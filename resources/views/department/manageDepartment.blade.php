@push('scripts')
    <script>
        function new_department() {
            let url = "{{ route('storeDepartment') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('newDepartmentForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('newDepartmentForm').reset();
                     //show confirmation message to user
                     var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'New Department has been added succesfully'
                    });
                    let department = res.newDepartment;
                    $('#tableDataDepartment').prepend('<tr><td class="filterable-cell">' +
                        department.department_id + '</td> <td class="filterable-cell">' +
                        department.department_name + '</td> <td class="filterable-cell">' +
                        department.department_phone_number +
                        '</td> <td class="filterable-cell" style="width: 20%">' +
                        department.department_email +
                        '</td> <td class="filterable-cell" style="width: 10%">' +
                        department.department_address +
                        '</td> <td class="project-actions text-right" style="width: 25%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                        '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_department(' +
                        department.department_id + ')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                        ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                    );
                }
            });
        }

        function query_all_departments() {
            let url = "{{ route('showAllDepartments') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#tableDataDepartment').html('')
                    res.departments.map(department => {
                        $('#tableDataDepartment').append('<tr><td class="filterable-cell">' +
                            department.department_id + '</td> <td class="filterable-cell">' +
                            department.department_name + '</td> <td class="filterable-cell">' +
                            department.department_phone_number +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            department.department_email +
                            '</td> <td class="filterable-cell" style="width: 10%">' +
                            department.department_address +
                            '</td> <td class="project-actions text-right" style="width: 25%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_department(' +
                            department.department_id +
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
                <h1>Department Manage</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Department Manage</li>
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
                        <h3 class="card-title">Add New Department</h3>
                    </div><!-- /.card-header -->
                    <form id="newDepartmentForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputRegistrationNumber">Registration Number :</label>
                                <input type="text" class="form-control" id="InputRegistrationNumber"
                                    placeholder="Enter Registration Number" name="registrationNumber">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofRegistrationName">Registration Name :</label>
                                <input type="text" class="form-control" id="InputNameofRegistrationName"
                                    placeholder="Enter Registration Name" name="registrationName">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofPhoneNumber">Phone Number :</label>
                                <input type="text" class="form-control" id="InputNameofPhoneNumber"
                                    placeholder="Enter Phone Number" name="phoneNumber">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofEmail">Email :</label>
                                <input type="text" class="form-control" id="InputNameofEmail" placeholder="Enter Email"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofAddress">Address :</label>
                                <input type="text" class="form-control" id="InputNameofAddress"
                                    placeholder="Enter Address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="InputOrganization">Select Organization</label>
                                <select class="form-control inputOrganizations" id="InputOrganization">
                                    {{-- List of organizations is populated by javascript method all_organizations() --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputBranch">Select Branch</label>
                                <select class="form-control inputBranches" id="InputBranch" name="branchId">
                                    {{-- List of branches is populated by javascript method all_branches() --}}
                                </select>
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="new_department()">Submit</button>
                        </div><!-- /.card-footer -->
                    </form><!-- /.form -->
                </div><!-- /.card -->
            </div> <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List of Departments</h3>
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
                            <tbody id="tableDataDepartment">

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
