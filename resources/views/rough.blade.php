@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="container">
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
                        <form id="newOrganizationForm" action="{{ route('roughIndex') }}" method="POST">
                            @csrf
                            <!--card-body -->
                            <div class="card-body">
                                <!--Registration Number Field-->
                                <div class="form-group">
                                    <label for="InputRegistrationNumber">Registration Number :</label>
                                    <input type="text" class="form-control" id="newOrganizationRegistrationNumber"
                                        placeholder="Enter Registration Number" name="registrationNumber">

                                </div>
                                <!--Registration Name Field-->
                                <div class="form-group">
                                    <label for="InputNameofRegistrationName">Registration Name :</label>
                                    <input type="text" class="form-control" id="newOrganizationRegistrationName"
                                        placeholder="Enter Registration Name" name="registrationName">
                                </div>
                                <!--Phone Number Field-->
                                <div class="form-group">
                                    <label for="InputNameofPhoneNumber">Phone Number :</label>
                                    <input type="text" class="form-control" id="newOrganizationPhoneNumber"
                                        placeholder="Enter Phone Number" name="phoneNumber">
                                </div>
                                <!--Email Field-->
                                <div class="form-group">
                                    <label for="InputNameofEmail">Email :</label>
                                    <input type="text" class="form-control" id="newOrganizationEmail"
                                        placeholder="Enter Email" name="email">
                                </div>
                                <!--Address Field-->
                                <div class="form-group">
                                    <label for="InputNameofAddress">Address :</label>
                                    <input type="text" class="form-control" id="newOrganizationAddress"
                                        placeholder="Enter Address" name="address">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- /.card-body -->
                            <!-- card-footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" onclick="">Submit</button>
                            </div><!-- /.card-footer -->
                        </form>
                    </div><!-- /.card -->
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('email')
                    <div><span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span></div>
                @enderror
                </div><!-- /.col -->


                {{ $errors }}

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->


@endsection
