
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

        function change_mode_to_enrollement(device_token){
            Swal.fire({
                // title: 'Are you sure?',
                text: "Do you wanna change mode to enrollment?",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.isConfirmed) {
                    enrollment_mode(device_token)
                }
              })
        }
        function change_mode_to_attendance(device_token){
            Swal.fire({
                // title: 'Are you sure?',
                text: "Do you wanna change mode to attendance?",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if (result.isConfirmed) {
                    attendance_mode(device_token)
                }
              })
        }


