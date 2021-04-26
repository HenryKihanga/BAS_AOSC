@push('scripts')
    <script>

        function edit_department_details(department_id) {
            alert('Are you sure you want to edit?')
            let url = "{{ route('updateDepartment', [100]) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editDepartmentForm')),
                contentType: false,
                processData: false,
                success: function(res) {  
                    console.log(res)
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
                <h1 class="m-0">Edit Department</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Department</li>
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
                        <h3 class="card-title">Name of Department</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form id="editDepartmentForm">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name of Department</label>
                                        <input id="oldDepartmentName" name="registrationName" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="oldDepartmentNumber" name="phoneNumber" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="oldDepartmentEmail" name="email" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input id="oldDepartmentAddress" name="address" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                              
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="edit_department_details(100)">Submit</button>
                       
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.col -->

        </div> <!-- /.row -->
    </div><!-- /.edit organization form content fluid-->

</section>
<!-- /.content -->
