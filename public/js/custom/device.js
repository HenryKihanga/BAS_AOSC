
        function show_device_manage() {
            all_organizations();
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
