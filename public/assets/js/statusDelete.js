// Function to open confirmation modal
async function confirmAction(status, targetType) {
  return await openConfirmModal(
    status,
    `Approve "${status}" for this ${targetType}?`
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
  var status = element.getAttribute("data-status");
  if (targetType == "report") {
    if (element.classList.contains("active")) {
      console.log(element.getAttribute("data-status"));
      return;
    }
  }

  const confirmed = await confirmAction(status, targetType);
  if (!confirmed) {
    return false;
  }

  makeAjaxCall(
    "PUT",
    `/api/admin/update/status/${targetType}/${targetId}/${status}`,
   function (response) {
 
  if(targetType == "report") {
    if (status == "pending") {
      element.parentElement.querySelector(".resolved-btn").classList.toggle("active");
    } else {
      element.parentElement.querySelector(".pending-btn").classList.toggle("active");
    }
  }else{
    element.setAttribute("data-status", status == "active" ? "suspend" : "active");
  }

  element.classList.toggle("active");
});
}

// Function to delete
async function deleteData(targetType, targetId, element) {
  var status = "delete";

  const confirmed = await confirmAction(status, targetType);

  if (!confirmed) {
    return false;
  }

  makeAjaxCall(
    "DELETE",
    `/api/admin/delete/${targetType}/${targetId}`,
    function (response) {
      if (response.status == 200) {
        element.closest("tr").remove();
      }else{
        console.log(response);
      }
    }
  );
}


//function to restore 
async function restoreData(targetType, targetId, element) {
 
  const confirmed = await confirmAction("restore", targetType);

  if (!confirmed) {
    return false;
  }

  makeAjaxCall(
    "PUT",
    `/api/admin/restore/${targetType}/${targetId}`,
    function (response) {
      if (response.status == 200) {
        element.closest("tr").remove();
      }else{
        console.log(response);
      }
    }
  );
}
