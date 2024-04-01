function updateUserStatus(userId, element) {
    var status = element.getAttribute('data-status') == "suspend" ? "active" : "suspend";
    if (!confirm("Are you sure you want to " + status + " this user?")) {
        return false;
    }
    var data = {
        user_id: userId,
        status: status
    };
    $.ajax({
        type: 'POST',
        url: '/api/admin/manage/users/updateStatus',
        data: data,
        success: function (response) {
            console.log(response);
            if (response.status == 200 && status == "active") {
                element.setAttribute('data-status', 'active');
            } else {
                element.setAttribute('data-status', 'suspend');
            }
        }
    }
    );

}