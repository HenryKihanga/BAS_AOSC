@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Logs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">User Logs</li>
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
                <div class="col-12">
                  <div class="card">
                     
                      <div class="card-header">
                        <h3 class="card-title">User Logs Table</h3>
        
                        <div class="card-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="max-height: 300px;">
                        @if (count($logs) < 1)
                       <p class="p-4"> There is no log currently </p>
                        @else
                        <table class="table table-head-fixed text-nowrap">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Username</th>
                              <th>Time-in</th>
                              <th>Time-out</th>
                              <th>Date</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($logs as $log)
                            <tr>
                              <td>{{$log->user_id}}</td>
                              <td>{{$log->user->first_name}} {{$log->user->middle_name}} {{$log->user->last_name}}</td>
                              <td>{{$log->time_in}}</td>
                              <td>{{$log->time_out}}</td>
                              <td>{{$log->date}}</td>
                              {{-- <td><span class="badge bg-success">On-time</span></td> --}}
                              @endforeach
                            </tr>
                          </tbody>
                        </table>
                        @endif
                      </div> <!-- /.card-body --> 
                  </div> <!-- /.card -->
                </div>
              </div>
        </div>
    </section>
@endsection
