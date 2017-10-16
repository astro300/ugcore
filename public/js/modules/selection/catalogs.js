
/**
 * Created by blacksato on 13/11/16.
 */

$(function () {
    $.fn.dataTable.ext.errMode = 'throw';

    $('#tableDataFileDocuments').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": $("#txtTypeTable").val(),
        "columns": [
            {data: 'name'},
            {data: 'ubication'},
            {data: 'status_full'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

    var table = $('#tableData').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": $("#txtTypeTable").val(),
        "columns": [
            {data: 'name'},
            {data: 'type_full'},
            {data: 'status_full'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

    $('#tableDataTypeDocument').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": $("#txtTypeTable").val(),
        "columns": [
            {data: 'name'},
            {data: 'prefix'},
            {data: 'status_full'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

    $('#tableDataConcourseConfig').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": $("#txtTypeTable").val(),
        "columns": [
            {data: 'title'},

            {data: 'date_full'},

            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}

        ],
        "order": []
    }).ajax.reload();
});
