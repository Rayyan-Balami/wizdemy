document.addEventListener("DOMContentLoaded", function () {
  const suspendButtons = document.querySelectorAll(".suspend-btn");
  const editButtons = document.querySelectorAll(".edit-btn");
  const deleteButtons = document.querySelectorAll(".delete-btn");
  const viewButtons = document.querySelectorAll(".view-btn");


  addHoverEffect(suspendButtons, "rgb(237, 164, 17)"); // Red
  addHoverEffect(editButtons, "rgb(59 130 246)"); // Blue
  addHoverEffect(deleteButtons, "rgb(239 68 68)"); // Red
  addHoverEffect(viewButtons, "rgb(16 185 129)"); // Green
});

function addHoverEffect(buttons, color) {
  buttons.forEach((button) => {
    button.addEventListener("mouseover", () => {
      const parentRow = button.closest("tr");
      parentRow.style.borderLeftColor = color;
      parentRow.style.borderRightColor = color;
    });
    
    button.addEventListener("mouseout", () => {
      const parentRow = button.closest("tr");
      parentRow.style.borderLeftColor = "";
      parentRow.style.borderRightColor = "";
    });
  });
}
