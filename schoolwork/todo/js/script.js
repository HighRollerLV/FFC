function getInput(inputCtrl){
    let form = document.getElementById('form');
    let msg = document.getElementById('list');
    let formData = new FormData(form);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            msg.innerHTML = this.responseText;
        }
    };
    xmlhttp.open("POST", inputCtrl, true);
    xmlhttp.send(formData);
}
function deleteItem(id){
    let msg = document.getElementById('list');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            msg.innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "delete.php?id="+id, true);
    xmlhttp.send();

}