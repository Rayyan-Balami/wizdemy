// Function to open confirmation modal
async function confirmAction(status) {
  return await openConfirmModal(
    status,
    `Approve "${status}" for this User ?`
  );
}

// Function to make AJAX call
function makeAjaxCall(type, url, successCallback) {
  $.ajax({
    type: type,
    url: url,
    success: successCallback,
  });
}

// Function to update user status
async function updateStatus(targetType, targetId, element) {
  console.log(targetType, targetId, element);
  var status = element.getAttribute("data-status") == "suspend" ? "active" : "suspend";
  if ( targetType =='report')
    status = element.getAttribute("data-status")
  

  const confirmed = await confirmAction(status);

  if (!confirmed) {
    return false;
  }


  makeAjaxCall("PUT", `/api/admin/update/status/${targetType}/${targetId}/${status}`, function (response) {
    console.log(response);
    if (response.status == 200 && status == "active") {
      element.setAttribute("data-status", "active");
    } else {
      element.setAttribute("data-status", "suspend");
    }
  });
}

// Function to delete
async function deleteData(targetType, targetId, element) {
  var status = "delete";

  const confirmed = await confirmAction(status);

  if (!confirmed) {
    return false;
  }

  makeAjaxCall("DELETE", `/api/admin/delete/${targetType}/${targetId}`, function (response) {

    if (response.status == 200) {
      element.closest("tr").remove();
    }
  });
}