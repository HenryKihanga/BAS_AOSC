
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile Information</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">view profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="card w-100">
            <div class="card-body" style="background: #19B3D3; color:white;">
                <h4>Profile Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profilePictureFrame">
                            <img src="{{ asset('template/dist/img/user-henry-160x160.jpg') }}" class="profilePicture" alt="profile picture" style="width: 100% ;height :100%">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>User ID:</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>2017-04-06867</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>User Name :</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>Henry Kihanga</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Gender :</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>Male</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Phone Number:</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>+255653470846</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Role(s) :</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>Staff</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Email :</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>kihangahenry@gmail.com</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Date of Birth :</h5>
                            </div>
                            <div class="col-md-6">
                                <h6>12/2/2020</h6>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-info">EDIT INFO</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-info">DELETE STAFF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
