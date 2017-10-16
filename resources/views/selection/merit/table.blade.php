<table class="table table-bordered table-striped table-hover">
    <thead>
    <th style="width: 40%;text-align: center">T&iacute;tulo</th>
    <th  style="width: 20%;text-align: center">Fecha de Vigencia</th>
    <th  style="width: 15%;text-align: center">Acciones</th>
    </thead>
    <tbody>
    @forelse($concourses as $value)
        <?php $objInputMaster = $value->meritinputmasters(true, Auth::user()->id);?>
        <tr>

            <td>{{$value->title}} <footer><code>{{$value->description}}</code></footer></td>



            <td>{{$value->date_initial." / ".$value->date_finish}}</td>


            @if($objInputMaster)
                @if($objInputMaster->status=='P')

                    <td style="text-align: center;">
                        <a style="padding: 4px" href="{{route('process.user.create',$value->id)}}"
                           class='label bg-slate' data-popup="popover-custom" title="Acciones:"
                           data-trigger="hover"
                           data-content="Ingrese a esta opci&oacute;n para subir la informaci&oacute;n requerida"
                           data-placement="bottom"><i class="fa fa-pencil"></i> Editar</a>&nbsp;

                        <a style="padding: 4px"  href="{{route('process.user.show',$value->id)}}"
                           class='label bg-pink-400' data-popup="popover-custom" title="Acciones:"
                           data-trigger="hover"
                           data-content="Al seleccionar esta opci&oacute;n se podra visualizar la informaci&oacute;n e imprimir el formulario de registro"
                           data-placement="bottom"><i class="icon-eye2"></i>Ver</a>

                    </td>
                @else

                    <td  style="text-align: center;">
                        <a style="padding: 4px"  href="{{route('process.user.show',$value->id)}}"
                           class='label bg-pink-400' data-popup="popover-custom" title="Acciones:"
                           data-trigger="hover"
                           data-content="Al seleccionar esta opci&oacute;n se podra visualizar la informaci&oacute;n e imprimir el formulario de registro"
                           data-placement="bottom"><i class="icon-eye2"></i> Ver</a>
                    </td>
                @endif
            @else

                <td style="text-align: center;">
                    <a  style="padding: 4px;" href="{{route('process.user.create',$value->id)}}"
                       class='label btn-primary' data-popup="popover-custom" title="Acciones:"
                       data-trigger="hover"
                       data-content="Ingrese a esta opci&oacute;n para subir la informaci&oacute;n requerida"
                       data-placement="bottom"><i class="icon-drawer-out"></i> Aplicar</a>

                </td>

            @endif

        </tr>

    @empty
        <tr>
            <td class="text-center" colspan="4"> ** NO HAY REGISTROS **</td>
        </tr>
    @endforelse

    </tbody>
</table>
{!! $concourses->render() !!}