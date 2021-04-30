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

function editBranch() {
    Swal.fire({
        title: 'Are you sure you want to edit?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        denyButtonText: `Denny`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            edit_branch_details()
           
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })
}