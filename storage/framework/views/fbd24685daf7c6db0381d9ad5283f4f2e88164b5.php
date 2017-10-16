<?php $__env->startSection('masterTitle'); ?>
    Configuraci&oacute;n de Cat&aacute;logos del Sistema
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Cat&aacute;logos del Sistema - Autoridades
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel de administraci&oacute;n para cat&aacute;logos del sistema
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-5">
        <?php echo Form::open(['route'=> 'admin.catalogos.autoridades.store',
        'method'=>'POST']); ?>

        <div class="panel panel-primary panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title text-bold" style="text-align: center;">INGRESO DE AUTORIDADES</h5>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <?php echo Field::text('nombres',null,['label'=>'Nombres:','required'=>true]); ?>

                </div>
                <div class="col-lg-6">
                    <?php echo Field::text('nuic',null,['label'=>'Identificaci&oacute;n:','required'=>true]); ?>


                </div>
                <div class="col-lg-6">
                    <?php echo Field::text('email',null,['label'=>'Email:','required'=>true]); ?>


                </div>

                <div class="col-lg-12">
                    <?php echo Field::select('tipoAutoridad',Config::get('dataselects.tipoAutoridad'),null,
                    ['label'=>'Tipo Autoridad:','required'=>true,"class"=>"select2",'empty'=>'SELECCIONE' ]); ?>

                </div>
                <div class="col-lg-12">
                    <?php echo Field::select('facultad',$facultades,null,
                               ['label'=>'Facultad:','required'=>true,"class"=>"select2",'empty'=>'SELECCIONE' ]); ?>

                    <?php echo Field::select('carrera',[],null,
                                    ['label'=>'Carrera:','required'=>true,"class"=>"select2",'empty'=>'SELECCIONE' ]); ?>


                </div>


                <div class="text-left">
                    <?php echo Form::button('<b><i class=" icon-floppy-disk position-left"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary  btn-block')); ?>


                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>

    <div class="col-lg-7">
        <input id="txtTypeTable" value="<?php echo e(route('admin.catalogos.autoridades.datatable')); ?>" type="hidden" readonly="readonly"/>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover bg-white" id="tableData">
                <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Identificaci&oacute;n</th>
                    <th>Facultad</th>
                    <th>Carrera</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datatables/jquery.dataTables.min.js'); ?>


    <script>
        $(function () {
            $("#facultad").on('change', function () {
                var valueFather = $(this).val();
                var objApiRest = new AJAXRest('/select-carreraFacultad/' + valueFather, {}, 'POST');
                objApiRest.extractDataAjax(function (_resultContent, status) {
                    $("#carrera").html('');
                    if (status != 200) {
                        alertToast("La solicitud no obtuvo resultados", 3500);
                    } else {
                        $("#carrera").append("<option value='' selected='selected'> * SELECCIONE LA CARRERA *</option>");
                        $.each(_resultContent.data, function (key, value) {
                            $("#carrera").append("<option  value=" + value.COD_CARRERA + ">" + value.NOMBRE + "</option>");
                        });
                    }
                });
            });

            $.fn.dataTable.ext.errMode = 'throw';
            $('#tableData').DataTable({
                responsive: true, "oLanguage": {
                    "sUrl": "/js/config/datatablespanish.json"
                },
                "aoColumnDefs": [],
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "destroy": true,
                "ajax": $("#txtTypeTable").val(),
                "columns": [
                    {data: 'nombres'},
                    {data: 'nuic'},
                    {data: 'facultad'},
                    {data: 'carrera'},
                    {data: 'cargo', "bSortable": false, "searchable": false},
                    {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                        "render":function(data, type, row ){
                            return   $('<div />').html(row.actions).text();
                        }}
                ],
                "order": []
            }).ajax.reload();


        });


    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('css/datatables.css'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>