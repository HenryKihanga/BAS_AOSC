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
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
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
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
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
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
            toggle_active_class();

            // show_all_Users();
        }

        function show_organization_manage() {
            query_all_organizations();
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'unset');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
            toggle_active_class();


            // show_all_Users();
        }

        function show_device_manage() {
            query_all_devices();
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'unset');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
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
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
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
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
            toggle_active_class();


            // show_all_Users();
        }

        function show_edit_branch(id) {
            let branch_id = id;
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'unset');
            populate_branch_data_for_editing(branch_id);
            toggle_active_class();

        }

        function populate_branch_data_for_editing(id) {
            let url = "{{ route('showOneBranch', 1 ) }}"
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    // Set data to the edit organization form
                    document.getElementById("branchRegno").value = result.branch.branch_id;
                    document.getElementById("branchName").value = result.branch.branch_name;
                    document.getElementById("branchNumber").value = result.branch.branch_phone_number;
                    document.getElementById("branchEmail").value = result.branch.branch_email;
                    document.getElementById("branchAddress").value = result.branch.branch_address;
                }
            });


        }
        function show_edit_organization(id) {
            let organization_id = id;
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            $('#organizationEdit').css('display', 'unset');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
            populate_organization_data_for_editing(organization_id);
            toggle_active_class();

        }

        function populate_organization_data_for_editing(id) {
            let url = "{{ route('showOneOrganization', 20 ) }}"
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    // Set data to the edit organization form
                    document.getElementById("regno").value = result.organization.organization_id;
                    document.getElementById("name").value = result.organization.organization_name;
                    document.getElementById("number").value = result.organization.organization_phone_number;
                    document.getElementById("email").value = result.organization.organization_email;
                    document.getElementById("address").value = result.organization.organization_address;
                }
            });


        }



    

        function show_manage_branch() {
           
            query_all_branches();
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'unset');
            $('#manageDepartment').css('display', 'none');
            $('#editBranch').css('display', 'none');
            
            toggle_active_class();

        }

        

     

        function show_manage_department() {
            $('#dashboard').css('display', 'none');
            $('#addUser').css('display', 'none');
            $('#allUsers').css('display', 'none');
            $('#organizationManage').css('display', 'none');
            $('#deviceManage').css('display', 'none');
            $('#userProfile').css('display', 'none');
            $('#userChangePassword').css('display', 'none');
            $('#organizationEdit').css('display', 'none');
            $('#manageBranch').css('display', 'none');
            $('#manageDepartment').css('display', 'unset');
            $('#editBranch').css('display', 'none');
            toggle_active_class();

        }


        function show_add_branch() {
            $('#addBranchForm').css('display', 'unset')
        }

        function toggle_active_class() {
            var navtab = document.querySelector('.myNavtab').querySelectorAll('a')
            navtab.forEach(element => {
                element.addEventListener("click", function() {
                    navtab.forEach(nav => nav.classList.remove("active"))
                    this.classList.add("active");
                })
            });

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


        function store_branch_and_exit(organization_id) {
            console.log(organization_id);
            
            let url = "{{ route('storeBranch',30) }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res.success)

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
    <div id="organizationEdit" style="display:none;">
        @include('organization.editOrganization')
    </div>
    <div id="manageBranch" style="display:none;">
        @include('branch.manageBranch')
    </div>
    <div id="deviceManage" style="display:none;">
        @include('device.deviceManage')
    </div>
    <div id="editBranch" style="display:none;">
        @include('branch.editBranch')
    </div>
    <div id="manageDepartment" style="display:none;">
        @include('department.manageDepartment')
    </div>
    <div id="userProfile" style="display:none;">
        @include('user.profile')
    </div>
    <div id="userChangePassword" style="display:none;">
        @include('user.changePassword')
    </div>

@endsection
