function editLocation(elmt){
    var row = elmt.parentElement.parentElement.parentElement;
    var textBefore = row.children[1].children[0].value;
    row.children[1].children[0].disabled = false;
    row.children[2].children[0].children[0].innerHTML = "done";
    row.children[2].children[0].children[0].style.color = "#02702C";
    row.children[2].children[1].children[0].innerHTML = "clear";
    row.children[2].children[1].children[0].style.color = "red";
    row.children[2].children[0].children[0].onclick = function(){ saveLocation(elmt, textBefore)};
    row.children[2].children[1].children[0].onclick = function(){ cancelLocation(elmt, textBefore)};
}

function saveLocation(elmt, textBefore){
    var row = elmt.parentElement.parentElement.parentElement;
    row.children[1].children[0].disabled = true;
    row.children[2].children[0].children[0].innerHTML = "mode_edit";
    row.children[2].children[0].children[0].style.color = "orange";
    row.children[2].children[1].children[0].innerHTML = "delete";
    row.children[2].children[1].children[0].style.color = "red";
    row.children[2].children[0].children[0].onclick = function(){ editLocation(elmt)};
    row.children[2].children[1].children[0].onclick = function(){ deleteLocation(elmt)};
    var text = encodeURI(row.children[1].children[0].value);
    textBefore = encodeURI(textBefore);
    var xmlhttp = new XMLHttpRequest();
    if(!xmlhttp){
        return;
    }
    var url = "editlocationhandler.php?id_active="+ id + "&update=" + text + "&location=" + textBefore;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    location.reload();
}

function cancelLocation(elmt, text){
    var row = elmt.parentElement.parentElement.parentElement;
    row.children[1].children[0].value = text;
    row.children[1].children[0].disabled = true;
    row.children[2].children[0].children[0].innerHTML = "mode_edit";
    row.children[2].children[0].children[0].style.color = "orange";
    row.children[2].children[1].children[0].innerHTML = "delete";
    row.children[2].children[1].children[0].style.color = "red";
    row.children[2].children[0].children[0].onclick = function(){ editLocation(elmt)};
    row.children[2].children[1].children[0].onclick = function(){ deleteLocation(elmt)};
}

function deleteLocation(elmt){
    if (confirm("Are you sure deleting the location ?") == true) {
        var row = elmt.parentElement.parentElement.parentElement;
        var text = encodeURI(row.children[1].children[0].value);
        var xmlhttp = new XMLHttpRequest();
        if(!xmlhttp){
            return;
        }
        var url = "editlocationhandler.php?id_active="+ id + "&delete=" + text;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        location.reload();        
    }
}