$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    $('#AdmMateriasCursos').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/extcore/js/config/datatablespanish.json"
        },
        "lengthMenu": [[5, -1], [5, "All"]],
        //"order": [[2]],
        "searching": false,
        "info": false,
        "ordering": true,
        "bPaginate": true,
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": "/uath/formacion/listamaterias",
        "columns": [
            {data: 'NOMBRE_MATERIA'},
            {data: 'DESCRIPCION'},
            {data: 'ESTADO'},
            {data: 'OPCIONES'}
        ]
    }).ajax.reload();

    $('#AdmGruposCursos').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/extcore/js/config/datatablespanish.json"
        },
        "lengthMenu": [[5, -1], [5, "All"]],
        "order": [[2]],
        "searching": false,
        "info": false,
        "ordering": false,
        "bPaginate": true,
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": "/uath/formacion/listagrupos",
        "columns": [
            {data: 'NOMBRE_GRUPO'},
            {data: 'NOMBRE_MATERIA'},
            {data: 'NOMBRE_INSTRUCTOR'},
            {data: 'FECHAINI'},
            {data: 'FECHAFIN'},
            {data: 'ESTADO'},
            {data: 'OPCIONES'}
        ]
    }).ajax.reload();

    $('.pickadate-limits').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $("#selgrupos").select2().on('change', function() {
        var valueFather=$("#selgrupos option:selected").val()==''?0:$("#selgrupos option:selected").val();
        $("#nomgrupo").text("GRUPO: "+$("#selgrupos option:selected").text());
        $('#AdmAsignacion').DataTable({
            responsive: true, "oLanguage": {
                "sUrl": "/extcore/js/config/datatablespanish.json"
            },
            "lengthMenu": [[5, -1], [5, "All"]],
            "order": [[2]],
            "searching": false,
            "info": false,
            "ordering": false,
            "bPaginate": true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "destroy": true,
            "ajax": "/uath/formacion/listaasignacion/"+valueFather,
            "columns": [
                {data: 'CEDULA'},
                {data: 'APELLIDOS'},
                {data: 'NOMBRES'},
                {data: 'ASISTENCIA'},
                {
                    data: 'ESTADOMATERIA',
                    "render": function ( data, type, row ) {
                        var datoBase=data;
                        var estado='';
                        switch (datoBase){
                            case 'I':
                                estado='Inscrito';
                                break;
                            case 'A':
                                estado='Aprobado';
                                break;
                            case 'R':
                                estado='Reprobado';
                                break;
                        }
                        return estado;
                    }
                },
                {
                    data: 'ENVIOCORREO',
                    "render": function ( data, type, row ) {
                        var datoBase=data;
                        var envio='';
                        switch (datoBase){
                            case '0':
                                envio='NO';
                                break;
                            case '1':
                                envio='SI';
                                break;
                        }
                        return envio;
                    }
                },
                {data: 'OPCIONES'}
            ]
        }).ajax.reload();
    });

    $('#bcedula').on('keypress', function (e) {
        if(e.which === 13){
            var cedula=$("#bcedula").val();
            var objApiRest=new AJAXRest('/uath/formacion/buscanombres/'+cedula,{},'GET');
            objApiRest.extractDataAjax(function(_resultContent){
                if(_resultContent!='0'){
                    $("#cedula").val(_resultContent[0].CEDULA);
                    $("#apellidos").val(_resultContent[0].APELLIDOS);
                    $("#nombres").val(_resultContent[0].NOMBRES);
                    $("#email").val(_resultContent[0].EMAIL);
                }
                else{
                    alertToast('La cédula '+cedula+ ' no existe en los registros de la UG',3200);
                }
            });
        }
    });
});

function guardaMateria(){
    var id=$("#txtid").val();
    if($("#txtid").val()==""){
        <!-- GUARDA LA MATERIA DEL CURSO A DICTARSE-->
        var objApiRest=new AJAXRest('/uath/formacion/guardamateria',{
            materia:$("#materia").val(),
            observacion:$("#observacion").val(),
            estado:$("#estado").val()
        },'post');
        objApiRest.extractDataAjax(function(_resultContent){
            if(_resultContent.status==200){
                $('#AdmMateriasCursos').dataTable()._fnAjaxUpdate();
                alertToastSuccess(_resultContent.message,3500);
            }else{
                alertToast(_resultContent.message,3500);
            }
        });
    }
    else{
        <!-- ATUALIZA LA MATERIA DEL CURSO A DICTARSE-->
        var objApiRest=new AJAXRest('/uath/formacion/actualizamateria/'+id,{
            materia:$("#materia").val(),
            observacion:$("#observacion").val(),
            estado:$("#estado").val()
        },'post');
        objApiRest.extractDataAjax(function(_resultContent){
            if(_resultContent.status==200){
                $('#AdmMateriasCursos').dataTable()._fnAjaxUpdate();
                alertToastSuccess(_resultContent.message,3500);
            }else{
                alertToast(_resultContent.message,3500);
            }
        });
    }
}

function enceraModal() {
    $("#materia").val("");
    $("#observacion").val("");
    $("#estado").select2();
    $('#estado option').eq(0).prop('selected', true);
    $("#estado").select2();
}

function enceraModalGrupo(){
    $("#grupo").val("");
    $("#instructorc").val("");
    $("#instructorn").val("");
    $("#fecini").val("");
    $("#fecfin").val("");
    $('#selmateria option').eq(0).prop('selected', true);
    $("#selmateria").select2();
    $('#estadog option').eq(0).prop('selected', true);
    $("#estadog").select2();

    var objApiRest=new AJAXRest('/uath/formacion/listamateriascombo',{},'post');
    objApiRest.extractDataAjax(function(_resultContent){
        $("#selmateria").html('');
        $("#selmateria").select2("val", "");
        if(_resultContent.length==0){
            alertToast( "La solicitud no obtuvo resultados",3500);
        }else{
            $("#selmateria").append("<option value='' selected='selected'> * Seleccione *</option>");
            $.each(_resultContent, function(key, value) {
                $("#selmateria").append("<option  value="+key+">"+value+"</option>");

            });
        }
        $("#selmateria").select2();
    });
}

function verMateria(id_){
    var objApiRest=new AJAXRest('/uath/formacion/editamateria/'+id_,{},'GET');
    objApiRest.extractDataAjax(function(_resultContent){
        $("#materia").val(_resultContent[0].NOMBRE_MATERIA);
        $("#observacion").val(_resultContent[0].DESCRIPCION);
        if(_resultContent[0].ESTADO=='A'){
            $('#estado option').eq(1).prop('selected', true);
        }
        else{
            $('#estado option').eq(2).prop('selected', true);
        }
        $("#estado").select2();
        $("#txtid").val(id_);
    });
}

function verGrupo(id_){
    /*LLENA COMBO CON LAS MATERIAS*/
    var objApiRest=new AJAXRest('/uath/formacion/listamateriascombo',{},'post');
    objApiRest.extractDataAjax(function(_resultContent){
        $("#selmateria").html('');
        $("#selmateria").select2("val", "");
        if(_resultContent.length==0){
            alertToast( "La solicitud no obtuvo resultados",3500);
        }else{
            $("#selmateria").append("<option value='' selected='selected'> * Seleccione *</option>");
            $.each(_resultContent, function(key, value) {
                $("#selmateria").append("<option  value="+key+">"+value+"</option>");

            });
        }
        $("#selmateria").select2();
    });
    /*FIN LLENA COMBO CON LAS MATERIAS*/
    var objApiRest=new AJAXRest('/uath/formacion/editagrupo/'+id_,{},'GET');
    objApiRest.extractDataAjax(function(_resultContent){
        $("#grupo").val(_resultContent[0].NOMBRE_GRUPO);
        $("#selmateria").val(_resultContent[0].ID_MATERIA);
        $("#selmateria").select2();
        $("#instructorc").val(_resultContent[0].CEDULA);
        $("#instructorn").val(_resultContent[0].NOMBRE);
        $("#fecini").val(_resultContent[0].FECHAINI);
        $("#fecfin").val(_resultContent[0].FECHAFIN);
        $("#estadog").val(_resultContent[0].ESTADO);
        $("#estadog").select2();
        $("#txtidc").val(id_);
    });
}

function guardaCurso(){
    var id=$("#txtidc").val();
    if($("#txtidc").val()==""){
        <!-- GUARDA EL GRUPO DEL CURSO A DICTARSE-->
        var objApiRest=new AJAXRest('/uath/formacion/guardagrupo',{
            grupo:$("#grupo").val(),
            selmateria:$("#selmateria").val(),
            instructorc:$("#instructorc").val(),
            instructorn:$("#instructorn").val(),
            fecini:$("#fecini").val(),
            fecfin:$("#fecfin").val(),
            estadog:$("#estadog").val()
        },'post');
        objApiRest.extractDataAjax(function(_resultContent){
            if(_resultContent.status==200){
                $('#AdmGruposCursos').dataTable()._fnAjaxUpdate();
                /*LLENA COMBO CON LOS GRUPOS*/
                var objApiRest=new AJAXRest('/uath/formacion/listagruposcombo',{},'post');
                objApiRest.extractDataAjax(function(_resultContent){
                    $("#selgrupos").html('');
                    $("#selgrupos").select2("val", "");
                    if(_resultContent.length==0){
                        alertToast( "La solicitud no obtuvo resultados",3500);
                    }else{
                        $("#selgrupos").append("<option value='' selected='selected'> * Seleccione *</option>");
                        $.each(_resultContent, function(key, value) {
                            $("#selgrupos").append("<option  value="+key+">"+value+"</option>");

                        });
                    }
                    $("#selmateria").select2();
                });
                /*FIN LLENA COMBO CON LOS GRUPOS*/
                alertToastSuccess(_resultContent.message,3500);
            }else{
                alertToast(_resultContent.message,3500);
            }
        });
    }
    else{
        <!-- GUARDA EL GRUPO DEL CURSO A DICTARSE-->
        var objApiRest=new AJAXRest('/uath/formacion/actualizagrupo/'+id,{
            grupo:$("#grupo").val(),
            selmateria:$("#selmateria").val(),
            instructorc:$("#instructorc").val(),
            instructorn:$("#instructorn").val(),
            fecini:$("#fecini").val(),
            fecfin:$("#fecfin").val(),
            estadog:$("#estadog").val()
        },'post');
        objApiRest.extractDataAjax(function(_resultContent){
            if(_resultContent.status==200){
                $('#AdmGruposCursos').dataTable()._fnAjaxUpdate();
                alertToastSuccess(_resultContent.message,3500);
            }else{
                alertToast(_resultContent.message,3500);
            }
        });
    }
}

function enceraModalAsigna(){
    $("#bcedula").val("");
    $("#cedula").val("");
    $("#apellidos").val("");
    $("#nombres").val("");
    $("#email").val("");
}

function guardaAsignacion() {
        <!-- AISGNA AL PARTICIPANTE AL CURSO A DICTARSE-->
        var objApiRest = new AJAXRest('/uath/formacion/guardaasigna', {
            selgrupos: $("#selgrupos").val(),
            cedula: $("#cedula").val(),
            apellidos: $("#apellidos").val(),
            nombres: $("#nombres").val(),
            email: $("#email").val()
        }, 'post');
        objApiRest.extractDataAjax(function (_resultContent) {
            if (_resultContent.status == 200) {
                $('#AdmAsignacion').dataTable()._fnAjaxUpdate();
                alertToastSuccess(_resultContent.message, 3500);

            } else {
                alertToast(_resultContent.message, 3500);
            }
            clearInput(['cedula','apellidos','nombres','email','bcedula'],'');
        });
}
function eliminaAsignacion(id){
    swal({
            title: "¿Deseas eliminar la asignación?",
            text: "Al confirmar no podrás recuperar el registro",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si!",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: false },

        function(isConfirm){
            if (isConfirm) {
                var objApiRest=new AJAXRest('/uath/formacion/borraasigna/'+id,{},'post');
                objApiRest.extractDataAjax(function(_resultContent){
                    if(_resultContent.status==200){
                        $('#AdmAsignacion').dataTable()._fnAjaxUpdate();
                        //swal("¡Listo!", _resultContent.message,"success");
                    }else{
                        swal("¡Cancelado!",_resultContent.message , "error");
                    }
                });
            } else {
                swal("¡Cancelado!","No se eliminará la asignación...","error");
            }
        });
}
