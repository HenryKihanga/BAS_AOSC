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