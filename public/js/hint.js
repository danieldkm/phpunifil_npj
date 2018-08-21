function showHint(id) {
    var popup = document.getElementById(id);
    popup.classList.toggle("show");
}
//mostrar os hints apos a pagina carregar
$(document).ready(function() {
//    if (hasHint){
//        $("#popup").load(showHint("hintBusca"));
//    }
});