@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function store_user() {
            $('#newUserFirstNameError').text('');
            $('#newUserLastNameError').text('');
            $('#newUserIDError').text('');
            $('#newUserEmailError').text('');
            $('#newUserPhoneNumberError').text('');
            $('#newUserBirthDateError').text('');
            $('#newUserRoleError').text('');
            let url = "{{ route('addUser') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addUserForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    let name = res.user.first_name + ' ' + res.user.middle_name + ' ' + res.user.last_name;
                    document.getElementById('addUserForm').reset();
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: name + ' is added succesfully'
                    });
                    show_all_users();
                },
                error: function(response) {
                    $('#newUserFirstNameError').text(response.responseJSON.errors.firstName);
                    $('#newUserLastNameError').text(response.responseJSON.errors.lastName);
                    $('#newUserIDError').text(response.responseJSON.errors.userID);
                    $('#newUserEmailError').text(response.responseJSON.errors.email);
                    $('#newUserPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#newUserBirthDateError').text(response.responseJSON.errors.birthDate);
                    $('#newUserRoleError').text(response.responseJSON.errors.roles);
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
                <h1>Add User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">


        <!-- PRIMARY DETAILS CONTENT -->
        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title">New User Details</h3>
            </div>

            <div class="card-body">
                <form id="addUserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputFirstName">First Name</label>
                                <input type="text" name="firstName" class="form-control" id="InputFirstName"
                                    placeholder="First Name">
                                <span class="text-danger" id="newUserFirstNameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputMiddleName">Middle Name</label>
                                <input type="text" name="middleName" class="form-control" id="InputMiddleName"
                                    placeholder="Middle Name">
                                <span class="text-danger" id="newUserMiddleNameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputLastName">Last Name</label>
                                <input type="text" name="lastName" class="form-control" id="InputLastName"
                                    placeholder="Last Name">
                                <span class="text-danger" id="newUserLastNameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputStaffId">User ID</label>
                                <input class="form-control" name="userID" type="number" placeholder="4223567"
                                    id="InputStaffId">
                                <span class="text-danger" id="newUserIDError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email">
                                <span class="text-danger" id="newUserEmailError"></span>
                            </div>
                            <div class="form-group ">
                                <label for="InputPhoneNumber">Telephone</label>
                                <input class="form-control" name="phoneNumber" type="tel" placeholder="+255654383729"
                                    id="InputPhoneNumber">
                                <span class="text-danger" id="newUserPhoneNumberError"></span>
                            </div>
                            <div class="form-group ">
                                <label for="InputBirthDate">Birth Date</label>

                                <input class="form-control" name="birthDate" type="date" placeholder="2001-08-19"
                                    id="InputBirthDate">
                                <span class="text-danger" id="newUserBirthDateError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputOrganization">Select Organization</label>
                                <select class="form-control inputOrganizations" name="organization"
                                    id="InputOrganization">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputBranch">Select Branch</label>
                                <select class="form-control inputBranches" name="branch" id="InputBranch">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputDepartment">Select Department</label>
                                <select class="form-control inputDeparments" name="department" id="InputDepartment">

                                </select>
                            </div>
                            <!-- checkbox -->
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
                            <span class="text-danger" id="newUserRoleError"></span>
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
                </form>
            </div>
            <!-- /.card-body -->
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="store_user()">Submit</button>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
