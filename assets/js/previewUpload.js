// Get the file input element and the label
var fileInput = document.getElementById('file-thumbnail');
var dropZone = document.querySelector('.file-thumbnail label');

// Add event listeners for drag events
dropZone.addEventListener('dragover', function(e) {
  e.preventDefault();
  this.style.backgroundColor = '#cccccc'; // Add a visual cue that the user can drop a file
});

dropZone.addEventListener('dragleave', function(e) {
  this.style.backgroundColor = ''; // Remove the visual cue
});

dropZone.addEventListener('drop', function(e) {
  e.preventDefault();
  this.style.backgroundColor = ''; // Remove the visual cue

  // Get the dropped files
  var files = e.dataTransfer.files;

  // If a file was dropped, trigger the file input's change event
  if (files.length > 0) {
    fileInput.files = files;
    var event = new Event('change');
    fileInput.dispatchEvent(event);
  }
});

document.getElementById('file-thumbnail').addEventListener('change', function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();
  
    reader.onloadend = function() {
        document.querySelector('.file-thumbnail label').style.backgroundImage = 'url(' + reader.result + ')';
    }
  
    if (file) {
      reader.readAsDataURL(file);
    }
});
//remove image if already uploaded on click
document.querySelector('.file-thumbnail label').addEventListener('click', function (e) {
    if (document.querySelector('.file-thumbnail label').style.backgroundImage != '') {
        e.preventDefault();
        document.querySelector('.file-thumbnail label').style.backgroundImage = '';
        document.getElementById('file-thumbnail').value = '';
    }
});


// for document upload in .pdf format

const fileInput2 = document.getElementById('file-document');
const dropZone2 = document.querySelector('.file-document label');

// Add event listeners for drag events

dropZone2.addEventListener('dragover', function (e) {
    e.preventDefault();
    this.style.backgroundColor = '#cccccc'; // Add a visual cue that the user can drop a file
}
);

dropZone2.addEventListener('dragleave', function (e) {
    this.style.backgroundColor = ''; // Remove the visual cue
}
);

dropZone2.addEventListener('drop', function (e) {
    e.preventDefault();
    this.style.backgroundColor = ''; // Remove the visual cue

    // Get the dropped files
    var files = e.dataTransfer.files;

    // If a file was dropped, trigger the file input's change event
    if (files.length > 0) {
        fileInput2.files = files;
        var event = new Event('change');
        fileInput2.dispatchEvent(event);
    }
}
);




document.getElementById('file-document').addEventListener('change', function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        var iframe = document.createElement('iframe');
        iframe.setAttribute('src', reader.result);
        iframe.setAttribute('height', '100%');
        iframe.setAttribute('width', '100%');
        iframe.setAttribute('frameborder', '0');
        iframe.setAttribute('id', 'doc');
        iframe.style.zIndex = '-1';
        iframe.style.position = 'absolute';
        document.querySelector('.file-document label').appendChild(iframe);
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}
);
//remove image if already uploaded on click

document.querySelector('.file-document label').addEventListener('click', function (e) {
    if (document.querySelector('.file-document label iframe') != null) {
        e.preventDefault();
        document.querySelector('.file-document label iframe').remove();
        document.getElementById('file-document').value = '';
    }
}
);