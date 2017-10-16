$(function(){
    <!-- CARGA LOS CANTONES DE LAS PROVINCIAS DIRECCIÓN DE RESIDENCIA -->
    $("#idProvDir").on('change', function () {
        var valueFather = this.value == '' ? 0 : this.value;
        var objApiRest = new AJAXRest('/selection/participation-cantones-'+valueFather, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            $("#idCiudadDir").html('');
            $("#idCiudadDir").append("<option value='' selected='selected'> * SELECCIONE LA CIUDAD *</option>");
            if (status != 200) {
                alertToast(_resultContent.message, 3500);
            } else {

                $.each(_resultContent, function (key, value) {
                    $("#idCiudadDir").append("<option  value=" + key + ">" + value + "</option>");
                });
            }

        });
    });

    <!-- CARGA LOS CANTONES DE LAS PROVINCIAS DIRECCIÓN LABORAL-->
    $("#idProvLab").on('change', function () {
        var valueFather = this.value == '' ? 0 : this.value;
        var objApiRest = new AJAXRest('/selection/participation-cantones-'+valueFather, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent,status) {
            $("#idCiudadLab").html('');
            $("#idCiudadLab").append("<option value='' selected='selected'> * SELECCIONE LA CIUDAD *</option>");
            if (status != 200) {
                alertToast(_resultContent.message, 3500);
            } else {

                $.each(_resultContent, function (key, value) {
                    $("#idCiudadLab").append("<option  value=" + key + ">" + value + "</option>");
                });
            }
        });
    });
    $("#documentoFoto").on('change',function(){
        var fileExtension = ['png','jpeg','jpg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            this.value = '';
            $("label[for='documentoFoto']").html('Foto');
            alertToast('Formato de imagen incorrecto',3500);
            return false;
        }else{
            var fileSize = ($(this)[0].files[0].size / 1024 / 1024); //size in MB
            if (fileSize > 8) {
                this.value = '';
                $("label[for='documentoFoto']").html('Foto');
                alertToast('Peso de imagen incorrecta, sólo se admiten 8 megas',3500);
                return false;
            }

            $("label[for='documentoFoto']").html($(this)[0].files[0].name);
        }

    });



    $('input[name=campoAplica]').on('click',function(){
        paintDataTR(this.value,$(this).attr('data-matriz'));
    });

    $('.pickadate').datepicker({
        formatSubmit: 'yyyy-mm-dd',
        format: 'yyyy-mm-dd',
        selectYears: true,
        editable: true,
        autoclose: true,
        orientation:'top'
    });

});

function paintDataTR(_value,_matriz){
    var objApiRest = new AJAXRest('/selection/process/matriz/save/'+$('input[name=merit_concourse_config_id]').val()+'/'+_matriz+'/'+_value, {}, 'POST');
    objApiRest.extractDataAjax(function (_resultContent,status) {
        if (status != 200) {
            alertToast(_resultContent.message, 3500);
        } else {
            $("#tbody_matriz >tr").attr('style','background:#ffffff');
            $("#tr_matriz_"+_matriz).attr('style','background:#fbebeb');
            alertToastSuccess('Área seleccionada correctamente',3500);
        }
    });
}