@extends('layouts.admin')
@push('scripts')
<script src="{{ url('js/custom/user.js') }}"></script>
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
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'none');
            toggle_active_class();
        }
        function show_organization_manage() {
            query_latest_organizations();
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
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'none');
            toggle_active_class();
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
            $('#editDevice').css('display', 'none');
            $('#editDepartment').css('display', 'none');
            toggle_active_class();
        }



        function show_edit_device(id) {
            let device_id = id;
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
            $('#editBranch').css('display', 'none');
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'unset');

            // populate_department_data_for_editing(device_id);
            toggle_active_class();
        }

        function show_edit_department(id) {
            let department_id = id;
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
            $('#editBranch').css('display', 'none');
            $('#editDepartment').css('display', 'unset');
            $('#editDevice').css('display', 'none');

            populate_department_data_for_editing(department_id);
            toggle_active_class();
        }

        function populate_department_data_for_editing(id) {
            let url = "{{ route('showOneDepartment', 100) }}"
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result)
                    // Set data to the edit organization form
                    document.getElementById("oldDepartmentName").value = result.department.department_name;
                    document.getElementById("oldDepartmentNumber").value = result.department
                        .department_phone_number;
                    document.getElementById("oldDepartmentEmail").value = result.department.department_email;
                    document.getElementById("oldDepartmentAddress").value = result.department
                        .department_address;
                }
            });
        }


        function show_edit_branch(branch_id) {
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
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'none');
            populate_branch_data_for_editing(branch_id);
            toggle_active_class();
        }

        function populate_branch_data_for_editing(branch_id) {
            let base_url = '{{ url('') }}'
            let path = "/branch/showOne/" + branch_id;
            url = base_url + path
            alert(url)
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    // Set data to the edit organization form
                    document.getElementById("branchIdToAddDeparement").value = result.branch.branch_id;
                    document.getElementById("branchRegistrationNumber").value = result.branch.branch_id;
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
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'none');
            populate_organization_data_for_editing(organization_id);
            toggle_active_class();
        }

        function populate_organization_data_for_editing(id) {
            let base_url = '{{ url('') }}'
            let path = "/organization/showOne/" + id;
            url = base_url + path
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(result) {
                    document.getElementById("registrationNumber").value = result.organization.organization_id;
                    document.getElementById("organizationId").value = result.organization.organization_id;
                    document.getElementById("name").value = result.organization.organization_name;
                    document.getElementById("number").value = result.organization.organization_phone_number;
                    document.getElementById("email").value = result.organization.organization_email;
                    document.getElementById("address").value = result.organization.organization_address;
                }
            });
        }

        function show_manage_branch() {
            all_organizations();
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
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'none');
            toggle_active_class();
        }

        function show_manage_department() {
            all_organizations();
            all_branches();
            query_all_departments();
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
            $('#editDepartment').css('display', 'none');
            $('#editDevice').css('display', 'none');
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



        function add_branch() {
            let url = "{{ route('storeBranch') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('addBranchForm')),
                contentType: false,
                processData: false,
                success: function(res) {
                   
                }
            });
        }
        function edit_organization_details() {
            let url = "{{ route('updateOrganization') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(document.getElementById('editOrganizationForm')),
                contentType: false,
                processData: false,
                success: function(res) {

                }
            });
        }

        function all_organizations() {
            let url = "{{ route('showAllOrganizations') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('.inputOrganizations').html('')
                    res.organizations.map(organization => {

                        $('.inputOrganizations').append('<option  value="' + organization
                            .organization_id + '"><a onclick="organization_branches()">' + organization.organization_name + '</a></option>');
                    });
                }
            });
        }

        function organization_branches(){
            console.log("BOOOOOOOOOOOOOOOOOM")
        }
        function all_branches() {
            let url = "{{ route('showAllBranches') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('.inputBranches').html('')
                    res.branches.map(branch => {
                        $('.inputBranches').append('<option value="' + branch.branch_id + '">' + branch.branch_name + '</option>');
                    });
                }
            });
        }
        function all_departments() {
            let url = "{{ route('showAllDepartments') }}";
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function(res) {
                    $('.inputDeparments').html('')
                    res.departments.map(department => {
                        $('.inputDeparments').append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
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
    <div id="organizationEdit" style="display:none;">
        @include('organization.editOrganization')
    </div>
    <div id="manageBranch" style="display:none;">
        @include('branch.manageBranch')
    </div>
    <div id="deviceManage" style="display:none;">
        @include('device.deviceManage')
    </div>
    <div id="editDevice" style="display:none;">
        @include('device.editDevice')
    </div>
    <div id="editBranch" style="display:none;">
        @include('branch.editBranch')
    </div>
    <div id="manageDepartment" style="display:none;">
        @include('department.manageDepartment')
    </div>
    <div id="editDepartment" style="display:none;">
        @include('department.editDepartment')
    </div>
    <div id="userProfile" style="display:none;">
        @include('user.profile')
    </div>
    <div id="userChangePassword" style="display:none;">
        @include('user.changePassword')
    </div>

@endsection
