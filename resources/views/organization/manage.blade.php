@extends('layouts.admin')
@push('scripts')

@endpush
{{-- ######################################################################################################################################### --}}
<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Organization manage</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Organization Manage</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- ########################################################################################################################################### --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- col -->
                <div class="col-md-3">
                    <!-- card -->
                    <div class="card card-primary">
                        <!-- card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Add New Organization</h3>
                        </div><!-- /.card-header -->
                        <!-- form start -->
                        <form id="newOrganizationForm" method="POST" action="{{ route('storeOrganization') }}">
                            @csrf
                            <!--card-body -->
                            <div class="card-body">
                                <!--Registration Number Field-->
                                <div class="form-group">
                                    <label for="InputRegistrationNumber">Registration Number :</label>
                                    <input type="text" class="form-control @error('registrationNumber') in-valid @enderror"
                                        value="{{ old('registrationNumber') }}" placeholder="Enter Registration Number"
                                        name="registrationNumber">
                                    @error('registrationNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror


                                </div>
                                <!--Registration Name Field-->
                                <div class="form-group">
                                    <label for="InputNameofRegistrationName">Registration Name :</label>
                                    <input type="text" class="form-control @error('registrationName') in-valid @enderror"
                                        value="{{ old('registrationName') }}" placeholder="Enter Registration Name"
                                        name="registrationName">
                                    @error('registrationNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--Phone Number Field-->
                                <div class="form-group">
                                    <label for="InputNameofPhoneNumber">Phone Number :</label>
                                    <input type="text" class="form-control @error('phoneNumber') in-valid @enderror"
                                        value="{{ old('phoneNumber') }}" placeholder="Enter Phone Number"
                                        name="phoneNumber">
                                    @error('phoneNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--Email Field-->
                                <div class="form-group">
                                    <label for="InputNameofEmail">Email :</label>
                                    <input type="text" class="form-control @error('email') in-valid @enderror"
                                        value="{{ old('email') }}" placeholder="Enter Email" name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--Address Field-->
                                <div class="form-group">
                                    <label for="InputNameofAddress">Address :</label>
                                    <input type="text" class="form-control @error('address') in-valid @enderror"
                                        value="{{ old('address') }}" placeholder="Enter Address"
                                        name="address">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- /.card-body -->
                            <!-- card-footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div><!-- /.card-footer -->
                        </form>
                    </div><!-- /.card -->
                </div><!-- /.col -->
                {{-- ######################################################################################################################################## --}}
                <!-- col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List of Organizations</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th scope="col">Registration Number</th>
                                        <th scope="col">Name of Organization</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col" style="width: 20%">Email of Organization</th>
                                        <th scope="col" style="width: 13%">Address</th>
                                        <th scope="col" style="width: 22%">.</th>
                                    </tr>
                                </thead>
                                <tbody id="tableData">
                                    @foreach ($organizations as $organization)
                                        <tr>
                                            <td class="filterable-cell">{{ $organization->organization_id }}</td>
                                            <td class="filterable-cell">{{ $organization->organization_name }}</td>
                                            <td class="filterable-cell">{{ $organization->organization_phone_number }}
                                            </td>
                                            <td class="filterable-cell" style="width: 20%">
                                                {{ $organization->organization_email }}</td>
                                            <td class="filterable-cell" style="width: 13%">
                                                {{ $organization->organization_address }}</td>
                                            <td class="project-actions text-right" style="width: 22%"> <a
                                                    class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i
                                                        class="fas fa-folder pr-1"> </i>View</a><a
                                                    class="btn btn-info btn-sm filterable-cell m-1" href="{{route('editOrganization', [$organization->organization_id])}}"><i class="fas fa-pencil-alt pr-1" >
                                                    </i>Edit</a>
                                                <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i
                                                        class="fas fa-trash pr-1"> </i>Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div> <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
@endsection
