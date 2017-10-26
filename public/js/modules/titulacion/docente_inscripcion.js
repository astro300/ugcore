$(function ()
{
    $.fn.dataTable.ext.errMode = 'throw';
    $('#Tutores').DataTable(
        {
            responsive: true, "oLanguage":
            {
                "sUrl": "/js/config/datatablespanish.json"
            },
            "lengthMenu": [[10, -1], [10, "All"]],
            "order": [[1, 'desc']],
            "searching": true,
            "info": false,
            "ordering": false,
            "bPaginate": true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "destroy": true,
            "ajax": "/titulacion/trabajo/tesis-docente-data/",
            "columns": [
                {
                    data: 'carrera'
                },
                {
                    data: 'trabajo'
                },
                {
                    data: 'docente'
                },
                {
                    data: 'tipo'
                },
                {
                    data: 'P. Lectivo'
                },
                {
                    data: 'acciones',
                    "bSortable": false,
                    "searchable": false,
                    "targets": 0,
                    "render": function (data, type, row) {
                        return $('<div />').html(row.actions).text();
                    }
                }
            ]
        }).ajax.reload();


    $('#cedula_tutor').on('keydown', function (e)
    {
        if (e.which === 9)
        {
            $("#nombre_tutor").html('');
            if (this.value != '')
            {
                var objApiRest = new AJAXRest('/titulacion/trabajo/DatoDocente/' + this.value, {}, 'POST');
                objApiRest.extractDataAjax(function (_resultContent, status)
                {
                    if (status == 200)
                    {
                        $("#nombre_tutor").append("<option value='' selected='selected'> * SELECCIONE DOCENTE *</option>");
                        $.each(_resultContent.data, function (_key, _value)
                        {
                            $("#nombre_tutor").append("<option value='" + _value.COD_DOCENTE + "'>" + _value.DOCENTE + "</option>")
                        });
                    }
                    else
                    {
                        alertToast(_resultContent.message, 3000);
                    }
                })
            }
        }
    });

    $("#carrera_tutor").on('change', function ()
    {
        $("#trabajo_titulacion").html('');
        if(this.value!='')
        {
            var objApiRest = new AJAXRest('/titulacion/trabajo/DatosTrabajoTitulacion/'+this.value, {}, 'POST');
            objApiRest.extractDataAjax(function (_resultContent, status)
            {
                if (status == 200)
                {
                    $("#trabajo_titulacion").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                    $.each(_resultContent.data,function(_key, _value){
                        $("#trabajo_titulacion").append("<option value='"+_value.COD_TESIS+"'>"+_value.TEMA+"</option>")
                    });
                }else{
                    alertToast(_resultContent.message,3000);
                }
            })
        }
    });
});