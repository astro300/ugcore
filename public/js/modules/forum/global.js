/**
 * Created by blacksato on 11/6/2017.
 */
function like(_id, _type) {
    putActionComment(_id, _type, 1);
}

function desLike(_id, _type) {
    putActionComment(_id, _type, 0);
}

function putActionComment(_id, _type, _action) {
    var objApiRest = new AJAXRest("/forum-comment/action", {
        id: _id,
        type: _type,
        action: _action
    }, 'POST');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            if(_type=='C'){
                $("#likeC_" + _id).html(_resultContent.data.like);
                $("#deslikeC_" + _id).html(_resultContent.data.deslike);
            }else{
                $("#like_" + _id).html(_resultContent.data.like);
                $("#deslike_" + _id).html(_resultContent.data.deslike);
            }

        } else {
            alertToast(_resultContent.message, 3500);
        }

    });
}

function updatePost(_btn) {
    riot.util.tmpl.clearCache();
    riot.mount('comment-form', {id: _btn.value, action: 'actualizar', categories: $('#hdfCategories').val()});
}
function updatePostDetail(_value) {
    riot.util.tmpl.clearCache();
    riot.mount('comment-form', {id: _value, action: 'actualizarDetail', categories: $('#hdfCategories').val()});
}


function responsePost(_btn) {
    riot.util.tmpl.clearCache();
    riot.mount('comment-form', {id: _btn.value, action: 'responder', categories: $('#hdfCategories').val()});
}

function comments(_id) {
    var objApiRest = new AJAXRest("/forum-comment/" + _id + "/detail-datatable", {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $("#divCommentsDetail_" + _id).html(_resultContent.data);
        } else {
            alertToast(_resultContent.message, 3500);
        }

    });
}


function deletePostDetail(_value){
    swal({
            title: "Confirmaci\u00F3n de Eliminaci\u00F3n",
            text: "Realmente desea eliminar El comentario?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                var objApiRest = new AJAXRest('/forum-comment/' + _value + '/delete-detail', {}, 'GET');
                objApiRest.extractDataAjax(function (_resultContent, status) {
                    if (status == 200) {
                        $("#divCommentDetail_" + _value).remove();
                        alertToastSuccess(_resultContent.data,3500);

                    } else {
                        alertToast(_resultContent.message, 3500);
                    }
                });
            } else {
                alertToast("Acci\xf3n cancelada",3500);
            }
        });
}


$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    var objApiRest = new AJAXRest($(this).attr('href'), {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $("#divCommentsDetail_" + (_resultContent.id)).html(_resultContent.data);
        } else {
            alertToast(_resultContent.message, 3500);
        }

    });
});



