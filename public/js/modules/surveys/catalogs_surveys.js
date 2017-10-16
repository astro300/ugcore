/**
 * Created by eliberio on 24/10/16.
 */

    // Basic example
$(function() {


    $.fn.dataTable.ext.errMode = 'throw';
    var table=$('#tableData').DataTable({
        responsive: true,"oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": $("#txtTypeTable").val(),
        "columns":[
            {data: 'name'},
            {data: 'status'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();
});
