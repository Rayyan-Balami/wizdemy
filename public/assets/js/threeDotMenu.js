const cards = document.querySelectorAll(".card");
const threeDotMenu = document.getElementById("three-dot-menu");
const threeDotMenuCopyLink = document.getElementById("copy-link");
const threeDotMenuEditForm = document.getElementById("edit-form");
const threeDotMenuDeleteButton = document.getElementById("delete-button");

function openThreeDotMenu(element) {
  const copyLink = element.getAttribute("data-copy-link");
  const editLink = element.getAttribute("data-edit-link");
  const deleteLink = element.getAttribute("data-delete-link");

  threeDotMenuCopyLink.setAttribute("data-copy-link", copyLink);
  threeDotMenuEditForm?.setAttribute("action", editLink);
  threeDotMenuDeleteButton?.setAttribute("data-delete-link", deleteLink);
  threeDotMenuDeleteButton?.setAttribute(
    "data-material-id",
    element.getAttribute("data-material-id")
  );

  threeDotMenu.classList.add("open");
  document.body.classList.add("menu-open");
}
function copyLink() {
  const link = threeDotMenuCopyLink.getAttribute("data-copy-link");
  navigator.clipboard.writeText(link).then(() => {
    console.log("Link copied to clipboard");
  });
}
async function deleteMaterial(element) {
  const link = element.getAttribute("data-delete-link");
  console.log(link);
  const materialId = element.getAttribute("data-material-id");
  const confirmed = await openConfirmModal(
    "delete",
    "Do you want to delete this material ?"
  );
  if (!confirmed) {
    return false;
  }
 $.ajax({
  type: "DELETE",
  url: link,
  success: function (response) {
    console.log(response);
    if (response.status == 200) {
      if (response.data.status) {
        $(".card[data-material-id='" + materialId + "']").remove();
        const materialCardSection = document.querySelector(".card-section");
        if (materialCardSection.children.length == 0) {
          const cardCategory = document.querySelector(".card-category-wrapper");
          cardCategory.insertAdjacentHTML('afterend', ZeroResult('profile'));
        }
      }
    }
  },
});
}
function closeThreeDotMenu() {
  threeDotMenu.classList.remove("open");
  document.body.classList.remove("menu-open");
}
