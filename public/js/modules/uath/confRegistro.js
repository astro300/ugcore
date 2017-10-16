$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    $("#selgruposasis").select2().on('change', function () {
        var valueFather = $("#selgruposasis option:selected").val() == '' ? 0 : $("#selgruposasis option:selected").val();
        //$("#nomgrupo").text("GRUPO: "+$("#selgruposasis option:selected").text());
        $('#AdmAsignacionAsis').DataTable({
            responsive: true, "oLanguage": {
                "sUrl": "/extcore/js/config/datatablespanish.json"
            },
            "lengthMenu": [[5, -1], [5, "All"]],
            //"order": [[2]],
            "searching": false,
            "info": false,
            "ordering": true,
            "bPaginate": true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "destroy": true,
            "ajax": "/uath/formacion/listaasignacion/" + valueFather,
            "columns": [
                {
                    data: 'ID',
                    "visible": false
                },
                {data: 'CEDULA'},
                {data: 'APELLIDOS'},
                {data: 'NOMBRES'},
                {data: 'ASISTENCIA'},
                {data: 'ESTADOMATERIA'},
                {
                    data: 'ASISTENCIA',
                    "render": function ( data, type, row ) {
                        return '<select id="txt'+row.ID+'" class="form-control" onchange="guardaAsistencia('+row.ID+',this.value);"><option>* Escoja *</option><option value="S">SI</option><option value="N">NO</option></select>';
                    }
                }
            ]
        }).ajax.reload();
    });
});
function guardaAsistencia(id,dato){
    var objApiRest=new AJAXRest('/uath/formacion/guardaasistencia/'+id+'/'+dato,{},'post');
    objApiRest.extractDataAjax(function(_resultContent){
        if(_resultContent.status==200){
            $('#AdmAsignacionAsis').dataTable()._fnAjaxUpdate();
            alertToastSuccess(_resultContent.message,3500);
        }else{
            alertToast(_resultContent.message,3500);
        }
    });
}