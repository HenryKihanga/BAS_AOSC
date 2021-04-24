@push('scripts')
    <script>
        function store_branch_and_continue(organization_id) {
            let url = "{{ route('storeBranch', [50]) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementByIde('addBranchForm')),
                contentType: false;
                processData: false;
                success: function(res) {
                    document.getElementById('addBranchForm').reset();

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
                <h1 class="m-0">Edit Organization</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Organization</li>
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
                        <h3 class="card-title">Name of Organization</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Registration Number</label>
                                        <input id="regno" type="text" class="form-control" 
                                            placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name of Organization</label>
                                        <input id="name" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="number" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="email" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input id="address" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                              
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg-addBranch">Add
                            Branch</button>
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.col -->

        </div> <!-- /.row -->
    </div><!-- /.edit organization form content fluid-->
    <div class="modal fade" id="modal-lg-addBranch">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Branch(s) for organization's name</h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div><!-- /.model-header-->
                <div class="modal-body">
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title">Branch Details</h3>
                        </div>
                        <!--/. card-header -->
                        <div class="card-body">
                            <form id="addBranchForm">
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
                        onclick="store_branch_and_exit(30)"><i class="fas fa-save pr-2"></i>Submit</button>
                    <button type="button" class="btn btn-primary" onclick="store_branch_and_continue()"><i
                            class="fas fa-plus-circle pr-2"></i>Add More</button>
                </div><!-- /.model-footer-->
            </div><!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section>
<!-- /.content -->
