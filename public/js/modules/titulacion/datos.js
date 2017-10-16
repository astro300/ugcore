/**
 * Created by blacksato on 4/9/2017.
 */
$(function () {
    $("#facultad").on('change', function () {
        $("#carrera").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/Configuraciones/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {

                $.each(_resultContent.data,function(_key, _value){
                    $("#carrera").append("<option value='"+_value.COD_CARRERA+"'>"+_value.NOMBRE+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }
    });

     $("#modulo").on('change', function () {
        $("#etapa").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/Configuraciones-Parametro/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {

                $.each(_resultContent.data,function(_key, _value){
                    $("#etapa").append("<option value='"+_value.CODIGO+"'>"+_value.DESCRIPCION+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }
    });

  

  $.fn.dataTable.ext.errMode = 'throw';
    $('#datosUsuarios').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": '/titulacion/configuraciones-data/',
        "columns": [


            
            {data: 'carrera'},
             {data: 'ciclo'},
            {data: 'etapa'},
             {data: 'fecha_inicio'},
             {data: 'fecha_final'},

             {data: 'acciones', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

 });


//add vplaza

$("#tfacultad").on('change', function () {

    var carrera = 'tCarrera';
    var ruta = '/titulacion/Configuraciones/';
    var value = this.value;
    changeCarrer(carrera, ruta,value);
});

$('#rfacultad').on('change', function () {
    var carrera = 'rCarrera';
    var ruta = '/titulacion/Configuraciones/';
    var value = this.value;
    changeCarrer(carrera, ruta,value);
});

$('#ttfacultad').on('change', function () {
    var carrera = 'ttCarrera';
    var ruta = '/titulacion/Configuraciones/';
    var value = this.value;
    changeCarrer(carrera, ruta,value);
});

$('#excfacultad').on('change', function () {
    var carrera = 'excCarrera';
    var ruta = '/titulacion/Configuraciones/';
    var value = this.value;
    changeCarrer(carrera, ruta,value);
});

function changeCarrer(carrera, ruta, value)
{
    $('#'+carrera+'').html('');
    if(this.value!=''){


        var objApiRest = new AJAXRest(ruta+''+value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {

                $.each(_resultContent.data,function(_key, _value){
                    $('#'+carrera).append("<option value='"+_value.COD_CARRERA+"'>"+_value.NOMBRE+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
    }
}

  


