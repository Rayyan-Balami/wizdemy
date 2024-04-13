document.addEventListener("DOMContentLoaded", function () {
  const suspendButtons = document.querySelectorAll(".suspend-btn");
  const editButtons = document.querySelectorAll(".edit-btn");
  const deleteButtons = document.querySelectorAll(".delete-btn");
  const viewButtons = document.querySelectorAll(".view-btn");
  const pendingButtons = document.querySelectorAll(".pending-btn");
  const resolvedButtons = document.querySelectorAll(".resolved-btn");


  addHoverEffect(suspendButtons, "rgb(237, 164, 17)"); // Red
  addHoverEffect(editButtons, "rgb(59 130 246)"); // Blue
  addHoverEffect(viewButtons, "rgb(59 130 246)"); // Blue
  addHoverEffect(deleteButtons, "rgb(239 68 68)"); // Red
  addHoverEffect(resolvedButtons, "rgb(16 185 129)"); // Green
  addHoverEffect(pendingButtons, "rgb(237, 164, 17)"); // Red
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


//when presses ctrl + k or / focus on search input
document.addEventListener("keydown", function (e) {
  if ((e.ctrlKey && e.key === "k") || e.key === "/" ) {
    e.preventDefault(); // prevent the default behavior of the key press
    document.getElementById("table-search-input").focus();
  }
});