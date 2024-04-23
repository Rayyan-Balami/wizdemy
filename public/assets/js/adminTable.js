document.addEventListener("DOMContentLoaded", function () {
  const suspendButtons = document.querySelectorAll(".suspend-btn");
  const editButtons = document.querySelectorAll(".edit-btn");
  const deleteButtons = document.querySelectorAll(".delete-btn");
  const viewButtons = document.querySelectorAll(".view-btn");
  const pendingButtons = document.querySelectorAll(".pending-btn");
  const resolvedButtons = document.querySelectorAll(".resolved-btn");
  const viewPdfButtons = document.querySelectorAll(".view-pdf-btn");
  const viewRespondedMaterialsButtons = document.querySelectorAll(".view-responded-materials-btn");

  addHoverEffect(suspendButtons, "rgb(237, 164, 17)"); // Red
  addHoverEffect(editButtons, "rgb(59 130 246)"); // Blue
  addHoverEffect(viewButtons, "rgb(59 130 246)"); // Blue
  addHoverEffect(deleteButtons, "rgb(239 68 68)"); // Red
  addHoverEffect(resolvedButtons, "rgb(16 185 129)"); // Green
  addHoverEffect(pendingButtons, "rgb(237, 164, 17)"); // Red
  addHoverEffect(viewPdfButtons, "rgb(59 130 246)"); // Blue
  addHoverEffect(viewRespondedMaterialsButtons, "rgb(59 130 246)"); // Blue
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


// Function to handle click event on the download button
document.querySelectorAll('.view-pdf-btn')?.forEach(item => {
  item.addEventListener('click', event => {
      const filePath = item.getAttribute('data-document-path');
      openPopup(filePath);
  });
});



// Function to open the popup and load the PDF
function openPopup(filePath) {
  const pdfOverlay = document.getElementById('pdf-overlay');
  const pdfIframe = document.getElementById('pdf-iframe');
  
  // Set the source of the PDF
  pdfIframe.setAttribute('src', filePath);
  
  // Show the popup and overlay
  pdfOverlay.style.display = 'block';

document.body.classList.toggle("menu-open");

}

// Function to close the popup
function closePopup() {
  const pdfOverlay = document.getElementById('pdf-overlay');
  
  // Hide the popup and overlay
  pdfOverlay.style.display = 'none';

document.body.classList.toggle("menu-open");

}

// Event listener for clicking on the overlay to close the popup
document.getElementById('pdf-overlay')?.addEventListener('click', () => {
  closePopup();
});