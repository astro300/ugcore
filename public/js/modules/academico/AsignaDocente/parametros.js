var arrayMaxValue={};
var idMateria;
var tablaAdmCarreras='';
var tablaAsignacionDocentes='';
$(function() {
    var combo=document.getElementById('facultad');
    <!-- LLENA COMBO DE CARRERAS CON PARAMETRO DE FACULTAD Y USUARIO-->
    $("#facultad").on('change', function() {
        var valueFather=$(this).val();
        /*ENCERA COMBOS Y CAJAS DE TEXTOS*/
        $("#plectivo").html('');
        $("#plectivo").append("<option value='' selected='selected'>-Seleccione-</option>");
        try{
            if(!$.isEmptyObject($('#AsignacionDocente').DataTable())){
                $('#AsignacionDocente').DataTable().destroy();
            }
        }
        catch(e){console.log(e);}
        $("#tbodyAsignacionDocentes").html('');
        $("#sdocente").val('');
        $("#docente").html('');
        $("#docente").append("<option value='' selected='selected'>-Seleccione-</option>");
        /**/
        $("#smateria").val('');
        $("#materia").html('');
        $("#materia").append("<option value='' selected='selected'>-Seleccione-</option>");
        /**/
        var objApiRest=new AJAXRest('/academico/docente/carreras',{fac:valueFather},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
        $("#carrera").html('');
        if(status!=200){
             alertToast( "La solicitud no obtuvo resultados",3500);
        }else{
                $("#carrera").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#carrera").append("<option  value="+key+">"+value+"</option>");
                });
            }
        });
    });
    <!-- LLENA COMBO DE PLECTIVO CON PARAMETRO DE CARRERAS-->
    $("#carrera").on('change', function() {
        var valueFather=$("#carrera").val();
        /*ENCERA COMBOS Y CAJAS DE TEXTOS*/
        $("#sdocente").val('');
        $("#docente").html('');
        $("#docente").append("<option value='' selected='selected'>-Seleccione-</option>");
        /**/
        $("#smateria").val('');
        $("#materia").html('');
        $("#materia").append("<option value='' selected='selected'>-Seleccione-</option>");
        /**/
        var objApiRest=new AJAXRest('/academico/docente/periodos',{car:valueFather},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
            $("#plectivo").html('');
            if(status!=200){
                alertToast( "La solicitud no obtuvo resultados",3500);
            }else{
                $("#plectivo").append("<option value='' selected='selected'> * SELECCIONE EL PERIODO *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#plectivo").append("<option  value="+key+">"+value+"</option>");

                });
            }
        });
    });
    <!-- BUSCA PERSONA CON CÉDULA O APELLIDOS-->
    $("#sdocente").blur(function() {
        var valueFather = '%'+$("#sdocente").val()+'%';
        var objApiRest=new AJAXRest('/academico/docente/buscadoc',{doc:valueFather},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
            $("#docente").html('');
            if(status!=200){
                alertToastSuccess( "La solicitud no obtuvo resultados",3500);
            }else{
                $("#docente").append("<option value='' selected='selected'>* SELECCIONE EL DOCENTE *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#docente").append("<option  value="+key+">"+value+"</option>");
                });
            }
        });
    });
    <!-- ENCERA CAJAS DE TEXTOS AL ESCOGER PERIODOS-->
    $("#plectivo").on('change', function() {
        /*ENCERA COMBOS Y CAJAS DE TEXTOS*/
        $("#sdocente").val('');
        $("#docente").html('');
        $("#docente").append("<option value='' selected='selected'>-Seleccione-</option>");
        /**/
        $("#smateria").val('');
        $("#materia").html('');
        $("#materia").append("<option value='' selected='selected'>-Seleccione-</option>");
        /**/
    });
    <!-- BUSCA MATERIAS POR CARRERAS-->
    $("#smateria").blur(function() {
        var valueFather = '%'+$("#smateria").val()+'%';
        $("#mattexto").val($("#smateria").val());
        var valueFather2=$("#plectivo").val();
        //alertToastSuccess(valueFather2,2000);
        var objApiRest=new AJAXRest('/academico/docente/buscamat',{mat:valueFather,plec:valueFather2},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
            $("#materia").html('');
            if(status!=200){
                alertToastSuccess( "La solicitud no obtuvo resultados",3500);
            }else{
                $("#materia").append("<option value='' selected='selected'> * SELECCIONE LA MATERIA *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#materia").append("<option  value="+key+">"+value+"</option>");
                });
            }
        });
    });
    <!-- LLENA DATATABLE CON INFORMACION ACADEMICA DEL DOCENTE-->
    $("#docente").on('change', function() {
        var valueFather2=$("#plectivo").val();
        var valueFather1=$("#docente").val();
        tablaAsignacionDocentes=$('#AsignacionDocente').DataTable({
            responsive: true,"oLanguage": {
                "sUrl": "/js/config/datatablespanish.json"
            },
            "lengthMenu": [[4, -1], [4, "All"]],
            "order": [[ 1, 'desc' ]],
            "searching": false,
            "info":  false,
            "ordering": false,
            "bPaginate": true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "destroy": true,
            "ajax": "/academico/docente/buscaasig/"+valueFather1+"/"+valueFather2,
            "columns":[
                {data: 'NOMBRE'},
                {data: 'FECHA_INGRESO'},
                {data: 'MATERIA'},
                {data: 'NIVEL'},
                {data: 'ESTADO'},
                {data: 'OBSERVACION'},
                {
                    data: 'OPCIONES',
                    'render': function (data,type,row){
                        return $('<div/>').html(row.OPCIONES).text();
                    }
                }
            ]
        }).ajax.reload();
    });
    <!-- BUSCA PERSONA CON CÉDULA O APELLIDOS EN VENTANA MODAL-->
    $("#sdocmodal").blur(function() {
        var valueFather = '%'+$("#sdocmodal").val()+'%';
        var objApiRest=new AJAXRest('/academico/docente/buscadoc',{doc:valueFather},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
            $("#docentemodal").html('');
            if(status!=200){
                alertToastSuccess( "La solicitud no obtuvo resultados",3500);
            }else{
                $("#docentemodal").append("<option value='' selected='selected'>* SELECCIONE EL DOCENTE *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#docentemodal").append("<option  value="+key+">"+value+"</option>");
                });
            }
        });
    });
    <!-- BUSCA INFORMACIOÓN EN TABLA TB_DOCENTE_DACADEMICO PARA VENTANA MODAL-->
    $("#docentemodal").on('change', function() {
        var valueFather=$("#docentemodal").val();
        tablaAdmCarreras=$('#AdmCarreras').DataTable({
            responsive: true,"oLanguage": {
                "sUrl": "/js/config/datatablespanish.json"
            },
            "initComplete": function(settings, json) {
                $('input[type=checkbox]').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
                $('input[type=checkbox]').on('ifChanged',function(){
                    actuEstado(this);
                });

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
            "ajax": "/academico/docente/dacade/"+valueFather,
            "columns":[
                {data: 'COD_CARRERA'},
                {data: 'CARRERA'},
                {
                    data: 'ESTADO',
                    'render': function (data,type,row){
                        return $('<div/>').html(row.ESTADO).text();
                    }
                }
            ]
        }).ajax.reload();
    });
    <!-- MUESTRA LAS CARRERAS PARA LA VENTANA MODAL -->
    $("#facultadmodal").on('change', function() {
        var valueFather=$("#facultadmodal").val();
        var objApiRest=new AJAXRest('/academico/docente/carreras',{fac:valueFather},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
            $("#carreramodal").html('');
            if(status!=200){
                alertToast( "La solicitud no obtuvo resultados",3500);
            }else{
                $("#carreramodal").append("<option value='0' selected='selected'>* SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#carreramodal").append("<option  value="+key+">"+value+"</option>");
                });
            }
        });
    });
});

function limpiaModal(){
   <!--ENCERA UNA VEZ INICIADA LA VENTANA MODAL-->
   try{
       if(!$.isEmptyObject(tablaAdmCarreras)){
           tablaAdmCarreras.destroy();
       }
   }catch (e){
        console.log(e);
   }
    $("#tbodyAdmCarreras").html('');
    $("#sdocmodal").val('');
    $("#docentemodal").html('');
    $("#docentemodal").append("<option value='' selected='selected'>-Seleccione-</option>");

    $("#facultadmodal").select2("destroy");
    $("#facultadmodal").val('*');
    $("#facultadmodal").select2({
        language: "es",
        width: '100%'
    });
    $("#carreramodal").html('');
    $("#carreramodal").append("<option value='' selected='selected'>-Seleccione-</option>");
}

function agregaCareraModal(){
    <!-- GUARDA CARRERA NUEVA - PARA LA VENTANA MODAL -->
    var valueFather1=$("#carreramodal").val();
    var valueFather2=$("#docentemodal").val();
    var objApiRest=new AJAXRest('/academico/docente/guardacarrera',{caradd:valueFather1,cedadd:valueFather2},'POST');
    objApiRest.extractDataAjax(function(_resultContent,status){
        if(_resultContent.status==200){
            $('#AdmCarreras').dataTable()._fnAjaxUpdate();
            alertToastSuccess(_resultContent.message,3500);
        }else{
            alertToast(_resultContent.message,3500);
        }
    });
}

function actuEstado(item){
    var estado="0";
    var valueFather1=$("#docentemodal").val();
    var carrera=$(item).attr('data-carrera');
    if(item.checked===true){ estado="1";} else{ estado="0"; }
    var objApiRest=new AJAXRest('/academico/docente/guardaestado',{estado:estado,docente:valueFather1,carrera:carrera},'POST');
    objApiRest.extractDataAjax(function(_resultContent,status){
        if(_resultContent.status==200){
            alertToastSuccess( _resultContent.message,3500);
        }
        else{
            alertToast( _resultContent.message,3500);
        }
    });
}

function cambiaMateria(NID){
    <!--ENCERA UNA VEZ INICIADA LA VENTANA MODAL-->
    $("#smateriaModal").val("");
    $("#materiaModal").html('');
    $("#materiaModal").append("<option value='' selected='selected'>-Seleccione-</option>");
    <!-- BUSCA INFORMACIOÓN EN TABLA TB_DOCENTE_DACADEMICO PARA VENTANA MODAL-->
    $('#VisorMateriaNID').DataTable({
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
        "ajax": "/academico/docente/dacademat/"+NID,
        "columns":[
            {data: 'NOMBRE'},
            {data: 'FECHA_INGRESO'},
            {data: 'MATERIA'},
            {data: 'NIVEL'},
            {data: 'ESTADO'},
        ]
    }).ajax.reload();

    <!-- BUSCA MATERIAS POR CARRERAS-->
    $("#smateriaModal").blur(function() {
        var valueFather = '%'+$("#smateriaModal").val()+'%';
        var valueFather2=$("#plectivo").val();
        var objApiRest=new AJAXRest('/academico/docente/buscamat',{mat:valueFather,plec:valueFather2},'POST');
        objApiRest.extractDataAjax(function(_resultContent,status){
            $("#materiaModal").html('');
            if(status!=200){
                alertToastSuccess( "La solicitud no obtuvo resultados",3500);
            }else{
                $("#materia").append("<option value='' selected='selected'> * SELECCIONE LA MATERIA *</option>");
                $.each(_resultContent, function(key, value) {
                    $("#materiaModal").append("<option  value="+key+">"+value+"</option>");
                });
            }
        });
    });
    idMateria=NID;
}

function actualizaMateria(){
    <!-- ACTUALIZA LA MATERIA POR MEDIO DEL NID-->
    var valueFather1=$("#materiaModal").val();
    var valueFather2=$("#plectivo").val();
    var objApiRest=new AJAXRest('/academico/docente/cambiamateria',{materia:valueFather1,cid:idMateria,plectivo:valueFather2},'POST');
    objApiRest.extractDataAjax(function(_resultContent,status){
        if(_resultContent.status==200){
            $('#VisorMateriaNID').dataTable()._fnAjaxUpdate();
            $('#AsignacionDocente').dataTable()._fnAjaxUpdate();
            alertToastSuccess(_resultContent.message,3500);
        }else{
            alertToast(_resultContent.message,3500);
        }
    });
}

function eliminaMateria(NID) {
        swal({
            title: "¿Deseas eliminar la materia?",
            text: "Al confirmar no podrás recuperar el registro",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "¡Claro!",
            cancelButtonText: "¡No borrar!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm)
            {
                var objApiRest = new AJAXRest('/academico/docente/borramateria', {cid: NID}, 'POST');
                objApiRest.extractDataAjax(function (_resultContent, status) {
                    if (_resultContent.status == 200) {
                        $('#AsignacionDocente').dataTable()._fnAjaxUpdate();
                        swal("¡Listo!", _resultContent.message, "success");
                    } else {
                        swal("¡Cancelado!", _resultContent.message, "error");
                    }
                });
            }
            else
            {
                swal("¡Cancelado!", "No se eliminará el registro...", "error");
            }
        });
}