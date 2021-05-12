@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">USER INFORMATIONS</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <table class="table table-bordered">

                            <tbody>
                                <tr>
                                    <td style="width: 30%"><b>Full Name</b></td>
                                    <td style="width: 70%">{{ $user->first_name }} {{ $user->middle_name }}
                                        {{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Organization</b></td>
                                    <td style="width: 70%">{{ $user->Organization->organization_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Branch</b></td>
                                    <td style="width: 70%">{{ $user->branch->branch_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Department</b></td>
                                    <td style="width: 70%">{{ $user->department->department_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Phone </b></td>
                                    <td style="width: 70%">{{ $user->phone_number }}</td>
                                </tr>
                                <tr>

                                    <td style="width: 30%; display:block"><b>Status</b></td>
                                    @if ($user->status->enrollment_status && !$user->status->ready_to_enroll)
                                        <td style="width: 70%"><span class="badge bg-success">Enrolled</span></td>
                                        <td style="width: 100%">
                                            <div class="small-box bg-light " style="width: 50%; height:100%">
                                                <div class="inner">
                                                    <h3 class="text-success"><i class="far fa-check-circle"></i></h3>
                                                    <h6 class="text-success">Fingerprint Captured</h6><br>
                                                </div>
                                                <div class="icon text-success">
                                                    <i class="fas fa-fingerprint"></i>
                                                </div>
                                            </div>
                                        </td>
                                    @elseif(!$user->status->enrollment_status && $user->status->ready_to_enroll)
                                        <td style="width: 70%"><span class="badge bg-info">Waiting...</span></td>
                                        <td style="width: 100%">
                                            <div class="small-box bg-light" style="width: 50%; height:100%">
                                                <div class="inner">
                                                
                                                    <h6 class="text-danger">Waiting User to...</h6>
                                                    <h6 class="text-danger">Press Finger onto Device for enrollment</h6><br>
                                                </div>
                                                <div class="icon ">
                                                    <i class="fas fa-fingerprint"></i>
                                                </div>

                                            </div>
                                        </td>
                                    @else
                                        <td style="width: 70%"><span class="badge bg-danger">Not-enrolled</span></td>
                                    @endif


                                </tr>
                            </tbody>
                        </table>
                        @error('duplicateReadyToEnroll')
                            <div class="alert alert-danger p-2">
                                <span class="">{{ $message }}</span>
                            </div>
                        @enderror
                        @error('fingerPrintId')
                            <div class="alert alert-danger p-2">
                                <span class="">{{ $message }}</span>
                            </div>

                        @enderror
                    </div>
                    <div class="col-lg-6 col-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 30%"><b>Staff No</b></td>
                                    <td style="width: 70%">{{ $user->user_id }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Finger ID</b></td>
                                    <td style="width: 70%">
                                        @if ($user->status->fingerprint_id == [])
                                            -
                                        @endif
                                        {{ $user->status->fingerprint_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Email</b></td>
                                    <td style="width: 70%">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Date of Birth</b></td>
                                    <td style="width: 70%">{{ $user->birth_date }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Gender</b></td>
                                    <td style="width: 70%">Mail</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Device</b></td>
                                    <td style="width: 70%">
                                        @if ($user->device == [])
                                            -
                                        @else
                                            {{ $user->device->device_name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>Role(s)</b></td>
                                    <td style="width: 70%">
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }},
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix ">
                <button type="button" class="btn btn-outline-info mr-2">Edit</button>
            </div>
        </div>


    </div>
</section>
@endsection
