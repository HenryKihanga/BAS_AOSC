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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
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
                      <div class="card-body table-responsive p-0" style="max-height: 80%;">
                        @if (count($logs) < 1)
                       <p class="p-4"> There is no log currently </p>
                        @else
                        <table class="table table-head-fixed">
                        {{-- <table class="table table-head-fixed text-nowrap"> --}}
                          <thead>
                            <tr>
                              <th style="width: 10%">ID</th>
                              <th style="width: 30%">Username</th>
                              <th style="width: 15%">Time-in</th>
                              <th style="width: 15%">Time-out</th>
                              <th style="width: 15%">Date</th>
                              <th style="width: 15%">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($logs as $log)
                            <tr>
                              <td style="width: 10%">{{$log->user_id}}</td>
                              <td style="width: 30%">{{$log->user->first_name}} {{$log->user->middle_name}} {{$log->user->last_name}}</td>
                              <td style="width: 15%">{{$log->time_in}}</td>
                              <td style="width: 15%">{{$log->time_out}}</td>
                              <td style="width: 15%">{{$log->date}}</td>
                              <td><span class="badge bg-success">On-time</span></td>
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
