function previewFile(fileID, inputID) {
  var preview = document.getElementById(fileID);
  var file    = document.querySelector('input[id='+inputID+']').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}