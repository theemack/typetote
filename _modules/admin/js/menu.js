var obNum = {
  count: function(name) {
      var id = document.getElementsByClassName(name).length;
      return id++;
  }
}

// Add new menu row to form.
function addMenuRow() {

  var div = document.createElement("div");
  div.className= 'menu_obj';
  div.id = 'ob_'+ obNum.count('menu_obj') +'';
  div.innerHTML= `
      <input type="text" name="menu[`+ obNum.count('menu_obj')  +`][name]" placeholder="Menu Name">
      <input type="text" name="menu[`+obNum.count('menu_obj')  +`][path]" placeholder="Menu Path">
      <input type="text" class="obj_order" name="menu[`+ obNum.count('menu_obj')  +`][weight]" value="`+ obNum.count('menu_obj') +`">
      <span class="x" onclick="removeMenu('ob_`+ obNum.count('menu_obj') +`');"><i class="fas fa-ban"></i></span>
      `;
  document.getElementById('menu_well').appendChild(div);
}

// Remove Menu Item
function removeMenu(id) {
  document.getElementById(id).outerHTML = "";
}