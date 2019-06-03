var popup = document.getElementById("popup-window");
var button = document.getElementById("btn-add");
var closeAction = document.getElementsByClassName("btn-close")[0];

button.onclick = function() {
    popup.style.display = "block";
}

closeAction.onclick = function() {
    popup.style.display = "none";
}

window.onclick = function(event) {
    if(event.target == popup) {
        popup.style.display = "none";
    }
}