/**
 * Created by blacksato on 29/5/2017.
 */

$(function () {
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});

function getMenuByRole(){
    var role= $('#roles').val();
    $("#dvMenu").html('');
    if( role === ''){
        alertToast("Seleccione un rol",1500);
    }else{
        var objAJAXRest=new AJAXRest( '/admin/roles/options/'+role, {},'GET');
            objAJAXRest.extractDataAjax(function(_resultContent){
            if (_resultContent['result'] == 'OK')
            {
                $("#dvMenu").html(_resultContent['content']);
                $('input[type=checkbox]').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            }
            else
            {
                alertToast(_resultContent['content'],3500);
            }
            });
    }
}

var arrTmpJavaScript=[];
function getAddRoleUser(){
    var prole= $('#roles').val();
    var txtRole=$('#roles').find(":selected").text();

    var arrayRoleExJSON = JSON.parse($('#arrayRoleExists').val());

    for (var key in arrayRoleExJSON) {
        if(arrTmpJavaScript.indexOf(arrayRoleExJSON[key]) == -1){
            arrTmpJavaScript.push(arrayRoleExJSON[key]);
        }
    }
    if( prole === ''){
        alertToast("Seleccione un rol",1500);
    }else{
        if(arrTmpJavaScript.indexOf(txtRole) ==-1){
            var idTmp= 'role_'+prole;
            $("#ulNavRol").append("<li> <div class='checkbox icheck'><label><input type='checkbox' id='"+idTmp+"' checked='checked' name='role[]' value='"+prole+"'> <b>"+txtRole+"</b></label></div></li>");
            $("#"+idTmp).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            alertToastSuccess("Agregado correctamente hacer clic en guardar para completar la configuraci\u00F3n!",3500);
            arrTmpJavaScript.push(txtRole);
        }else{
            alertToast("El rol ya se encuentra cargado en las configuraciones",3500);
        }
    }
    /*
     var templateBody='  ';*/
}