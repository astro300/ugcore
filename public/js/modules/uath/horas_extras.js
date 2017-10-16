var tipoEmpleado=0;
var div1='';
$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    $('#bcedula').on('keypress', function (e) {
        if(e.which === 13){
            <!-- Tabla con datos del empleado -->
            var cedula=$("#bcedula").val();
            $('#AdmPersona').DataTable({
                responsive: true,"oLanguage": {
                    "sUrl": "/js/config/datatablespanish.json"
                },
                "order": [[ 1, 'desc' ]],
                "searching": false,
                "info":  false,
                "ordering": false,
                "bPaginate": false,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "destroy": true,
                "autoWidth": false,
                "ajax": "/uath/horasextras/buscadatosfun/"+cedula,
                "columns":[
                    {data: 'CEDULA'},
                    {data: 'NOMBRES_COMPLETOS'},
                    {data: 'CARGO'},
                    {data: 'RMU'},
                    {data: 'CAT_DCTE',
                        "render": function ( data, type, row ) {
                            $("#unidad").val(row.UNID_ADMIN_ACADEM);
                            var div1='';
                            if(row.CAT_DCTE=='6'){
                                div1='<span><b>CÓD. TRABAJO</b></span>';
                            }
                            if(row.CAT_DCTE=='7'){
                                div1='<span><b>LOSEP</b></span>';
                            }
                            tipoEmpleado=data;
                            return div1;
                        }
                    },
                    {data: 'HORA_JORD'}
                    /*{
                        data: 'ESTADO',
                        "render": function ( data, type, row ) {
                            var datoBase=data;
                            var div1='';
                            if(row.ESTADO=='C'){
                                div1='<span class="label label-warning label-rounded"><b>Creado</b></span>';
                            }
                            if(row.ESTADO=='G'){
                                div1='<span class="label label-primary label-rounded"><b>Generado</b></span>';
                            }
                            if(row.ESTADO=='E'){
                                div1='<span class="label label-success label-rounded"><b>Enviado</b></span>';
                            }
                            return div1;
                        }
                    },*/
                ]
            }).ajax.reload();
            $("#hextra").focus();
            /*clearInput(['cedula','unidad','nombres','cargo','rmu','horext','valor1','horsup','valor5','hornoct','valorn','montor'],'');
            $("#hextra").val('0');
            $("#hsuple").val('0');
            $("#hnoct").val('0');
            var cedula=$("#bcedula").val();
            var objApiRest=new AJAXRest('/uath/horasextras/buscadatosfun/'+cedula,{},'get');
            objApiRest.extractDataAjax(function(_resultContent){
                if(_resultContent!='0'){
                    $("#cedula").val(_resultContent[0].CEDULA);
                    $("#unidad").val(_resultContent[0].UNID_ADMIN_ACADEM);
                    $("#nombres").val(_resultContent[0].APELLIDOS+' '+_resultContent[0].NOMBRES);
                    $("#cargo").val(_resultContent[0].CARGO);
                    $("#rmu").val(_resultContent[0].RMU);
                    tipoEmpleado=_resultContent[0].CAT_DCTE;
                    var objApiRestHor=new AJAXRest('/uath/horasextras/calculo/'+cedula,{},'get');
                    objApiRestHor.extractDataAjax(function(_resultContentHor){
                        if(_resultContentHor!='0'){
                            $("#horjord").val(_resultContentHor[0].INICIO+' - '+_resultContentHor[0].FIN);
                        }
                    });
                    if(_resultContent[0].CAT_DCTE==6){
                        $("#tipo").val('CÓD. TRABAJO');
                        $('#hnoct').attr('disabled', false);
                    }
                    if(_resultContent[0].CAT_DCTE==7){
                        $("#tipo").val('LOSEP');
                        $('#hnoct').attr('disabled', true);
                    }
                    $("#hextra").focus();
                }
                else{
                    alertToast('La cédula '+cedula+ ' no existe en los registros de la UG',3200);
                }
            });*/
        }
    });

    <!-- Información de planificaciones creadas -->
    var user=$('#txtuser').val();
    $('#AdmPlanificacion').DataTable({
        responsive: true,"oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "order": [[ 1, 'desc' ]],
        "searching": false,
        "info":  false,
        "ordering": false,
        "bPaginate": false,
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "autoWidth": false,
        "ajax": "/uath/horasextras/planinfo",
        "columns":[
            {data: 'IDAREA'},
            {data: 'IDMATRIZ'},
            {data: 'PERIODO'},
            {data: 'DESCRIPCION'},
            {
                data: 'ESTADO',
                "render": function ( data, type, row ) {
                    var datoBase=data;
                    var div1='';
                    if(row.ESTADO=='C'){
                        div1='<span class="label label-warning label-rounded"><b>Creado</b></span>';
                    }
                    if(row.ESTADO=='G'){
                        div1='<span class="label label-primary label-rounded"><b>Generado</b></span>';
                    }
                    if(row.ESTADO=='E'){
                        div1='<span class="label label-success label-rounded"><b>Enviado</b></span>';
                    }
                    return div1;
                }
            },
            {data: 'FECHA'},
            {data: 'created_at'},
            {
                data: 'OPCIONES',
                'render': function (data,type,row){
                    return $('<div/>').html(row.OPCIONES).text();
                }
            }
        ]
    }).ajax.reload();

})

function restarHoras(inicio,fin) {
    //inicio = document.getElementById("inicio").value;
    //fin = document.getElementById("fin").value;
    inicioMinutos = parseInt(inicio.substr(3,2));
    inicioHoras = parseInt(inicio.substr(0,2));
    finMinutos = parseInt(fin.substr(3,2));
    finHoras = parseInt(fin.substr(0,2));
    transcurridoMinutos = finMinutos - inicioMinutos;
    transcurridoHoras = finHoras - inicioHoras;
    if (transcurridoMinutos < 0) {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    /*if (horas.length < 2) {
        horas = "0"+horas;
    }
    if (horas.length < 2) {
        horas = "0"+horas;
    }
    document.getElementById("resta").value = horas+":"+minutos;
    */
    return horas;
}

function CalculaHoras(){
    var hextra=$("#hextra").val();
    var hsuple=$("#hsuple").val();
    var hnoct=$("#hnoct").val();
    var Tipo=tipoEmpleado;
    var remuneracion=0;
    var Horas=0;
    var ValorH=0;
    var ValorS=0;
    var ValorN=0;
    var TotalMReq=0;
    switch (Tipo){
        case '7':
            hnoct=$("#hnoct").val('0');
            Horas=parseInt(hextra)+parseInt(hsuple);
            if(Horas<=60){
                var cedula=$("#bcedula").val();
                $("#horext").val(parseInt(hextra)*4); // Por 4 meses
                $("#horsup").val(parseInt(hsuple)*4); // Por 4 meses
                $("#hornoct").val(parseInt('0')); // Por 4 meses
                var objApiRest=new AJAXRest('/uath/horasextras/calculo/'+cedula,{},'get');
                objApiRest.extractDataAjax(function(_resultContent){
                    if(_resultContent!='0'){
                        var horasTrabajadas=restarHoras(_resultContent[0].INICIO,_resultContent[0].FIN);
                        remuneracion=$("#rmu").val();
                        /*Horas extraordinarias*/
                        ValorH=(((remuneracion/(horasTrabajadas*30))*2*hextra))*4;
                        if(ValorH<=remuneracion)
                            $("#valor1").val(ValorH.toFixed(2));
                        else{
                            swal("¡Error de ingreso!","El valor total de Horas Extras (Extraordinarias) no debe excederse al RMU ["+remuneracion+"]. Tipo empleado: "+$("#tipo").val(),"error");
                            clearInput(['horext','valor1','horsup','valor5','hornoct','valorn','montor'],'');
                            $("#horext").focus();
                        }
                        /*Fin extraordinaria*/
                        /*Horas suplementaria*/
                        ValorS=(((remuneracion/(horasTrabajadas*30))*1.5*hsuple))*4;
                        if(ValorS<=remuneracion)
                            $("#valor5").val(ValorS.toFixed(2));
                        else{
                            swal("¡Error de ingreso!","El valor total de Horas Extras (Suplementarias) no debe excederse al RMU ["+remuneracion+"]. Tipo empleado: "+$("#tipo").val(),"error");
                            clearInput(['horext','valor1','horsup','valor5','hornoct','valorn','montor'],'');
                            $("#horsup").focus();
                        }
                        /*Fin Sumplementaria*/
                        /*Horas nocturno*/
                        ValorN='0.00'
                        $("#hornoct").val('0');
                        $("#valorn").val(ValorN);
                        /*fin nocturno*/
                        /*Total monto requerido*/
                        TotalMReq=parseFloat(ValorH)+parseFloat(ValorN)+parseFloat(ValorS);
                        $("#montor").val(TotalMReq.toFixed(2));
                        /*fin total*/
                    }
                });
            }
            else{
                swal("¡Error de ingreso!","El total entre Horas Extras y Suplementarias debe ser máximo 60 Horas. Tipo empleado: "+$("#tipo").val(),"error");
                clearInput(['horext','valor1','horsup','valor5','hornoct','valorn','montor'],'');
                $("#horext").focus();
            }
            break;
    }
}

function creaPlanificacion(){
    <!-- CREA UN NUEVO REGISTRO CABECERA DE LA PLANIFICACIÓN - PARA LA VENTANA MODAL -->
    var valueFather1=$("#dependencias").val();
    var valueFather2=$("#periodo").val();
    var valueFather3=$("#fecha").val();
    var valueFather4=$("#descripcion").val();

    if(valueFather4==''){
        valueFather4='**SIN COMENTARIOS**';
    }

    var objApiRest=new AJAXRest('/uath/horasextras/creaplani/'+valueFather1+'/'+valueFather2+'/'+valueFather3+'/'+valueFather4,{},'POST');
    objApiRest.extractDataAjax(function(_resultContent,status){
        if(_resultContent.status==200){
            $('#AdmPlanificacion').dataTable()._fnAjaxUpdate();
            alertToastSuccess(_resultContent.message,3500);
        }else{
            alertToast(_resultContent.message,3500);
        }
    });
    limpiaModal();
}

function eliminaPlanificacion(id,matriz){
    swal({
        title: "¿Deseas eliminar la planificación ("+matriz+")?",
        text: "Al confirmar no podrás recuperar el registro",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "¡Eliminar!",
        cancelButtonText: "¡No Eliminar!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
        function (isConfirm) {
            if (isConfirm)
            {
                var objApiRest = new AJAXRest('/uath/horasextras/borraplanificacion/'+id, {}, 'POST');
                objApiRest.extractDataAjax(function (_resultContent, status) {
                    if (_resultContent.status == 200) {
                        $('#AdmPlanificacion').dataTable()._fnAjaxUpdate();
                        swal("¡Listo!", _resultContent.message, "success");
                    } else {
                        swal("¡Cancelado!", _resultContent.message, "error");
                    }
                });
            }
            else
            {
                swal("¡Cancelado!", "No se eliminará el registro.", "error");
            }
        });
}

function limpiaModal(){
    $('#dependencias').val(function () {
        return $(this).find('').filter(function () {
            return $(this).prop('defaultSelected');
        }).val();
    });
    $('#periodo').val(function () {
        return $(this).find('').filter(function () {
            return $(this).prop('defaultSelected');
        }).val();
    });
    $('#descripcion').val('');
    $('#descripmodal_theme_crea_planicion').modal('hide');
}