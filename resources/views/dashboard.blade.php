@extends('layouts.admin')
@push('scripts')
    <script src="{{ url('js/custom/user.js') }}"></script>
    <script src="{{ url('js/custom/organization.js') }}"></script>
    <script src="{{ url('js/custom/branch.js') }}"></script>
    <script src="{{ url('js/custom/department.js') }}"></script>
    <script src="{{ url('js/custom/device.js') }}"></script>
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








      

 







     

        function toggle_active_class() {
            var navtab = document.querySelector('.myNavtab').querySelectorAll('a')
            navtab.forEach(element => {
                element.addEventListener("click", function() {
                    navtab.forEach(nav => nav.classList.remove("active"))
                    this.classList.add("active");
                })
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
                            .organization_id + '"><a onclick="organization_branches()">' +
                            organization.organization_name + '</a></option>');
                    });
                }
            });
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
                        $('.inputBranches').append('<option value="' + branch.branch_id + '">' + branch
                            .branch_name + '</option>');
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
                        $('.inputDeparments').append('<option value="' + department.department_id +
                            '">' + department.department_name + '</option>');
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
