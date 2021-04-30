@push('scripts')
    <script>
        function populate_department_data_for_editing(department_id) {
            let base_url = '{{ url('') }}'
            let path = "/department/showOne/" + department_id;
            url = base_url + path
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    let department = result.department;
                    // Set data to the edit organization form
                    document.getElementById("currentDepartmentName").value = department.department_name;
                    document.getElementById("currentDepartmentNumber").value = department
                        .department_phone_number;
                    document.getElementById("currentDepartmentEmail").value = department.department_email;
                    document.getElementById("currentDepartmentAddress").value = department.department_address;
                    document.getElementById("organizationtoEditRegistrationNumber").value = department
                        .department_id;
                    document.getElementById("organizationNameetoEdit").append(department.department_name);
                }
            });
        }

        function edit_department_details() {
             //clear error message spans
             $('#editDepartmentRegistrationNameError').text('');
            $('#editDepartmentPhoneNumberError').text('');
            $('#editDepartmentEmailError').text('');
            $('#editDepartmentAddressError').text('');
            let url = "{{ route('updateDepartment') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editDepartmentForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire('Editted Seccesful', '', 'success')
                    show_manage_department()
                },
                error: function(response) {
                    //pop up notification
                    Swal.fire({
                        text: 'Something went wrong!',
                        showConfirmButton: false,
                    })
                    $('#editDepartmentRegistrationNameError').text(response.responseJSON.errors.registrationName);
                    $('#editDepartmentPhoneNumberError').text(response.responseJSON.errors.phoneNumber);
                    $('#editDepartmentEmailError').text(response.responseJSON.errors.email);
                    $('#editDepartmentAddressError').text(response.responseJSON.errors.address);

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
                <h1 class="m-0">Edit Department</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Department</li>
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
                        <h3 class="card-title" id="organizationNameetoEdit">EDIT </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form id="editDepartmentForm">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <input id="organizationtoEditRegistrationNumber" name="registrationNumber"
                                            type="hidden">
                                        <label>Name of Department</label>
                                        <input id="currentDepartmentName" name="registrationName" type="text"
                                            class="form-control">
                                            <span class="text-danger" id="editDepartmentRegistrationNameError"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="currentDepartmentNumber" name="phoneNumber" type="text"
                                            class="form-control">
                                            <span class="text-danger" id="editDepartmentPhoneNumberError"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="currentDepartmentEmail" name="email" type="text"
                                            class="form-control">
                                            <span class="text-danger" id="editDepartmentEmailError"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input id="currentDepartmentAddress" name="address" type="text"
                                            class="form-control">
                                            <span class="text-danger" id="editDepartmentAddressError"></span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputOrganization">Select Organization</label>
                                        <select class="form-control inputOrganizations" >
                                            {{-- List of organizations is populated by javascript method all_organizations() --}}
                                        {{-- </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputBranch">Select Branch</label>
                                        <select class="form-control inputBranches"  name="branchId">
                                            {{-- List of branches is populated by javascript method all_branches() --}}
                                        {{-- </select>
                                    </div>
                                </div>
                            </div> --}}


                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="editDepartment()">Submit</button>

                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.col -->

        </div> <!-- /.row -->
    </div><!-- /.edit organization form content fluid-->

</section>
<!-- /.content -->
