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