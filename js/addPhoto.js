var i =1;
$("#addPhoto").click(function() {
    $("#gallery").append("<div class='w3-row-padding'><div class='w3-col l3 m4 s12'><img id='imgPreview"+i+"' src='../img/imgPlaceholder.png' style='width:100%;'></div><div class='w3-col l9 m8 s12'><input type='file' name='imageGallery"+i+"' id='imageGallery"+i+"' onchange=\"previewFile('imgPreview"+i+"','imageGallery"+i+"');\"><br><input type='text' name='imageDescription"+i+"' id='imageDescription"+i+"'><br><br></div></div>");
    i += 1;
});