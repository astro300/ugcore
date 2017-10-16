/**
 * Created by eliberio on 25/10/16.
 */
$(function () {
    $('.file-input').fileinput({
        showUpload: false,
        showPreview: false,
        browseLabel: "Buscar",
        removeLabel: "Quitar",
        allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        maxFileCount: 4,
        maxFileSize: 4000
    }).on('fileerror', function (event, data) {
        alertToast("Solo se admiten máximo 4 archivos y las extensiones deben ser jpg,jpeg,png, con un peso pro cada uno de 4mb", 2000);
    });


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
            {data: 'status'},
            {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return   $('<div />').html(row.actions).text();
                }}
        ],
        "order": []
    }).ajax.reload();

    $('select[name=type_response]').on('change', function (e) {
        e.preventDefault();
        actionsResponses(this.value);
    });
    actionsResponses( $('select[name=type_response]').val());
});

var defaultInputLI = "<div class='col-lg-10 input-group'><input style='text-transform: uppercase' onkeydown='a.value = a.value.toUpperCase()' required='required' name='response[]' class='form-control' placeholder='Digitar Respuesta' type='text'><span class='input-group-btn'><button onclick='removeLI(this)' class='btn btn-default' type='button'><i class='icon-cross3'></i></button></span></div>";

var defaultInputLIOther = "<div class='col-lg-10 input-group' id='divInputOther'><input style='text-transform: uppercase' onkeydown='a.value = a.value.toUpperCase()' required='required' name='response[]' class='form-control' readonly='readonly' value='OTRO' type='text'><span class='input-group-btn'><button onclick='removeLI(this)' class='btn btn-default' type='button'><i class='icon-cross3'></i></button></span></div>";

function actionsResponses(code) {
    $("#dvResponses").html('');
    switch (code) {
        case '11':
        case '12':
            $("#dvMaxResponses").show();
            $("#dvResponses").html("<label class='control-label'>En este tipo de respuesta s&oacute;lo se presentar&aacute; una caja de texto </label>");
            break;
        case '15':
            $("#dvMaxResponses").hide();
            if($("input[name^='response']").length==0){
                $("#dvResponses").html("<div id='dvResponseContent'>" + defaultInputLI + "</div><div class='row label-block'><span style='margin:5px;padding:5px;cursor:pointer' class='label label-primary' onclick='addLI()'>AGREGAR MAS OPCIONES</span><span style='padding:5px;cursor:pointer' class='label label-success' onclick='addOther()'>AGREGAR RESPUESTA OTRO</span></div><br/>");
            }
            break;

        case '13':
            $("#dvMaxResponses").hide();
            if($("input[name^='response']").length==0){
                $("#dvResponses").html("<div id='dvResponseContent'>" + defaultInputLI + "</div><div class='row label-block'><span style='padding:5px;cursor:pointer' class='label label-primary' onclick='addLI()'>AGREGAR MAS OPCIONES</span></div><br/>");
            }
            break;

    }
}

function removeLI(element) {
    $(element).closest('div').remove();
}

function addLI() {
    if($("#divInputOther").length<1){
        $("#dvResponseContent").append(defaultInputLI);
    }else{
        $("#divInputOther").before(defaultInputLI);
    }

}

function addOther(){
    if($("#divInputOther").length<1){
        $("#dvResponseContent").append(defaultInputLIOther);
    }

}