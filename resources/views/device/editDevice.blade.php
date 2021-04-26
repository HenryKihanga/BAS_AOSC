@push('scripts')
    <script>
       

    </script>
@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Device</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Device</li>
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
                        <h3 class="card-title">Name of Device</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form id="editDeviceForm">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name of Device</label>
                                        <input id="devName" name="registrationName" type="text" class="form-control"
                                            placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Device Location</label>
                                        <input id="devLocation" name="phoneNumber" type="text" class="form-control"
                                            placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
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
                                </div>


                            </div>
                     
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="edit_department_details(11)">Submit</button>

                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.col -->

        </div> <!-- /.row -->
    </div><!-- /.edit organization form content fluid-->

</section>
<!-- /.content -->
