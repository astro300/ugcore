
$(document).ready(function(){
    $(function () {


        //llenar tabla
        $.fn.dataTable.ext.errMode = 'throw';
        $('#dtNotasTitulacion').DataTable({
            responsive: true, "oLanguage": {
                "sUrl": "/js/config/datatablespanish.json"
            },
            "lengthMenu": [5 ,10, 25, 50, 75, 100 ],
            "aoColumnDefs": [],
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "destroy": true,
            "ajax": '/titulacion/trabajo/notas-titulacion/',
            "columns": [

                {data: 'TEMA'},
                {data: 'ESTUDIANTE'},
                {data: 'NOTA'},

                {data: 'acciones', "bSortable": false, "searchable": false, "targets": 0,
                    "render":function(data, type, row ){
                        return  "<label class='btn btn-info btn-sm' data-toggle='modal' " +
                            "data-target='#ModalNotas' data-popup='tooltip' " +
                            "data-placement='bottom' data-original-title='Editar' onclick='" +
                            "ModalEdit("+row.COD_TESIS+","+row.COD_ESTUDIANTE+",\""+row.TEMA+"\", \""+row.ESTUDIANTE+"\","+row.NOTA+")'>" +
                            "<i class='fa fa-edit'></i></label>";
                    }}
            ],
            "order": []
        }).ajax.reload();

    });
});


function ModalEdit(COD_TESIS,COD_ESTUDIANTE,TEMA,ESTUDIANTE,NOTA)
{
        x = COD_TESIS +' '+COD_ESTUDIANTE;
        alert(x);
        $('#cod_estudiante').val(COD_ESTUDIANTE);
        $('#cod_tesis').val(COD_TESIS);
        $('#lbtesis').html('&nbsp;&nbsp;&nbsp;'+TEMA);
        $('#lbnombre').html('&nbsp;&nbsp;&nbsp;'+ESTUDIANTE);
        $('#Nota').val(NOTA);
}

$("#btnGuardar").on('click', function(){
    GuardarNota();
});


function GuardarNota() {
    var idestudiante =  $('#cod_estudiante').val();
    var idtesis = $('#cod_tesis').val();
    var nota = $("#Nota").val();

    var expreg = new RegExp("[0-9]{1,2}(\.*[0-9]{0,2})");

    if(expreg.test(nota)){
        if(nota <= 10){
            var objApiRest = new AJAXRest('/titulacion/trabajo/StoreNota/'+idestudiante+'/'+idtesis, {
                COD_ESTUDIANTE: idestudiante,
                COD_TESIS: idtesis,
                NOTA: nota,
            }, 'post');
            objApiRest.extractDataAjax(function (_resultContent) {
                if (_resultContent.status == 200) {
                    //$('#AdmMateriasCursos').dataTable()._fnAjaxUpdate();
                    alertToastSuccess(_resultContent.message, 3500);
                    $('#ModalNotas').modal('hide');
                    // var Carrera_id = $("#cmbCarrera").val();
                    // changeDatatable(Carrera_id);
                } else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        }
        else{
            alert('la nota no puede exceder de 10');
        }

    }
    else{
        alert('incorrecto');
    }

    var objApiRest = new AJAXRest('/titulacion/trabajo/StoreNota/'+idestudiante+'/'+idtesis, {
        MATRICULA_ID: id,
        NOTA_COMPLEXIVO: $("#NotaeComplexivo").val(),
        NOTA_GRACIA: $("#NotaGracia").val(),
    }, 'post');
    objApiRest.extractDataAjax(function (_resultContent) {
        if (_resultContent.status == 200) {
            //$('#AdmMateriasCursos').dataTable()._fnAjaxUpdate();
            alertToastSuccess(_resultContent.message, 3500);
            $('#ModalNotasComplexivo').modal('hide');
            var Carrera_id = $("#cmbCarrera").val();
            changeDatatable(Carrera_id);
        } else {
            alertToast(_resultContent.message, 3500);
        }
    });


}


