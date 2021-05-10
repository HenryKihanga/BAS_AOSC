<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BAS&AOSC</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">
    @stack('head')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/bas-icon1.png') }}" alt="bas logo" height="60"
                width="60">
        </div> --}}
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul><!-- /.Left navbar links -->

            <div class="navbar-nav ml-auto">

                <li><i class="fas fa-user-circle mr-2"></i></li>
                <li class="breadcrumb-item"><b>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                        {{ Auth::user()->last_name }} </b></li>
                <li class="breadcrumb-item active">
                    @foreach (Auth::user()->roles as $role)
                        {{ $role->name }} ,
                    @endforeach
                </li>


            </div>




        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('img/bas-icon1.png') }}" alt="Bas Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">BAS&AOSC</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2 myNavtab">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item ">
                            <a href="{{ route('home') }}" class="nav-link" onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('addUser') }}" class="nav-link " onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('allUsers', Auth::user()->user_id) }}" class="nav-link"
                                onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('overallLogs')}}" class="nav-link"
                                onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    User Logs
                                </p>
                            </a>
                        </li>
                        @can('manageOrganization')
                            <li class="nav-item">
                                <a href="{{ route('manageOrganization', Auth::user()->user_id) }}" class="nav-link"
                                    onclick="toggle_active_class()">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>
                                        Organizations
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('manageBranch')
                            <li class="nav-item">
                                <a href="{{ route('manageBranch', Auth::user()->user_id) }}" class="nav-link"
                                    onclick="toggle_active_class()">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>
                                        Branches
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('manageDepartment', Auth::user()->user_id) }}" class="nav-link"
                                onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Departments
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('deviceManage', Auth::user()->user_id) }}" class="nav-link"
                                onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-microchip"></i>
                                <p>
                                    Devices
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('showUserProfile', [Auth::user()->user_id]) }}" class="nav-link"
                                onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    View Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-edit"></i>
                                <p>
                                    Edit Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('changePassword') }}" class="nav-link" onclick="toggle_active_class()">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Change Password
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav> <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="wrapper">
            @yield('content')
        </div> <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020-2021.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Final Year Project</b> UDSM COICT
            </div>
        </footer> <!-- /.footer-->
    </div><!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>
    {{-- cdn for swal tost --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- EXTERNAL CUSTOM Js --}}
    <script src="{{ url('js/custom/user.js') }}"></script>
    <script src="{{ url('js/custom/organization.js') }}"></script>
    <script src="{{ url('js/custom/branch.js') }}"></script>
    <script src="{{ url('js/custom/department.js') }}"></script>
    <script src="{{ url('js/custom/device.js') }}"></script>
    <script src="{{ url('js/custom/dashboard.js') }}"></script>
    <script>
        $(document).ready(
            function toggle_active_class() {
                // var url = window.location;
                // $('ul.nav a[href="' + url + '"]').parent().addClass('active');
                // $('ul.nav a').filter(function() {
                //     return this.href == url;
                // }).parent().addClass('active');
                // $(document).ready(function() {
                //     $('.myNavtab li a').click(function(e) {

                //         $('.myNavtab li.active').removeClass('active');

                //         var $parent = $(this).parent();
                //         $parent.addClass('active');
                //         // e.preventDefault();
                //     });
                // });
                var navtab = document.querySelector('.myNavtab').querySelectorAll('a')
                navtab.forEach(element => {
                    element.addEventListener("click", function(e) {
                        navtab.forEach(nav => nav.classList.remove("active"))
                        this.classList.add("active");
                        // e.preventDefault();
                    })
                });
            }
        )

    </script>

    @stack('scripts')

    <!-- Scripts -->

</body>

</html>
