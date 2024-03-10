const fileUploadSection = document.querySelector(".file-upload-section label");
const fileUploadMessage = fileUploadSection.querySelector(".file-upload-message");

const tempInput = document.getElementById("tempFile");

const imageInput = document.getElementById("imageFile");
const imagePreview = document.getElementById("image-file-preview");

const documentInput = document.getElementById("documentFile");
const documentPreview = document.getElementById("document-file-preview");

// drag and drop event listeners for file upload section
fileUploadSection.addEventListener("dragover", (e) => {
  e.preventDefault();
  blueStyleFileSection();
});

fileUploadSection.addEventListener("dragleave", (e) => {
  e.preventDefault();
  updateFileMessage("");
  normalStyleFileSection();
});

fileUploadSection.addEventListener("drop", (e) => {
  e.preventDefault();
  const file = e.dataTransfer.files[0];
  handleFile(file);
});

//simple browse button event listeners
tempInput.addEventListener("change", (e) => {
  const file = e.target.files[0];
  handleFile(file);
});

function handleFile(file) {
  if(!file) {
    updateFileMessage("No file selected");
    warningStyleFileSection();
    return;
  }
  let fileValidation = validateFile(file);
  if(!fileValidation.status) {
    updateFileMessage(fileValidation.message);
    errorFileSection();
    return;
  }
  updateFileMessage("");
  //remove file from temp input
  tempInput.value = "";
  blueStyleFileSection();


  let fileList = new DataTransfer();
  //check if image is empty
  if(imageInput.files.length === 0 && fileValidation.type === "image") {
    // ypeError: The HTMLInputElement.files attribute must be an instance of FileList
    fileList.items.add(file);
    imageInput.files = fileList.files;
    imagePreview.querySelector("img").style.display = "block";
    imagePreview.querySelector("img").src = URL.createObjectURL(file);
    imagePreview.querySelector(".file-name").textContent = file.name + " - ";
    imagePreview.querySelector(".file-info").style.display = "flex";
    imagePreview.querySelector(".file-size").textContent = (file.size / (1024 * 1024)).toFixed(2) + "MB";
    updateFileMessage("Image selected. You can upload a document now");
    blueStyleFileSection();
  }else if(documentInput.files.length === 0 && fileValidation.type === "document") {
    fileList.items.add(file);
    documentInput.files = fileList.files;
    documentPreview.querySelector("span").textContent = file.name;
    documentPreview.querySelector(".file-name").textContent = file.name + " - ";
    documentPreview.querySelector(".file-info").style.display = "flex";
    documentPreview.querySelector(".file-icon").style.display = "block";
    documentPreview.querySelector(".file-size").textContent = (file.size / (1024 * 1024)).toFixed(2) + "MB";
    updateFileMessage("Document selected. You can upload an image now");
    blueStyleFileSection();
  }else{
    updateFileMessage(`${fileValidation.type} is already selected`);
    warningStyleFileSection();
  }

   //checking if both image and document are in the input
   if(imageInput.files.length > 0 && documentInput.files.length > 0) {
    updateFileMessage("Both image and document selected");
    successStyleFileSection();
    //disable file upload section
    tempInput.disabled = true;
    //disable drag and drop
    fileUploadSection.style.pointerEvents = "none";
    return;
  }
}

function validateFile(file) {
  const validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
  const validDocumentTypes = ["application/pdf"];
  const imageMaxSize = 2 * 1024 * 1024; // 2MB
  const documentMaxSize = 5 * 1024 * 1024; // 5MB

  if (validImageTypes.includes(file.type)) {
    return file.size <= imageMaxSize
      ? { status: true, type: "image" }
      : { status: false, message: "Image size should be less than 2MB" };
  }

  if (validDocumentTypes.includes(file.type)) {
    return file.size <= documentMaxSize
      ? { status: true, type: "document" }
      : { status: false, message: "Document size should be less than 5MB" };
  }

  return {
    status: false,
    message:
      "Invalid file type<br>Image [ jpeg, png, jpg, gif ] & Document [ pdf ]",
  };
}

//remove file from input
function removeFile(type) {
  if (type === "image") {
    imageInput.value = "";
    imagePreview.querySelector("img").src = "";
    imagePreview.querySelector("img").style.display = "none";
    imagePreview.querySelector(".file-name").textContent = "";
    imagePreview.querySelector(".file-info").style.display = "none";
    updateFileMessage("Image removed. You can upload an image now");
    blueStyleFileSection();
  }
  if (type === "document") {
    documentInput.value = "";
    documentPreview.querySelector("span").textContent = "";
    documentPreview.querySelector(".file-name").textContent = "";
    documentPreview.querySelector(".file-info").style.display = "none";
    documentPreview.querySelector(".file-icon").style.display = "none";
    updateFileMessage("Document removed. You can upload a document now");
    blueStyleFileSection();
  }

  //check if both image and document are removed
  if (imageInput.files.length === 0 && documentInput.files.length === 0) {
    updateFileMessage("Both image and document were removed");
    normalStyleFileSection();
  }

  //enable file upload section
  tempInput.disabled = false;
  //enable drag and drop
  fileUploadSection.style.pointerEvents = "auto";
}

//remove temp file from input when form is submitted
document.getElementById("uploadForm").addEventListener("submit", (e) => {
  tempInput.value = "";
});

//utilty functions

function updateFileMessage(message) {
  fileUploadMessage.innerHTML = message;
}

function normalStyleFileSection() {
  fileUploadSection.style.borderColor = "#e5e7eb";
  fileUploadSection.style.backgroundColor = "white";
}

function warningStyleFileSection() {
  fileUploadSection.style.borderColor = "#ffeb3b";
  fileUploadSection.style.backgroundColor = "rgba(255, 235, 59, 0.1)";
}

function errorFileSection() {
  fileUploadSection.style.borderColor = "#f44336";
  fileUploadSection.style.backgroundColor = "rgba(244, 67, 54, 0.1)";
}

function successStyleFileSection() {
  fileUploadSection.style.borderColor = "#4CAF50";
  fileUploadSection.style.backgroundColor = "rgba(76, 175, 80, 0.1)";
}

function blueStyleFileSection() {
  fileUploadSection.style.borderColor = "#2196F3";
  fileUploadSection.style.backgroundColor = "rgba(33, 150, 243, 0.1)";
}