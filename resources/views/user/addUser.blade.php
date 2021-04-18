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
        <div class="row">
            <div class="col-md-6">
                <!-- PRIMARY DETAILS CONTENT -->
                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">Primary User Details</h3>
                    </div>

                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputFirstName">First Name</label>
                                <input type="text" class="form-control" id="InputFirstName" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="InputMiddleName">Middle Name</label>
                                <input type="text" class="form-control" id="InputMiddleName" placeholder="Middle Name">
                            </div>
                            <div class="form-group">
                                <label for="InputLastName">Last Name</label>
                                <input type="text" class="form-control" id="InputLastName" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="InputStaffId">User ID</label>
                                <input class="form-control" type="number" placeholder="4223567" id="InputStaffId">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group ">
                                <label for="InputPhoneNumber">Telephone</label>
                                <input class="form-control" type="tel" placeholder="+255654383729"
                                    id="InputPhoneNumber">
                            </div>
                            <div class="form-group ">
                                <label for="InputBirthDate">Birth Date</label>

                                <input class="form-control" type="date" placeholder="2001-08-19" id="InputBirthDate">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">

                <!-- ADDITIONAL DETAILS CONTENT -->

                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">Additional User Details</h3>
                    </div>
                    <!-- form start -->
                    <form>
                        <div class="card-body">
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
                            <div class="form-group">
                                <label for="InputBranch">Select Branch</label>
                                <select class="form-control" id="InputBranch">
                                    <option>Main</option>
                                    <option>Dodoma</option>
                                    <option>Iringa</option>
                                    <option>Morogoro</option>
                                    <option>Mwanza</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputDepartment">Select Department</label>
                                <select class="form-control" id="InputDepartment">
                                    <option>Finance</option>
                                    <option>Sports</option>
                                    <option>Utamaduni</option>
                                    <option>Matengenezo</option>
                                    <option>Productions</option>
                                </select>
                            </div>
                            <!-- checkbox -->
                            <div class=" myCheckbox form-group row">
                                <label for="">Choose Role</label>
                                <div>
                                    <label>
                                        <input type="checkbox" value="admin">
                                        <span>Admin</span>
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="checkbox" value="staff">
                                        <span>Staff</span>
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="checkbox" value="staff">
                                        <span>Head of Organization</span>
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="checkbox" value="staff">
                                        <span>Head of Branch</span>
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="checkbox" value="staff">
                                        <span>Head of Department</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
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
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
