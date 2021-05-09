@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">User Details</li>
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
                        <div class="col-md-6 col-12">
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
                                        <td style="width: 30%"><b>Phone Number</b></td>
                                        <td style="width: 70%">{{ $user->phone_number }}</td>
                                    </tr>
                                    <tr>

                                        <td style="width: 30%"><b>Enrollment Status</b></td>
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
                        <div class="col-md-6 col-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%"><b>Employment No</b></td>
                                        <td style="width: 70%">{{ $user->user_id }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Fingerprint No</b></td>
                                        <td style="width: 70%">
                                            @if ($user->status->fingerprint_id == [])
                                                NULL
                                            @endif
                                            {{ $user->status->fingerprint_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%"><b>Email Address</b></td>
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
                                        <td style="width: 30%"><b>Device Enrolled</b></td>
                                        <td style="width: 70%">
                                            @if ($user->device == [])
                                                NULL
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
                    <button type="button" class="btn btn-outline-danger mr-2">Delete</button>
                    @if (!$user->status->enrollment_status && !$user->status->ready_to_enroll)
                        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#enrollUser"
                            aria-expanded="false" aria-controls="enrollUser">Enroll User</button>
                    @endif

                </div>
            </div>
            <div class="card collapse multi-collapse" id="enrollUser">
                <form action="{{ route('prepareUserToEnroll') }}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 col-12">
                                <div class="form-group">
                                    <input type="hidden" name="userId" class="col-sm-8 form-control"
                                        value="{{ $user->user_id }}">
                                    <label>Fingerprint Id :</label>
                                    <input type="text" name="fingerPrintId"
                                        class="form-control @error('fingerPrintId') in-valid @enderror"
                                        value="{{ old('fingerPrintId') }}" placeholder="Enter Finger Id">
                                    @error('fingerPrintId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Device :</label>
                                    <select class="form-control " name="deviceId">
                                        @foreach ($devices as $device)
                                            <option value="{{ $device->device_token }}">{{ $device->device_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="small-box bg-light" style="width: 80%; height:100%">
                                    <div class="inner">
                                        <h5>Set FingerprintId then</h5><br>
                                        <h6>let user to touch the device</h6>
                                        {{-- <p>Set Id the let user to touch the device</p> --}}
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-fingerprint"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix ">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
