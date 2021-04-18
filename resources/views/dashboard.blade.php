@extends('layouts.admin')

@push('scripts')
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> --}}
    <script>
        function show_dashboard() {
            $('#dashboard').css('display', 'unset');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            toggle_active_class();


            // show_all_Users();
        }

        function show_add_user() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'unset');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            toggle_active_class();

            // show_all_Users();
        }

        function show_all_users() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'unset');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            toggle_active_class();

            // show_all_Users();
        }

        function show_organization_manage() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'unset');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            toggle_active_class();


            // show_all_Users();
        }

        function show_device_manage() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'unset');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            toggle_active_class();


            // show_all_Users();
        }

        function show_user_profile() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'unset');
            $('#userChangePassword').css('display', 'none');
            toggle_active_class();


            // show_all_Users();
        }

        function show_user_change_password() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'unset');
            toggle_active_class();


            // show_all_Users();
        }

        function toggle_active_class() {
            var navtab = document.querySelector('.myNavtab').querySelectorAll('a')
            navtab.forEach(element => {
                element.addEventListener("click", function() {
                    navtab.forEach(nav => nav.classList.remove("active"))
                    this.classList.add("active");
                })
            });
            // var navitem = document.querySelector('nav > ul > li > a')
            // if (navitem.classList.contains('active')) {
            //     navitem.classList.remove('active')
            // } else {
            //     navitem.classList.add('add')
            // }



        }

        function query_all_Users() {


            let url = "{{ route('showAllUsers') }}";

            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res)

                    res.allUser.map(data => {

                        $('#showAllUsers').append('<div class="well"> name: ' + data.name + ' ID' + data
                            .id + '</div>');
                    });
                }
            });

        }

    </script>
@endpush

@section('content')
    <!-- dashboard -->
    <div id="dashboard">
        @include('subdashboard')
    </div>
    <!-- add user -->
    <div id="addUser" style="display:none;">
        @include('user.addUser')
    </div>

    <div id="allUsers" style="display:none;">
        @include('user.allUsers')
    </div>

    <div id="organizationManage" style="display:none;">
        @include('organization.organizationManage')
    </div>

    <div id="deviceManage" style="display:none;">
        @include('device.deviceManage')
    </div>
    <div id="userProfile" style="display:none;">
        @include('user.profile')
    </div>
    <div id="userChangePassword" style="display:none;">
        @include('user.changePassword')
    </div>

@endsection
