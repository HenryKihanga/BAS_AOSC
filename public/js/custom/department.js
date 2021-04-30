
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

        function show_edit_department(department_id) {
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
        function editDepartment() {
            Swal.fire({
                title: 'Are you sure you want to edit?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Confirm`,
                denyButtonText: `Denny`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    edit_department_details()
                    Swal.fire('Editted Seccesful', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }