$("#cmbFacultad").on('change',
    function ()
    {
        var carrera = 'cmbCarrera';
        var ruta    = '/titulacion/Configuraciones/';
        var value   = this.value;
        changeCarrera(carrera, ruta,value);
    });

function changeCarrera(carrera, ruta, value)
{
    $('#' + carrera + '').html('');
    if(this.value!='')
    {
        var objApiRest = new AJAXRest(ruta+''+value, {}, 'POST');
        objApiRest.extractDataAjax(function (_resultContent, status)
        {
            if (status == 200)
            {
                $('#'+carrera).append("<option value='' selected='selected'>Seleccione</option>");
                $.each(_resultContent.data,function(_key, _value)
                {
                    $('#'+carrera).append("<option value='" + _value.COD_CARRERA + "'>" + _value.NOMBRE + "</option>")
                });
            }
            else
            {
                alertToast(_resultContent.message,3000);
            }
        })
    }
}

/*
Evento:     Change
Componente: cmbCarrera
Tipo:       comboBox
Objetivo:   Obtener listado de
 */
$("#cmbCarrera").on('change', function() {

    var id = this.value;
    changeDatatable(id);
});


function changeDatatable(id)
{
    //var id = this.value;
    $('#dtExamenComplexivo').DataTable().destroy();
    $('#tbobyExamenComplexivo').html('');
    if(id != '')
    {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#dtExamenComplexivo').DataTable(
            {
                responsive: true,"oLanguage":
                {
                    "sUrl": "/js/config/datatablespanish.json"
                },
                "lengthMenu": [[10, -1], [10, "All"]],
                "order": [[ 1, 'desc' ]],
                "searching": true,
                "info":  false,
                "ordering": false,
                "bPaginate": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "destroy": true,
                "ajax": "/titulacion/complexivo/getDtExamenComplexivo/" + id,
                "columns":[
                    {data: 'FACULTAD',  "width": "20%"},
                    {data: 'CARRERA',   "width": "20%"},
                    {data: 'ESTUDIANTE',"width": "25%"},
                    {data: 'NOTA_COMPLEXIVO'},
                    {data: 'NOTA_GRACIA'},
                    {data: 'NOTA_FINAL'},
                    // {data: 'OBSERVACION',"width": "25%"},
                    {
                        data: 'actions',
                        "bSortable": false,
                        "searchable": false,
                        "targets": 0,
                        "render": function (data, type, row)
                        {
                            return  "<label class='btn btn-info btn-sm' data-toggle='modal' " +
                                "data-target='#ModalNotasComplexivo' data-popup='tooltip' " +
                                "data-placement='bottom' data-original-title='Editar' onclick='" +
                                "ModalEdit("+row.N_ID+", \""+row.ESTUDIANTE+"\","+row.NOTA_COMPLEXIVO+", "+row.NOTA_GRACIA+",\""+row.OBSERVACION+"\", \""+row.NUM_SECUENCIAXX+"\")'>" +
                                "<i class='fa fa-edit'></i></label>";
                        }
                    }

                ]
            }).ajax.reload();
    }
    else
    {
        alertToast('debe seleccionar una carrera valida',3500);
    }

}

//Insert or Update notas examen

function ModalEdit(id, nombre, complexivo,eGracia,observacion,n_secuncia)
{
    // var data = table.row($(this).parents("tr")).data();
    //var x = $("#tbSeguimiento").DataTable().rows();


    $('#idmatriculado').val(id);
    $('#num_secuencia').val(n_secuncia);
    $("#lbnombre").html('&nbsp;&nbsp;&nbsp;'+nombre);
    $('#NotaeComplexivo').val(complexivo);
    $('#NotaGracia').val(eGracia);
    if(observacion == null || observacion == 'null'){
        $('#observacion').val('');
    }
    else
    {
        $('#observacion').val(observacion);
    }


}


//guardar calificaciones del examen complexivo

$("#btnGuardar").on('click', function(){
    GuardarNotas();
});


function GuardarNotas() {
    var id =  $('#idmatriculado').val();
    var secuencia = $('#num_secuencia').val();

    var objApiRest = new AJAXRest('/titulacion/complexivo/store/'+id+'/'+secuencia, {
        MATRICULA_ID: id,
        NOTA_COMPLEXIVO: $("#NotaeComplexivo").val(),
        NOTA_GRACIA: $("#NotaGracia").val(),
        //OBSERVACION: $("#observacion").val()
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

$('#dtExamenComplexivo').on( 'click', 'tbody td:not(:first-child)', function (e) {
    var x=1;
    editor.inline( this );
} );