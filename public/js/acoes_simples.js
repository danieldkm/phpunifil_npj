"use strinct";

//let mostrarTodosAtributos = {
//    var1: ''
//}

//document.getElementById("testandoPO").onkeypress = function(evt) {
//    mostrarTodosAtributos.var1 = evt;
//    console.log(evt);
//}

function showAtributos(x){
    mostrarTodosAtributos.var1 = x;
    console.log(mostrarTodosAtributos);
}


function cleanForm(btn){
//    teste.var1 = btn;
//    console.log("mostrarTodosAtributos " + btn.value);
    document.getElementById(btn.value).reset();
}

function clique(id){
//    console.log("id " + id);
    document.getElementById(id).click();
}

function showAlerta() {
//    console.log("showAlerta()");
    document.getElementById("alerta").click();
    $timer = setTimeout(hideAlerta, 3000);
}

function hideAlerta(){
    $.noty.closeAll();
    clearTimeout($timer);
}

function showAlerta(popular, tabela) {
//    console.log("showAlerta(popular, tabela)");
    document.getElementById("alerta").click();
    $timer = setTimeout(hideAlerta, 3000);
    
//    if (popular){
//        $("#tabelaPopulada").remove();
//        showLoad(tabela);
//    }
}

function hideLoad(){
    $("#LoadAguarde").hide();
}

function showLoad(tabela){
    $("#LoadAguarde").show();
}

function hideLoadingModal(id){
    $("#"+id).modal("hide");
    $("#"+id).hide();
//    setTimeout($.unblockUI, 1000);
};

function showLoadingModal(id){
    $("#"+id).modal("show");
};

function inputFocus (elem){
    elem.style.background = "#F9F9CC";
}
function inputFocusOut(elem){
    elem.style.background = "white";
}

 $.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
function whenClick(id){
    $('#'+id).animateCss('bounce');
}

function bounceAnimated(id){
    $('#'+id).animateCss('bounce');
}

function flipAnimated(id){
    $('#'+id).animateCss('flip');
}