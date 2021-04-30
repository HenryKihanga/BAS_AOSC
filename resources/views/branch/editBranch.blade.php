@push('scripts')
    <script>
        function populate_branch_data_for_editing(branch_id) {
            let base_url = '{{ url('') }}'
            let path = "/branch/showOne/" + branch_id;
            url = base_url + path
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    let branch = result.branch;
                    // Set data to the edit organization form
                    document.getElementById("branchIdToAddDeparement").value = branch.branch_id;
                    document.getElementById("currentBranchRegistrationNumber").value = branch.branch_id;
                    document.getElementById("currentBranchName").value = branch.branch_name;
                    document.getElementById("currentBranchNumber").value = branch.branch_phone_number;
                    document.getElementById("currentBranchEmail").value = branch.branch_email;
                    document.getElementById("currentBranchAddress").value = branch.branch_address;
                    document.getElementById("branchNametoEdit").append(branch.branch_name);
                    document.getElementById("branchNametoAddOrganization").append(branch.branch_name);
                }
            });
        }

        function edit_branch_details() {
            let url = "{{ route('updateBranch') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire('Editted Seccesful', '', 'success')
                    show_manage_branch();
                },
                error: function(response) {
                    //pop up notification
                    Swal.fire({
                        text: 'Something went wrong!',
                        showConfirmButton: false,
                    })
                    $('#editBranchRegistrationNameError').text(response.responseJSON.errors.registrationName);
                    $('#editBranchPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#editBranchEmailError').text(response.responseJSON.errors.email);
                    $('#editBranchAddressError').text(response.responseJSON.errors.address);

                }
            });
        }

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
                    document.getElementById('InputDepartmentNumber').value = '';
                    document.getElementById('InputDepartmentRegistrationName').value = '';
                    document.getElementById('InputDepartmentPhoneNumber').value = '';
                    document.getElementById('InputDepartmentEmail').value = '';
                    document.getElementById('InputDepartmentAddress').value = '';
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
                 
                    document.getElementById('InputDepartmentNumber').value = '';
                    document.getElementById('InputDepartmentRegistrationName').value = '';
                    document.getElementById('InputDepartmentPhoneNumber').value = '';
                    document.getElementById('InputDepartmentEmail').value = '';
                    document.getElementById('InputDepartmentAddress').value = '';
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


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Branch</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="branchNametoEdit">EDIT </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form id="editBranchForm">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <input id="currentBranchRegistrationNumber" name="registrationNumber"
                                            type="hidden">
                                        <label>Name of Branch</label>
                                        <input id="currentBranchName" name="registrationName" type="text"
                                            class="form-control">
                                        <span class="text-danger" id="editBranchRegistrationNameError"></span>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="currentBranchNumber" name="phoneNumber" type="text"
                                            class="form-control">
                                        <span class="text-danger" id="editBranchPhoneNumberError"></span>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="currentBranchEmail" name="email" type="text" class="form-control">
                                        <span class="text-danger" id="editBranchEmailError"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input id="currentBranchAddress" name="address" type="text"
                                            class="form-control">
                                        <span class="text-danger" id="editBranchAddressError"></span>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="editBranch()">Submit</button>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#modal-lg-addDepartment">Add
                            Department</button>
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.col -->

        </div> <!-- /.row -->
    </div><!-- /.edit organization form content fluid-->
    <div class="modal fade" id="modal-lg-addDepartment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title " id="branchNametoAddOrganization">ADD DEPARTMENT FOR </h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div><!-- /.model-header-->
                <div class="modal-body">
                    <div class="card card-primary ">

                        <!--/. card-header -->
                        <div class="card-body">
                            <form id="addDepartmentForm">
                                @csrf
                                <div class="form-group">
                                    <input id="branchIdToAddDeparement" name="branchId" type="hidden">
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
                    <button type="button" class="btn btn-primary"
                        onclick="add_department_then_exit()"><i class="fas fa-save pr-2"></i>Submit</button>
                    <button type="button" class="btn btn-primary" onclick="add_department_then_continue()"><i
                            class="fas fa-plus-circle pr-2"></i>Add More</button>
                </div><!-- /.model-footer-->
            </div><!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->











































</section>
<!-- /.content -->
