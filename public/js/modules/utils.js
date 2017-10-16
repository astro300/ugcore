/**
 * Created by blacksato on 21/5/2017.
 */
function fullScreen() {
    document.fullScreenElement && null !== document.fullScreenElement || !document.mozFullScreen && !document.webkitIsFullScreen ? document.documentElement.requestFullScreen ? document.documentElement.requestFullScreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullScreen && document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT) : document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
}
function checkSession(){
    $.ajax({
        type: "GET",
        url: "/checksession",
        headers: {'X-CSRF-TOKEN': $("#token").val()},
        cache: false,
        data: getHour(),
        success: function(res){
            if(!res.login) {
                window.location.href='/';
            }
        }
    });
}
function getHour(){
    var time = new Date();
    var hour = time.getHours();
    var minute = time.getMinutes();
    var seconds = time.getSeconds();

    var str_hora = new String(hour);
    if (str_hora.length == 1) {
        hour = '0' + hour;
    }
    var str_minuto = new String(minute);
    if (str_minuto.length == 1) {
        minute = '0' + minute;
    }
    var str_segundo = new String(seconds);
    if (str_segundo.length == 1) {
        seconds = '0' + seconds;
    }

    return hour + ":" + minute + ":" + seconds;
}
function timeNow() {


    setTimeout('timeNow()', 1000);

    $('#lbl_time').html("<b>Hora: </b>" + getHour());
}

/*
 Funcion que me permite realizar dependencias entre combos
 */
function selectDependent(father,children,check,multiple){
    valueFather=$(father).val()==''?0:$(father).val();

    if(valueFather!='0'){
        var objApiRest = new AJAXRest('/catalog/dataBySelectSingle/'+valueFather, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            if (status == 200) {

               if(!multiple){
                   $(children).html('<option value="0">-Seleccione-</option>');
               }else{
                   $(children).html('');
               }


                if(_resultContent.data.length==0){
                    alertToast( "La solicitud no obtuvo resultados",3500);
                }else{
                    $.each(_resultContent.data, function(key, value) {
                        var checked=check==key?'selected':'';
                        $(children).append("<option value="+key+" "+checked+">"+value+"</option>");
                    });
                }
                if(!multiple){
                $(children).val(check).trigger("change");
                }

            } else {
                alertToast(_resultContent.message, 3500);
            }
        });
    }else{
        if(!multiple){
            $(children).html('<option value="0">-Seleccione-</option>');
        }else{
            $(children).html('');
        }
    }
}

function verifyKeyPressPattern(e, patron, object, width) {
    var tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla == 8 || tecla == 0) {
        $(object).removeAttr('style');
        return true; // 3
    }
    var te = String.fromCharCode(tecla); // 5
    var result = patron.test(te);
    if (!result) {

        $(object).attr('style', 'background-color: #F8E0E6;' + width);
    } else {
        $(object).attr('style', 'background-color: #fff;' + width);
    }
    return result;
}
function putAttrInput(elements,flag){
    if(!flag){
        $.each(elements, function (index, value) {
            $("#"+value).removeAttr('disabled');
        });
    }else{
        $.each(elements, function (index, value) {
            $("#"+value).attr('disabled', 'disabled');
        });
    }
}
function showHideInput(elements,flag){
    if(!flag){
        $.each(elements, function (index, value) {
            $("#"+value).parent().parent().show();
        });
    }else{
        $.each(elements, function (index, value) {
            $("#"+value).parent().parent().hide();
        });
    }
}
function clearInputName(elements,pvalue){
    $.each(elements, function (index, value) {
        $("input[name="+value+"]").val(pvalue);
    });
}
function clearSelectName(elements,pvalue){
    $.each(elements, function (index, value) {
        $("select[name="+value+"]").val(pvalue);
    });
}
function clearInput(elements,pvalue){
    $.each(elements, function (index, value) {
        $("#"+value).val(pvalue);
    });
}
function clearInputSelect(elements,pvalue){
    $.each(elements, function (index, value) {
        $("#"+value).val(pvalue).trigger("change");
    });
}
function addOptionSelect(elements,pvalue){
    $.each(elements, function (index, value) {
        $("#"+value).prepend(pvalue);
    });
}
function fileInputBasicCustom(_maxFileSizeByte,_maxFileSizeMB,_extensions){
    $('.file-input').fileinput({
        maxFileSize: _maxFileSizeByte,
        showPreview:false,
        showUpload:false,
        browseLabel: 'Buscar',

        removeLabel: '',
        language: "en",
        browseIcon: '<i class="icon-file-plus"></i>',
        browseClass: "btn btn-primary  btn-xs",
        removeClass: "btn bg-pink-400 btn-xs",
        previewFileIconClass: "file-icon",
        removeTitle: "Quitar archivo seleccionado",
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>'
        },
        initialCaption: "",
        allowedFileExtensions: _extensions
    }).on('fileerror', function (event, data) {
        alertToast("Solo se admiten extensiones pdf, con peso m\u00E1ximo de "+_maxFileSizeMB+" MB", 4000);
        $(data).fileinput('clear');
    });
}


function referencePathOriginal(_ref){
    var namefile=$(_ref).attr('data-namefile');
    var pathdoc=$(_ref).attr('data-path');
    var module=$(_ref).attr('data-module');
    var divurlmodal=$(_ref).attr("data-div");
    $.ajax({
        url: '/global/get-file-ftp',
        type: 'post',
        headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
        data:  {'namefile': namefile,'pathdoc':pathdoc,'module':module},
        dataType: "json",
        success: function (result) {
            if(result.link.trim()!='none'){
                viewModalURL("/"+result.link);
                $("#"+divurlmodal).html("<span onclick='viewModalURL(\"/"+result.link+"\")' class='label bg-teal'  style='cursor:pointer'>"+namefile+"</span>");
            }else{
                alertToast("NO SE PUEDE OBTENER EL ARCHIVO SOLICITADO", 3500);
            }
        },
        error: function (e) {
            alertToast("NO SE PUEDE OBTENER EL ARCHIVO SOLICITADO", 3500);
        },
        fail: function (result) {
            alertToast("NO SE PUEDE OBTENER EL ARCHIVO SOLICITADO", 3500);
        }
    });
}
function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

    var blob = new Blob(byteArrays, {type: contentType});
    return blob;
}
function putAttrInputCustom(elements,flag,attributes,valueAttr){
    if(!flag){
        $.each(elements, function (index, value) {
            $("#"+value).removeAttr(attributes);
        });
    }else{
        $.each(elements, function (index, value) {
            $("#"+value).attr(attributes, valueAttr);
        });
    }
}
function putAttrArray(elements,attributes){
    $.each(elements, function (index, value) {
        $("#"+value).attr(attributes);
    });
}
var AJAXRestFilePOST=function(path,parameters){
    this._path=path;
    this._parameters=parameters;
    this._resultContent={};
    this.extractDataAjaxFile=function(callback){
        $.ajax({
            url: this._path,
            type: "POST",
            dataType: "json",
            data: this._parameters,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            headers:{'X-CSRF-TOKEN':$("input[name='_token']").val()},

            success: function(msg){
                this._resultContent=msg;
                callback(this._resultContent,200);
                hideLoading();
            },
            error: function(xhr, status) {
                hideLoading();
                this._resultContent={};
                if( xhr.status == 422 ) {
                    var errores='';
                    errors = xhr.responseJSON;
                    $.each( errors, function( key, value ) {
                        errores += value[0]+"\n";
                    });
                    if(errores.trim()!=""){
                        this._resultContent={message:errores,code:422};
                    }
                }else{console.log(xhr);
                    if( xhr.status == '404' ) {
                        this._resultContent={message:"C\u00F3digo o Pagina no encontrado",code:404};
                    }else{
                        this._resultContent={message:"Error de procesamiento (cod: "+xhr.status+ ")\n"+xhr.responseText,code:500};
                    }

                }

                callback(this._resultContent,xhr.status );
            },
            beforeSend: function(){
                showLoading();
            }
        });
    }
    function ajaxrequest(rtndata) {

    }

}
var AJAXRest=function(path,parameters,typeAjax){
    this._path=path;
    this._parameters=parameters;
    this._vType=typeAjax.trim();
    this._resultContent={};
    this.extractDataAjax=function(callback){
        $.ajax({
            url: this._path,
            data: this._parameters,
            dataType: "json",
            headers:{'X-CSRF-TOKEN':$("input[name='_token']").val()},
            method: this._vType,
            success: function(msg){
                this._resultContent=msg;
                callback(this._resultContent,200);
                hideLoading();
            },
            error: function(xhr, status) {
                hideLoading();
                this._resultContent={};
                if( xhr.status == 422 ) {
                    var errores='';
                    errors = xhr.responseJSON;
                    $.each( errors, function( key, value ) {
                        errores += value[0]+"\n";
                    });
                    if(errores.trim()!=""){
                        this._resultContent={message:errores,code:422};
                    }
                }else{
                    if( xhr.status == '404' ) {
                        this._resultContent={message:"C\u00F3digo o Pagina no encontrado",code:404};
                    }else{
                        this._resultContent={message:"Error de procesamiento (cod: "+xhr.status+ ")\n"+xhr.responseText,code:500};
                    }

                }

                callback(this._resultContent,xhr.status );


            },
            beforeSend: function(){
                showLoading();
            }
        });
    }
    function ajaxrequest(rtndata) {

    }

}


function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateNumber(number) {
    var re = /^[0-9]+$/;
    return re.test(number);
}