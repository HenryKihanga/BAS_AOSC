@extends('layouts/admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Change Password</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- general form elements -->

<section class="content">
    <div class="content-fluid">
        <div class="row ml-2">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputCurrentPassword">Current Password</label>
                                <input type="password" class="form-control" id="InputCurrentPassword" placeholder="Enter Current Password">
                            </div>
                            <div class="form-group">
                                <label for="InputNewPassword">New Password</label>
                                <input type="password" class="form-control" id="InputNewPassword" placeholder="Enter New Password">
                            </div>
                            <div class="form-group">
                                <label for="InputConfirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="InputConfirmPassword" placeholder="Enter New Password Again">
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
        </div>

    </div>
</section>
@endsection