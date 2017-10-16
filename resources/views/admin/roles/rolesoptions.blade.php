@extends('layouts.back')
@section('masterTitle')
    Roles Opciones
@endsection
@section('masterTitleModule')
    Asignaci&oacute;n de Opciones
@endsection
@section('masterDescription')
    Manipulaci&oacute;n del Men&uacute; del sistema
@endsection

@section('mainContent')

    <div class="col-lg-8 col-lg-offset-2">

        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">Asignaci&oacute;n de Opciones al
                    Rol {!! $objRoles->name !!}</h5>
            </div>
            <h6 class="text-warning text-center text-uppercase text-bold">**Las modificaciones que realice en esta opci&oacute;n
                pueden afectar a los usuarios**</h6>


            {!! Form::open(['route'=> ['admin.roles.saverolesoptions',$objRoles],'method'=>'POST']) !!}
            <div class="panel-body">
                <div id="divOptionsProfiles" style="text-align:left">
                    <?php echo $options_roles ?>
                </div>
            </div>
            <div class="panel-footer text-right">
                <a href="{{ route('admin.roles.index')}}"
                   class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                {!! Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('masterJsCustom')
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
@section('masterCssCustom')
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
@endsection

