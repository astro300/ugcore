/**
 * Created by blacksato on 4/9/2017.
 */


$(function () {

 $('#cedula_estudiante').on('keydown', function (e)
 {
    if (e.which === 9)
    {
        $("#nombre_estudiante").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/trabajo/DatoUsuario/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {
                   $("#nombre_estudiante").append("<option value='' selected='selected'> * SELECCIONE ESTUDIANTE *</option>");

                $.each(_resultContent.data,function(_key, _value){
                    $("#nombre_estudiante").append("<option value='"+_value.COD_ESTUDIANTE+"'>"+_value.NOMBRE_ESTUDIANTE+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }

        $("#carrera_estudiante").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/trabajo/DatoUsuarioEstudianteCarrera/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {
                   $("#carrera_estudiante").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent.data,function(_key, _value){
                    $("#carrera_estudiante").append("<option value='"+_value.COD_CARRERA+"'>"+_value.NOMBRE_CARRERA+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }

      }
    });

    $("#carrera_estudiante").on('change', function () {
        $("#tesis").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/trabajo/DatosTrabajoTitulacion/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {
                   $("#tesis").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent.data,function(_key, _value){
                    $("#tesis").append("<option value='"+_value.COD_TESIS+"'>"+_value.TEMA+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }
    });



    $("#facultad").on('change', function () {
        $("#carrera").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/Configuraciones/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {
                   $("#carrera").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent.data,function(_key, _value){
                    $("#carrera").append("<option value='"+_value.COD_CARRERA+"'>"+_value.NOMBRE+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }
    });

       $("#carrera").on('change', function () {
        $("#ciclo").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/Configuraciones-Plectivo/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {

                  $("#ciclo").append("<option value='' selected='selected'> * SELECCIONE EL PERIODO LECTIVO *</option>");

                $.each(_resultContent.data,function(_key, _value){
                    $("#ciclo").append("<option value='"+_value.COD_PLECTIVO+"'>"+_value.DESCRIPCION+"</option>")
                });
            }else{
                alertToast(_resultContent.message,3000);
            }
        })
        }

           $("#area_investigacion").html('');
        if(this.value!=''){


        var objApiRest = new AJAXRest('/titulacion/trabajo/AreaInvestigacionCarrera/'+this.value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {

                  $("#area_investigacion").append("<option value='' selected='selected'> * SELECCIONE EL ÁREA DE INVESTIGACIÓN *</option>");

                $.each(_resultContent.data,function(_key, _value){
                    $("#area_investigacion").append("<option value='"+_value.N_ID+"'>"+_value.DESCRIPCION+"</option>")
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
                $("#etapa").append("<option value='' selected='selected'> * SELECCIONE LA ETAPA *</option>");
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
        "lengthMenu": [5 ,10, 25, 50, 75, 100 ],
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
            {data: 'tipo'},
             {data: 'fecha_inicio'},
             {data: 'fecha_final'}, 
    

             {data: 'acciones', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

     $.fn.dataTable.ext.errMode = 'throw';
    $('#TrabajoInscripcion').DataTable(
        {
            responsive: true, "oLanguage":
            {
                "sUrl": "/js/config/datatablespanish.json"
            },
            "lengthMenu": [5 ,10, 25, 50, 75, 100 ],
            "aoColumnDefs": [],
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "destroy": true,
            "ajax": '/titulacion/trabajo/tesis-data/',
            "columns":
                [
                    {
                        data: 'tema'
                    },
                    {
                        data: 'facultad'
                    },
                    {
                        data: 'carrera'
                    },
                    {
                        data: 'fecha'
                    },
                    {
                        data: 'acciones',
                        "bSortable": false,
                        "searchable": false,
                        "targets": 0,
                        "render": function(data, type, row )
                        {
                            return   $('<div />').html(row.actions).text();
                        }
                    }
        ],
        "order": []
    }).ajax.reload();

 });



  


