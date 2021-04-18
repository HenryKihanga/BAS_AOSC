
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Organizations</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Organizations</li>
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
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Organization Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputNameofOrganization">Name of Organization</label>
                                <input type="text" class="form-control" id="InputNameofOrganization" placeholder="Enter Organization Name">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofBranch">Name of Branch</label>
                                <input type="text" class="form-control" id="InputNameofBranch" placeholder="Enter Branch Name">
                            </div>
                            <div class="form-group">
                                <label for="InputNameofDepartment">Name of Department</label>
                                <input type="text" class="form-control" id="InputNameofDepartment" placeholder="Enter Department Name">
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Organizations</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name of Organizations</th>
                                    <th>Branches</th>
                                    <th>Departments</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>e-Government Authority
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                Main,
                                            </li>
                                            <li class="list-inline-item">
                                                Dar es Salaam,
                                            </li>
                                            <li class="list-inline-item">
                                                Dodoma,
                                            </li>
                                            <li class="list-inline-item">
                                                Mwanza
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                Finance,
                                            </li>
                                            <li class="list-inline-item">
                                                Sales,
                                            </li>
                                            <li class="list-inline-item">
                                                ICT,
                                            </li>

                                        </ul>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="#">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <a class="btn btn-info btn-sm" href="#">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>


                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
