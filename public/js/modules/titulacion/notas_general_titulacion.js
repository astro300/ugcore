$("#cmbCarrera").on('change', function() {

    var id = this.value;
    changeTable(id);
});


function changeTable(id) {
    $.fn.dataTable.ext.errMode = 'throw';
    $('#dtNotasGenTitu').DataTable({
        responsive: true, "oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        },
        "lengthMenu": [5 ,10, 25, 50, 75, 100 ],
        "aoColumnDefs": [],
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "destroy": true,
        "ajax": '/titulacion/trabajo/data-notas-titulacion/'+id,
        "columns": [

            {data: 'TEMA'},
            {data: 'ESTUDIANTE'},
            {data: 'NTUTOR'},
            {data: 'NREVISOR'},
            {data: 'NSUSTENTACION'},
            {data: 'NOTA_FINAL'},
            {data: 'acciones', "bSortable": false, "searchable": false, "targets": 0,
                "render":function(data, type, row ){
                    return  "<label class='btn btn-info btn-sm' data-toggle='modal' " +
                        "data-target='#ModalNotasGtitulacion' data-popup='tooltip' " +
                        "data-placement='bottom' data-original-title='Editar' onclick='" +
                        "ModalEdit("+row.COD_TESIS+",\""+row.COD_ESTUDIANTE + "\",\""+row.TEMA+"\"," +
                        " \""+row.ESTUDIANTE+"\","+row.NTUTOR+","+row.NREVISOR+", "+row.NSUSTENTACION+")'>" +
                        "<i class='fa fa-edit'></i></label>";
                }}
        ],
        "order": []
    }).ajax.reload();
}


function ModalEdit(COD_TESIS,COD_ESTUDIANTE,TEMA,ESTUDIANTE,NTUTOR,NREVISOR,NSUSTENTACION)
{
    // x = COD_TESIS +' '+COD_ESTUDIANTE;
    // alert(x);
    $('#cod_estudiante').val(COD_ESTUDIANTE);
    $('#cod_tesis').val(COD_TESIS);
    $('#lbtesis').html('&nbsp;&nbsp;&nbsp;'+TEMA);
    $('#lbnombre').html('&nbsp;&nbsp;&nbsp;'+ESTUDIANTE);
    $('#NotaT').val(NTUTOR);
    $('#NotaR').val(NREVISOR);
    $('#NotaS').val(NSUSTENTACION);
}

$("#btnGuardar").on('click', function(){
    GuardarNota();
});


function GuardarNota() {
    var idestudiante =  $('#cod_estudiante').val();
    var idtesis = $('#cod_tesis').val();
    var notaT = $("#NotaT").val();
    var notaR = $("#NotaR").val();
    var notaS = $("#NotaS").val();

    var expreg = new RegExp("[0-9]{1,2}(\.*[0-9]{0,2})");
    var valid1;
    var valid2;
    var valid3;

    if(notaT == '' && notaR == '' &&notaS == ''  ){
        alertToast('Rellene al menos una nota', 3500);
    }
    else {
        if(notaT != '' && notaT != null){
            if(expreg.test(notaT)){
                if(notaT <=10){
                    valid1 = true;
                }
                else{
                    valid1 = false;
                }
            }
            else {
                valid1 = false;
            }
        }
        else {
            valid1 = true;
        }
        if(notaR != '' && notaR != null){
            if(expreg.test(notaR)){
                if(notaR <=10){
                    valid2 = true;
                }
                else{
                    valid2 = false;
                }
            }
            else {
                valid2 = false;
            }
        }
        else {
            valid2 = true;
        }
        if(notaS != '' && notaS != null){
            if(expreg.test(notaS)){
                if(notaS <=10){
                    valid3 = true;
                }
                else{
                    valid3 = false;
                }
            }
            else {
                valid3 = false;
            }
        }
        else {
            valid3 = true;
        }
    }

    if(valid1 && valid2 && valid3)
    {
        var obj =
            {
                COD_ESTUDIANTE: idestudiante,
                COD_TESIS: idtesis
            };
        console.log(obj);

        console.log(notaT);
        console.log(notaR);
        console.log(notaS);

        if(notaT !== null && notaT !== '')
        {
            obj['NOTAT'] = notaT;
        }

        if(notaR !== null && notaR !== '')
        {
            obj['NOTAR'] = notaR;
        }

        if(notaS !== null && notaS !== '')
        {
            obj['NOTAS'] = notaS;
        }

        console.log(obj);
        var objApiRest = new AJAXRest('/titulacion/trabajo/StoreNotasGeneral', obj, 'post');
        objApiRest.extractDataAjax(function (_resultContent) {
            if (_resultContent.status == 200) {
                alertToastSuccess(_resultContent.message, 3500);
                var Carrera_id = $("#cmbCarrera").val();
                changeTable(Carrera_id);
                $('#ModalNotasGtitulacion').modal('hide');
            } else {
                alertToast(_resultContent.message, 3500);
            }
        });
    }
    else{
        alertToast('Existe un error en las notas qeu intenta ingresar', 3500);
    }

}
