/**
 * Created by eliberio on 27/10/16.
 */
/**
 * Created by eliberio on 25/10/16.
 */
$(function () {


    $.fn.dataTable.ext.errMode = 'throw';
    var table = $('#tableData').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": '/surveys/admin_surveys/datatables',
        "columns": [
            {data: 'name'},
            {data: 'type'},
            {data: 'total'},
            {data: 'status'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

    var table = $('#tableQuestions').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": '/surveys/admin_surveys/questionsdt/'+$("#txtSurvey").val(),
        "columns": [
            {data: 'name'},
            {data: 'type'},
            {data: 'max_response'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": [],
        "initComplete": function( settings, json ) {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $('input[type=checkbox]').on('ifChanged',function(){
                assigmentQuestion(this);
            });
        }
    }).ajax.reload();

    var arrayDate = new Array;

    if ($.trim($('#date_range').val()) != '') {
        arrayDate = $('#date_range').val().split('/');
    } else {
        arrayDate.push('2017-01-10 00:00:00');
        arrayDate.push('2017-01-10 00:00:00');
    }

    $('#date_range').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            separator: ' / ',
            applyLabel: 'Aceptar',
            cancelLabel: 'Cancelar',
            weekLabel: 'W',
            customRangeLabel: 'Custom Range',
            daysOfWeek: moment.weekdaysMin(),
            monthNames: moment.monthsShort(),
            firstDay: moment.localeData().firstDayOfWeek(),
            autoApply: true,
        }
    });



    $('.table-condensed >thead >tr >th').attr('style', "color:white");
});

function assigmentQuestion(check) {
    var action = 'I';
    var questionDescription="Pregunta desactivada correctamente!";
    var typeAlert='error';
    var cssAlert="alert-warning";
    if (check.checked) {
        action = 'A';
        questionDescription="Pregunta activada correctamente!";
        typeAlert="success";
        cssAlert="alert-success";
    }

    var objApiRest = new AJAXRest('/surveys/admin_surveys/assigment_question', {'question': check.value, 'action': action, 'survey': $('#txtSurvey').val()}, 'POST');
    objApiRest.extractDataAjax(function (_resultContent, status) {
        if (status == 200) {
            new PNotify({
                icon:'icon-notification2',
                title: 'Notificaci\u00F3n',
                text: questionDescription,
                addclass: 'alert '+cssAlert+' alert-styled-right',
                type: typeAlert,
                delay:1000
            });
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });
}