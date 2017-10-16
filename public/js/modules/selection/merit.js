/**
 * Created by eliberio on 21/11/16.
 */
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':  $("input[name=_token]").val()

        }
    });
    $('.file-input').fileinput({
        maxFileSize: 52428800,
        showPreview:false,
        browseLabel: 'Buscar',
        removeLabel: '',
        browseIcon: '<i class="icon-file-plus"></i>',
        browseClass: "btn btn-primary",
        removeClass: "btn bg-pink-400",
        uploadClass: "btn bg-teal-400",
        previewFileIconClass: "file-icon",
        uploadLabel: "Subir",
        uploadTitle: "Al dar click en este boton se subir\u00E1 el archivo a la plataforma",
        removeTitle: "Quitar archivo seleccionado",
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>'
        },
        initialCaption: "",
        allowedFileExtensions: ["pdf"],
        uploadAsync: false,
        uploadUrl: "/selection/config/upload?concourse="+$("input[name=merit_concourse_config_id]").val()


    }).on('fileerror', function (event, data) {
        alertToast("Solo se admiten extensiones pdf, con peso m\u00E1ximo de 50 MB", 4000);
    }).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            var response=data.jqXHR.responseJSON;

        $(this).fileinput('clear').fileinput('enable');
        $(this).fileinput('refresh');

        $.each(response.files,function (key,value) {
            var contentData=" <span onclick=\"viewModalURL('"+value.linkdoc+"')\"" +
                " class='btn bg-maroon btn-xs' data-detail='"+value.id+"'" +
                " style='cursor:pointer'>VER ARCHIVO</span> " +
                "  <button onclick='deleteDocument(\""+value.deletedoc+"\",\""+value.id+"\")' " +
                "   class='btn bg-primary btn-xs' data-detail='"+value.id+"' ><i class='fa fa-trash'></i></button>";

            if(value.flag){
                $("#"+value.code).html(contentData);
            }else{
                $("#"+value.code).prepend(contentData);
            }

        });

        alertToastSuccess(data.jqXHR.responseJSON.content,3500);

    }).on('filebatchuploaderror', function(event, data, msg) {
        $(this).fileinput('clear').fileinput('enable');
        $(this).fileinput('refresh');
       var errores='';
        if(data.jqXHR.status==422){
            errors = data.jqXHR.responseJSON;
            $.each( errors, function( key, value ) {
                errores += value+"\n";
            });
        }else{
            errores=data.jqXHR.responseText;
        }

        alertToast(errores,3500);
    });


    $('input[name=documento]').change(function (){
        var sizeByte = this.files[0].size;
        var siezekiloByte = parseInt(sizeByte / 1024);

        if( ! this.value.match(/\.(pdf|PDF)$/) ){//here your extensions
            alertToast('El archivo debe ser en formato pdf',3500);
            $(this).val('');
        }

        if(siezekiloByte > 8120){
            alertToast('El tamaño máximo del archivo debe de ser de 8 megas',3500);
            $(this).val('');
        }
    });

});

function viewModalURL(url){
    showLoading();
    $("#divPdfView").html('<object type="application/pdf" id="objPdfView"  width="100%" height="100%">Documento no Existe</object>');
    $("#objPdfView").attr("data",url);
    $("#modalPDF").modal();
    hideLoading();
}


/*
 divPdfView
 style="height: 500px;padding: 3px"

* */


function addGroupElements(_id){

    var objApiRest = new AJAXRest('/selection/process-add-fields', {
        'idConcourseConcept':_id
    }, 'POST');
    objApiRest.extractDataAjax(function (_resultContent,status) {
        if(status==200){
            try{
                $("#ul_0"+_id+">li").removeClass('active');
                $("#tab_0"+_id+">div").removeClass('active');
                $("#ul_0"+_id).append('<li class="active"><a href="#divInit_'+_resultContent.code+'" data-toggle="tab" class="legitRipple" aria-expanded="true"><b><i class="icon-certificate"></i></b></a></li>');
                $("#tab_0"+_id).append(_resultContent.data);
            }catch (ex){
                console.log(ex);
            }
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });


}

function deleteFieldsInDoc(_button) {
    if($(_button).attr('data-iddetail').trim()!='0' ){

        swal({
                title: "",
                text: "Est\u00E1s seguro que desea eliminar el registro ?",
                imageUrl: "/extcore/images/delete.png",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",

                confirmButtonText: "SI",
                cancelButtonText: "NO",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    var objApiRest = new AJAXRest('/selection/process-delete-fields', {
                        'idDetail':$(_button).attr('data-iddetail')
                    }, 'POST');
                    objApiRest.extractDataAjax(function (_resultContent,status) {
                        if(status==200){
                            try{
                                alertToastSuccess(_resultContent.data,3500);
                                var divData=$("#"+$(_button).attr('data-div'));
                                $(divData).remove();
                                $("ul>li>a[href=#"+$(_button).attr('data-div')+"]").remove();
                            }catch (ex){
                                console.log(ex);
                            }
                        }
                    });
                }else {
                    alertToast(_resultContent.message, 3500);
                }
            });


    }else{
        var nameDiv=$(_button).attr('data-div');
        var divData=$("#"+$(_button).attr('data-div'));
        $(divData).remove();

        $("ul>li>a[href='#"+nameDiv+"']").remove();
    }

}

function  saveFieldsInDoc(_button) {
    var divData=$("#"+$(_button).attr('data-div'));
    var arrayTextInput=$(divData).find(':input[type=text]');
    var dataPost = new FormData();
    var flagData=true;
    $.each(arrayTextInput,function (key,item) {
        dataPost.append($(item).attr('name'), $(item).val());
    });
    $.each($(divData).find(':input[type=file]'),function (key,item) {
        if( $(item).val()!=''){
            dataPost.append($(item).attr('name'), $(item).prop('files')[0]);
        }else{
            if($(_button).attr('data-iddetail')=='0'){
                sweetAlert("Oops...", "Debes seleccionar un archivo pdf antes de guardar!", "error");
                flagData=false;
            }

            return;
        }

    });

    if(flagData){
        dataPost.append('typeDocument',$(_button).attr('data-typedocument'));
        dataPost.append('conceptConcourse',$(_button).attr('data-conceptconcourse'));
        dataPost.append('idDetail',$(_button).attr('data-iddetail'));
        dataPost.append('concourse',$("input[name=merit_concourse_config_id]").val());

        var objApiRest = new AJAXRestFilePOST('/selection/process-upload-file-fields',
            dataPost);

        objApiRest.extractDataAjaxFile(function (_resultContent,status) {
            if(status==200){
                try{
                    $(_button).attr('data-iddetail',_resultContent.id);
                    alertToastSuccess(_resultContent.content,3500);

                    $(divData).find("div[id=divFileExist]").html("<br/><b>ARCHIVO EXISTENTE:</b>&nbsp;" +
                        "<span onclick='viewModalURL(\""+_resultContent.linkdoc+"\")' class='label bg-maroon'  style='cursor:pointer'>VER ARCHIVO</span>");
                    $(divData).find(':input[type=file]').val('');
                }catch (ex){
                    console.log(ex);
                }
            }else{
                alertToast(_resultContent.message,3500);
            }

        });
    }
}


function sendDocument(ptext, url) {
    swal({
            title: "Envío de Postulaci\u00F3n",
            text: "Realmente desea realizar el proceso de postulaci\u00F3n, una vez enviado el documento no podrá editarlo nuevamente?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                alertConfirmAction(ptext,url)
            }
        });
}

function deleteDocument(url,id) {
    swal({
            title: "Eliminaci\u00F3n de documentos",
            text: "Realmente deseas eliminar el documento seleccionado?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                var objApiRest = new AJAXRest(url, {
                    'idDetail':id
                }, 'POST');
                objApiRest.extractDataAjax(function (_resultContent,status) {
                    if(status==200){
                        $('span[data-detail='+id+']').remove();$('button[data-detail='+id+']').remove();
                        alertToastSuccess('Documento eliminado correctamente!',3500);
                    }else{
                        alertToast(_resultContent.message,3500);
                    }

                });

            }
        });
}