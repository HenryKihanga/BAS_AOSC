@push('scripts')
    <script>
        function query_all_users() {
            let url = "{{ route('showAllUsers') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#tableAllUsers').html('')
                    res.users.map(user => {
                        console.log(user.status.enrollement_status)
                        if (user.status.enrollement_status) {
                            $('#tableAllUsers').append(
                                '<tr class="clickable-row"><td style="width: 15%">' + user.user_id +
                                '</td>' +
                                '<td style="width: 20%"><ul class="list-inline">' +
                                '<li class="list-inline-item"><img alt="Avatar" class="table-avatar mr-2"' +
                                'src="{{ asset('template/dist/img/avatar.png') }}"></li>' +
                                '<li class="list-inline-item"><a>' + user.first_name + ' ' + user
                                .last_name +
                                '</a></li></ul></td>' +
                                '<td style="width: 20%">e-Government Authority</td>' +
                                '<td style="width: 15%">Main</td>' +
                                '<td style="width: 15%">Finance</td>' +
                                '<td class="project-state" style="width: 10%">' +
                                '<span class="badge badge-success">Enrolled</span></td>' +
                                '<td class="clickable-btn" style="width: 5%"><a onclick="show_user(' +
                                user.id + ')"><i class="fas fa-cogs"></i></a></td></tr>')
                        } else {
                            $('#tableAllUsers').append(
                                '<tr ><td style="width: 15%">' + user.user_id +
                                '</td>' +
                                '<td style="width: 20%"><ul class="list-inline">' +
                                '<li class="list-inline-item"><img alt="Avatar" class="table-avatar mr-2"' +
                                'src="{{ asset('template/dist/img/avatar.png') }}"></li>' +
                                '<li class="list-inline-item"><a>' + user.first_name + ' ' + user
                                .last_name +
                                '</a></li></ul></td>' +
                                '<td style="width: 20%">e-Government Authority</td>' +
                                '<td style="width: 15%">Main</td>' +
                                '<td style="width: 15%">Finance</td>' +
                                '<td class="project-state" style="width: 10%">' +
                                '<span class="badge badge-danger">Unenrolled</span></td>' +
                                '<td class="clickable-btn" style="width: 5%"> <a onclick="show_user(' +
                                user.user_id + ')"><i class="fas fa-cogs"></i></a></td></tr>')
                        }
                    });
                }
            });
        }

    </script>
@endpush
<!-- Content Wrapper. Contains page content -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 15%">
                                User ID
                            </th>
                            <th style="width: 20%">
                                Avatar/ User Name
                            </th>
                            <th style="width: 20%">
                                Organization
                            </th>
                            <th style="width: 15%">
                                Branch
                            </th>
                            <th style="width: 15%">
                                Department
                            </th>
                            <th style="width: 10%" class="text-center">
                                Status
                            </th>
                            <th style="width: 5%">.</th>

                        </tr>

                    </thead>
                    <tbody id="tableAllUsers">

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


</section>
<!-- /.content -->

<!-- /.content-wrapper -->
