@extends('layouts.admin')
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endpush

@section('content')

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


            <!-- PRIMARY DETAILS CONTENT -->
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">New User Details</h3>
                </div>

                <div class="card-body">
                    <form id="addUserForm" method="POST" action="{{ route('addUser')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputFirstName">First Name</label>
                                    <input type="text" name="firstName" value="{{ old('firstName')}}" class="form-control @error('firstName') is-invalid @enderror" id="InputFirstName"
                                        placeholder="First Name">
                                        @error('firstName')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                   
                                </div>
                                <div class="form-group">
                                    <label for="InputMiddleName">Middle Name</label>
                                    <input type="text" name="middleName" value="{{ old('middleName')}}"  class="form-control @error('middleName') is-invalid @enderror" id="InputMiddleName"
                                        placeholder="Middle Name">
                                        @error('middleName')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="InputLastName">Last Name</label>
                                    <input type="text" name="lastName" value="{{ old('lastName')}}" class="form-control @error('lastName') is-invalid @enderror" id="InputLastName"
                                        placeholder="Last Name">
                                        @error('lastName')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="InputStaffId">User ID</label>
                                    <input class="form-control @error('userID') is-invalid @enderror" name="userID" value="{{ old('userID')}}" type="number " placeholder="4223567"
                                        id="InputStaffId">
                                        @error('userID')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" value="{{ old('email')}}" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                        placeholder="Enter email">
                                        @error('email')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="InputPhoneNumber">Telephone</label>
                                    <input class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" value="{{ old('phoneNumber')}}" type="tel" placeholder="+255654383729"
                                        id="InputPhoneNumber">
                                        @error('phoneNumber')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="InputBirthDate">Birth Date</label>

                                    <input class="form-control @error('birthDate') is-invalid @enderror" name="birthDate" value="{{ old('birthDate')}}" type="date" placeholder="2001-08-19"
                                        id="InputBirthDate">
                                        @error('birthDate')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputOrganization">Select Organization</label>
                                    <select class="form-control inputOrganizations " name="organizationId"
                                        id="InputOrganization">
                                        @foreach ($organizations as $organization)
                                            <option value="{{ $organization->organization_id }}">
                                                {{ $organization->organization_name }} </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="InputBranch">Select Branch</label>
                                    <select class="form-control inputBranches " name="branchId" id="InputBranch">
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->branch_id }}">
                                                {{ $branch->branch_name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputDepartment">Select Department</label>
                                    <select class="form-control inputDeparments " name="departmentId" id="InputDepartment">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->department_id }}">
                                                {{ $department->department_name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- checkbox -->
                                @can('isAdmin')
                                <div class=" myCheckbox form-group row">
                                    <div>
                                        <label class="mylabel" for="">Choose Role</label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="checkbox" value="1" name="roles[]">
                                            <span>admin</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="checkbox" value="2" name="roles[]">
                                            <span>organizationHead</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="checkbox" value="3" name="roles[]">
                                            <span>branchHead</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="checkbox" value="4" name="roles[]">
                                            <span>departmentHead</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="checkbox" value="5" name="roles[]">
                                            <span>staff</span>
                                        </label>
                                    </div>
                                </div>
                                @error('roles')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                                @endcan
                                {{-- <div class="form-group">
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
                            </div> --}}
                            </div>

                        </div>
                        <div >
                            <button type="submit" class="btn btn-primary" onclick="store_userttt()">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <!-- /.card-body -->
                
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
