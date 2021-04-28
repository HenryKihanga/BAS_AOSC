function show_add_user() {
    all_organizations()
    all_branches()
    all_departments()
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
    $('#editDepartment').css('display', 'none');
    $('#editDevice').css('display', 'none');
    toggle_active_class();
}

function show_all_users() {
    query_all_users()
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
    $('#editDepartment').css('display', 'none');
    $('#editDevice').css('display', 'none');
    toggle_active_class();
}
function show_user(user_id){
        
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
    $('#editDepartment').css('display', 'none');
    $('#editDevice').css('display', 'none');
    toggle_active_class();
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
    $('#editDepartment').css('display', 'none');
    $('#editDevice').css('display', 'none');
    toggle_active_class();
}










