@extends('layouts/admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Department</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Home</a></li>
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
                    <form id="editDepartmentForm" method="POST" action="{{ route('updateDepartment') }}">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" id="organizationNameetoEdit">EDIT
                                    {{ $department->department_name }} DEPARTMENT</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div> <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <input value="{{ $department->department_id }}" name="registrationNumber"
                                                type="hidden">
                                            <label>Name of Department</label>
                                            <input value="{{ $department->department_name }}" name="registrationName"
                                                type="text"
                                                class="form-control @error('registrationName') in-valid @enderror">
                                            @error('registrationName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input value="{{ $department->department_phone_number }}" name="phoneNumber"
                                                type="text" class="form-control @error('phoneNumber') in-valid @enderror">
                                            @error('phoneNumber')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input value="{{ $department->department_email }}" name="email" type="text"
                                                class="form-control @error('email') in-valid @enderror">

                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input value="{{ $department->department_address }}" name="address"
                                                type="text" class="form-control @error('address') in-valid @enderror">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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



                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Submit</button>

                            </div><!-- /.card-footer -->
                        </div><!-- /.card -->
                    </form>
                </div><!-- /.col -->

            </div> <!-- /.row -->
        </div><!-- /.edit organization form content fluid-->

    </section>
    <!-- /.content -->
@endsection
