"use strict";

jQuery(document).ready(function(){
  setupSubmit();
  jQuery("#submitButton").hide();
  var edited = false;
  window.addEventListener('beforeunload', checkBeforeClose, false);
  var submitted = false;
  updateSubtypeList();

  if(document.getElementById('submitButton')){
    document.getElementById('submitButton').addEventListener('click', function(){
      submitted = true;
    });
  }

  if(document.getElementById('type')){
    document.getElementById('type').addEventListener('change', updateSubtypeList);
  }

  function setupSubmit(){
    var tables = document.getElementsByTagName('table');

    if(tables.length > 0){
      for(var i=0; i<tables.length; i++){
        var inputs = tables[i].getElementsByTagName('input');
        if(inputs.length > 0){
          for(var j=0; j<inputs.length; j++){
            if(inputs[j].type == 'text'){
              inputs[j].oninput = showSubmit;
            }
            else if(inputs[j].type == 'radio'){
              inputs[j].onclick = showSubmit;
            }
            else{
              inputs[j].onchange = showSubmit;
            }
          }
        }
        var selects = tables[i].getElementsByTagName('select');
        if(selects.length > 0){
          for(var j=0; j<selects.length; j++){
            selects[j].oninput = showSubmit;
          }
        }
        var textareas = tables[i].getElementsByTagName('textarea');
        if(textareas.length > 0){
          for(var j=0; j<textareas.length; j++){
            textareas[j].oninput = showSubmit;
          }
        }
      }
    }
  }

  function showSubmit(){
    jQuery('#submitButton').fadeIn(1000);
    if(!edited){
      edited = true;
      document.title = "*" + document.title;
    }
  }

  function checkBeforeClose(e){
    if (edited && !submitted) {
      (e || window.event).returnValue = "Form elements have changed. If you leave this page now, all unsaved changes will be lost.";
     }
  }

  function updateSubtypeList(){
    var typeElement = document.getElementById("type");

    if(typeElement){
      var type = typeElement.options[typeElement.selectedIndex].value;
      var subtypeElement = document.getElementById("subtype");
      for(var i=0; i<subtypeElement.length; i++){
        var current = subtypeElement.options[i];
        if(type == current.value.split("|")[0]){
          current.disabled = false;
        }
        else{
          current.disabled = true;
        }
      }
    }
  }

  function gotoImage(id){
    var myForm = document.getElementById('primaryForm');
    if(myForm){
      var urlElements = myForm.getElementsByName('picture_url_' + id);
      if(urlElements.length > 0){
        var url = urlElements[0].value;
        window.location.assign("../uploads/" + url);
      }
    }
  }
});
