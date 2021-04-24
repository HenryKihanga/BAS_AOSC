@push('scripts')
    <script>
        function store_branch() {
            let url = "{{ route('storeBranch',[30]) }}";
            $.ajax({
               
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('newBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    document.getElementById('newBranchForm').reset();
                    let branch = res.branch;
                    let id = branch.branch_id;
                    $('#tableAllBranches').prepend('<tr><td class="filterable-cell">' +
                            branch.branch_id + '</td> <td class="filterable-cell">' +
                            branch.branch_name + '</td> <td class="filterable-cell">' +
                            branch.branch_phone_number +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            branch.branch_email +
                            '</td> <td class="filterable-cell" style="width: 8%">' +
                            branch.branch_address +
                            '</td> <td class="project-actions text-right" style="width: 22%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_branch('+id+')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
                            ' <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i class="fas fa-trash pr-1"> </i>Delete</a></td> </tr>'
                        );
                    
                }
            });
        }
        function query_all_branches() {
            
            let url = "{{ route('showAllBranches') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                   
                    res.branches.map(branch => {
                        let id = branch.branch_id;
                        $('#tableAllBranches').append('<tr><td class="filterable-cell">' +
                            branch.branch_id + '</td> <td class="filterable-cell">' +
                            branch.branch_name + '</td> <td class="filterable-cell">' +
                            branch.branch_phone_number +
                            '</td> <td class="filterable-cell" style="width: 20%">' +
                            branch.branch_email +
                            '</td> <td class="filterable-cell" style="width: 10%">' +
                            branch.branch_address +
                            '</td> <td class="project-actions text-right" style="width: 25%"> <a class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i class="fas fa-folder pr-1"> </i>View</a>' +
                            '<a class="btn btn-info btn-sm filterable-cell m-1" onclick="show_edit_branch('+id+')"><i class="fas fa-pencil-alt pr-1"> </i>Edit</a>' +
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
                <h1>Branches</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Branches</li>
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
                        <h3 class="card-title">Add Branch Details</h3>
                    </div><!-- /.card-header -->
                    <form id="newBranchForm">
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
                                <select class="form-control" id="InputOrganization">
                                    <option>e-Government Authority</option>
                                    <option>Univeristy of Dar es Salaam</option>
                                    <option>UTUMISHI</option>
                                    <option>TAMISEMI</option>
                                    <option>Tanzania Portal Authority</option>
                                </select>
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="store_branch()">Submit</button>
                        </div><!-- /.card-footer -->
                    </form><!-- /.form -->
                </div><!-- /.card -->
            </div> <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List of Branches</h3>
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
                            <tbody id="tableAllBranches">
                               
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
