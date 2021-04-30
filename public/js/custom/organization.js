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

function editOrganization() {
    Swal.fire({
        title: 'Are you sure you want to edit?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        denyButtonText: `Denny`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            edit_organization_details()
            Swal.fire('Editted Seccesful', '', 'success')
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })
}