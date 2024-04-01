document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".edit-btn");
  const deleteButtons = document.querySelectorAll(".delete-btn");

  addHoverEffect(editButtons, "rgb(59, 130, 246)"); // Blue
  addHoverEffect(deleteButtons, "rgb(255, 0, 0)"); // Red
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
