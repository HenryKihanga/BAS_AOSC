@extends('layouts.admin')
@push('scripts')
@endpush
@section('content')
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
                </div>
                @if (count($users) < 0)
                    There is no user registered
                @else
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="width: 15%">{{ $user->user_id }}</td>
                                        <td style="width: 20%">
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><img alt="Avatar" class="table-avatar mr-2"
                                                        src="{{ asset('template/dist/img/avatar.png') }}"></li>
                                                <li class="list-inline-item">{{ $user->first_name }}
                                                    {{ $user->last_name }}</li>
                                            </ul>
                                        </td>
                                        <td style="width: 20%">Organization</td>
                                        <td style="width: 15%">Branch</td>
                                        <td style="width: 15%">Department</td>

                                        <td class="project-state" style="width: 10%">
                                            @if ($user->status->enrollment_status)
                                                <span class="badge badge-success">Enrolled</span>
                                            @else
                                                <span class="badge badge-danger">Unenrolled</span>
                                            @endif
                                        </td>
                                        <td class="clickable-btn" style="width: 5%"> <a><i class="fas fa-cogs"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                @endif

            </div>
            <!-- /.card -->
        </div>


    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
