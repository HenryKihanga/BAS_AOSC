@push('scripts')
    <script>
        function add_department(branch_id) {
            let url = "{{ route('storeDepartment', [1000]) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addDepartmentForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('addDepartmentForm').reset();
                   

                }
            });
        }

 
        function edit_branch_details(branch_id) {
            alert('Are you sure you want to edit?')
            let url = "{{ route('updateBranch', [1000]) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    
                   
                }
            });
        }

    </script>
@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Branch</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Branch</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Name of Branch</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form id="editBranchForm">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name of Organization</label>
                                        <input id="branchName" name="registrationName" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="branchNumber" name="phoneNumber" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="branchEmail" name="email" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input id="branchAddress" name="address" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                              
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="edit_branch_details(1000)">Submit</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg-addDepartment">Add
                            Department</button>
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.col -->

        </div> <!-- /.row -->
    </div><!-- /.edit organization form content fluid-->
    <div class="modal fade" id="modal-lg-addDepartment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Department(s) for branch's name</h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div><!-- /.model-header-->
                <div class="modal-body">
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title">Department Details</h3>
                        </div>
                        <!--/. card-header -->
                        <div class="card-body">
                            <form id="addDepartmentForm">
                                @csrf
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
                                    <input type="text" class="form-control" id="InputNameofEmail"
                                        placeholder="Enter Email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="InputNameofAddress">Address :</label>
                                    <input type="text" class="form-control" id="InputNameofAddress"
                                        placeholder="Enter Address" name="address">
                                </div>
                            </form><!-- /.form -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.model-body-->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="add_department(1000)"><i class="fas fa-save pr-2"></i>Submit</button>
                    <button type="button" class="btn btn-primary" onclick="add_department(1000)"><i
                            class="fas fa-plus-circle pr-2"></i>Add More</button>
                </div><!-- /.model-footer-->
            </div><!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->











































</section>
<!-- /.content -->
