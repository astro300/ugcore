$(function () {
    $('.pickadate').datepicker({
        formatSubmit: 'yyyy-mm-dd',
        format: 'yyyy-mm-dd',
        selectYears: true,
        editable: true,
        autoclose: true,
        orientation:'top'
    });

    $("#faculties").on('change', function () {
        var valueFather = $(this).val();
        var objApiRest = new AJAXRest('/select-carreraFacultad/' + valueFather, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status) {
            $("#careers").html('');
            if (status != 200) {
                alertToast("La solicitud no obtuvo resultados", 3500);
            } else {
                $("#careers").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                $.each(_resultContent.data, function (key, value) {
                    $("#careers").append("<option  value=" + value.COD_CARRERA + ">" + value.NOMBRE + "</option>");
                });
            }
        });

    });
});

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46-32";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = "8-37-39-46";
    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function validar(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    patron = /[A-Za-z\s]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function addActivity(_btn) {
    var objApiRest = new AJAXRest($(_btn).attr('data-ref'), {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $('#id_actividad').val('0');
            $('textarea[name=description]').val('');
            $('textarea[name=observation]').val('');
            $('input[name=date]').val('');
            valueSelect('n_hours', '1');
            $('#formActivityStudent').attr('action', _resultContent.url);
            $('#dvModalupdateactivity').modal({
                show: true,
                backdrop: 'static'
            });
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });


}

function viewAnexosActivity(idActivity) {
    var objApiRest = new AJAXRest("/preprofessional/getActividadEstudiante/" + idActivity, {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $('textarea[name=description]').val(_resultContent.data.description);
            $('textarea[name=observation]').val(_resultContent.data.observation);
            $('input[name=date]').val(_resultContent.data.date_activity);
            $('input[name=n_hours]').val(_resultContent.data.number_hours);

            var idx = 0;
            var classAct = '';
            $('#dvCarouselItemLink').html('');
            $('#dvCarouselItem').html('');

            $('#boxBodyItem').html('<div id="carousel-link" class="carousel slide" data-ride="carousel">' +
                '<ol class="carousel-indicators" id="dvCarouselItemLink"></ol>' +
                '<div class="carousel-inner" id="dvCarouselItem"></div>' +
                '<a class="left carousel-control" href="#carousel-link" data-slide="prev"><span class="fa fa-angle-left"></span></a>' +
                '<a class="right carousel-control" href="#carousel-link" data-slide="next"><span class="fa fa-angle-right"></span></a>' +
                '</div>');

            $.each(_resultContent.data.anexos, function (key, item) {
                if (idx == 0) {
                    classAct = 'active';
                } else {
                    classAct = '';
                }
                $('#dvCarouselItemLink').append('<li data-target="#carousel-link" data-slide-to="' + idx + '" class="' + classAct + '"></li>');
                $('#dvCarouselItem').append('<div class="item ' + classAct + '"><img  src="/file-ftp/PREPROFESIONALES_ANEXOS/' + item.namefile + '" alt="Item Anexo"></div>');


                idx++;
            });

            $('#dvModalActivityAnexos').modal({
                show: true,
                backdrop: 'static'
            });
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });
}

function getActivityValidate(idActivity) {
    var objApiRest = new AJAXRest("/preprofessional/getActividadEstudiante/" + idActivity, {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $('textarea[name=description]').val(_resultContent.data.description);
            $('textarea[name=observation]').val(_resultContent.data.observation);
            valueSelect('n_hours', _resultContent.data.number_hours);
            $('input[name=date]').val(_resultContent.data.date_activity);


            $('textarea[name=obs_veredict]').val(_resultContent.data.obs_approved);
            valueSelect('veredicto', _resultContent.data.approved);



            $('#id_actividad').val(idActivity);
            $('#dvAnexosOld').html('<label for="observation" class="text-bold col-lg-4 control-label">ANEXOS CARGADOS</label><div class="col-lg-8">');

            var idx = 1;
            var flagAnexo=false;
            $.each(_resultContent.data.anexos, function (key, item) {
                $('#dvAnexosOld').append('<a target="_blank" href="/file-ftp/PREPROFESIONALES_ANEXOS/' + item.namefile + '">anexo ' + idx + '</a><br/>');
                idx++;
                flagAnexo=true;
            });
            $('#dvAnexosOld').append('</div>');

            if(!flagAnexo){
                $('#dvAnexosOld').html('');
            }

            $('#dvModalValidateActivity').modal({
                show: true,
                backdrop: 'static'
            });
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });
}


function getActivity(idActivity) {
    var objApiRest = new AJAXRest("/preprofessional/getActividadEstudiante/" + idActivity, {}, 'GET');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            $('textarea[name=description]').val(_resultContent.data.description);
            $('textarea[name=observation]').val(_resultContent.data.observation);
            valueSelect('n_hours', _resultContent.data.number_hours);
            $('input[name=date]').val(_resultContent.data.date_activity);

            $('#id_actividad').val(idActivity);
            $('#formActivityStudent').attr('action', '/preprofessional/updateActividadEstudiante');


            $('#dvAnexosOld').html('<label for="observation" class="text-bold col-lg-4 control-label">ANEXOS CARGADOS</label><div class="col-lg-8">');

            var idx = 1;
            var flagAnexo=false;
            $.each(_resultContent.data.anexos, function (key, item) {
                $('#dvAnexosOld').append('<a target="_blank" href="/file-ftp/PREPROFESIONALES_ANEXOS/' + item.namefile + '">anexo ' + idx + '</a><br/>');
                idx++;
                flagAnexo=true;
            });
            $('#dvAnexosOld').append('</div>');

            if(!flagAnexo){
                $('#dvAnexosOld').html('');
            }

            $('#dvModalupdateactivity').modal({
                show: true,
                backdrop: 'static'
            });
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });
}

function iddocument(idDocument, idstudent, faculty, carrer) {
    $('#id_document').val(idDocument);
    $('#id_student').val(idstudent);
    $('#id_faculty').val(faculty);
    $('#id_carreer').val(carrer);
}

function idstudent(id_student) {
    $('#id_studen').val(id_student);
}


function alertemailcertifique(url) {
    swal({
            title: "Confirmaci\u00F3n de Envio",
            text: "Cuando se envie el correo automaticamente finaliza el proceso de las practicas Preprofesionales del estudiante",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                swal("Satisfactorio", "Acci\xf3n completa", "success");
                location.href = url;
            } else {
                swal("Cancelado", "Acci\xf3n cancelada", "error");
            }
        });
}

$('.timepicker').timepicker({
    clear: ''
});