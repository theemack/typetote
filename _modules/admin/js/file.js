// this file on click should get the data id value, then somehow it needs to pass into the parent which is the main page
function placeFile(file) {

  var img = `<br><span class="emb-image-well"><img src="`+ file + `" class="emb-image"></span>`;
  window.top.document.execCommand("insertHTML",false, img);
  window.top.document.execCommand("insertLineBreak");
  window.top.document.getElementById("img_upload_well").classList.toggle("hide");
  copyText('wysiwyg_editor', 'page_data');
  
}

// Toggle div.
function toggle(elm) {
  document.getElementById(elm).classList.toggle('hide');
}

// Toggle, close hide upload form.
function closeParent(elm) {
  parent.top.document.getElementById(elm).classList.toggle('hide');
}