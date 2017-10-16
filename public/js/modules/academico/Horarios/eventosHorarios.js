/**
 * Created by jairoman on 2/3/2017.
 */
$(function() {
    $.contextMenu({
        selector: '.context-menu-one',
        callback: function(key, options) {
            if(key=="delete") Eliminar_hora($(this));
            //$(this).css("background-color","#5589DC");
        },
        items: {
            /*"edit": {name: "Edit", icon: "edit"},
            "cut": {name: "Cut", icon: "cut"},
            copy: {name: "Copy", icon: "copy"},
            "paste": {name: "Paste", icon: "paste"},*/
            "delete": {name: "Eliminar", icon: "delete"},
            "sep1": "---------",
            "quit": {name: "Salir", icon: function(){
                return 'context-menu-icon context-menu-icon-quit';
            }}
        },
        events: {
            hide : function(options){

            }}
    });

});

contador = 0;
function allowDrop(ev) {
    ev.preventDefault();
}
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}
function clonar(e){
    var elementoArrastrado = document.getElementById(e.dataTransfer.getData("Data")); // Elemento arrastrado
    elementoArrastrado.style.opacity = '';
    var elementoClonado = elementoArrastrado.cloneNode(true); // Se clona el elemento
    elementoClonado.id = "ElemClonado" + contador; // Se cambia el id porque tiene que ser unico
    contador += 1;
    elementoClonado.style.position = "static";	// Se posiciona de forma "normal" (Sino habria que cambiar las coordenadas de la posición)
    e.target.appendChild(elementoClonado); // Se añade el elemento clonado
    e.target.style.border = 'groove';   // Quita el borde del "cuadro clonador"
}

function start(e) {
    e.dataTransfer.effecAllowed = 'move'; // Define el efecto como mover (Es el por defecto)
    e.dataTransfer.setData("Data", e.target.id); // Coje el elemento que se va a mover
    e.dataTransfer.setDragImage(e.target, 0, 0); // Define la imagen que se vera al ser arrastrado el elemento y por donde se coje el elemento que se va a mover (el raton aparece en la esquina sup_izq con 0,0)
    e.target.style.opacity = '0.4';
}

function Eliminar_hora(opt){
    //opt.remove();
    opt.text("");
    opt.css("border","dotted");
}

$(function() {
    <!-- LLENA COMBO DE CARRERAS CON PARAMETRO DE FACULTAD Y USUARIO-->
    $("#hfacultad").on('change', function () {
        var valueFather = $(this).val();
        var objApiRest = new AJAXRest('/academico/docente/carreras', {fac: valueFather}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent,status) {
            $("#hcarrera").html('');
            if (status != 200) {
                alertToast("La solicitud no obtuvo resultados", 3500);
            } else {
                $("#hcarrera").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent, function (key, value) {
                    $("#hcarrera").append("<option  value=" + key + ">" + value + "</option>");
                });
            }
        });
    });
    <!-- LLENA COMBO DE PLECTIVO CON PARAMETRO DE CARRERAS-->
    $("#hcarrera").on('change', function () {
        var valueFather = $(this).val();
        var objApiRest = new AJAXRest('/academico/docente/periodos', {car: valueFather}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent,status) {
            $("#hplectivo").html('');
            if (status != 200) {
                alertToast("La solicitud no obtuvo resultados", 3500);
            } else {
                $("#hplectivo").append("<option value='' selected='selected'> * SELECCIONE EL PERIODO *</option>");
                $.each(_resultContent, function (key, value) {
                    $("#hplectivo").append("<option  value=" + key + ">" + value + "</option>");
                });
            }
        });
    });
});