<?php $__env->startSection('masterTitle'); ?>
    Proceso de Selecci&oacute;n de Personal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Proceso de Selecci&oacute;n de Personal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    panel principal del Proceso de Selecci&oacute;n de Personal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <input id="txtActionType" value="" type="hidden"/>


    <div class="nav-tabs-custom border-full-info">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab00" data-toggle="tab"  data-index="D" aria-expanded="true" class="bg-tab-important"><i class=" icon-certificate position-left"></i>Procesos Disponibles</a></li>
            <li class=""><a href="#tab01" data-toggle="tab"  data-index="P" aria-expanded="false" class="bg-tab-important"><i class=" icon-certificate position-left"></i>Procesos en Curso</a></li>
            <li class=""><a href="#tab02" data-toggle="tab"  data-index="F" aria-expanded="false" class=" bg-tab-important"> <i class=" icon-certificate position-left"></i>Procesos Finalizadas</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab00" style="text-align: center">
                <h4 class="text-bold center text-teal-800">Listado de Procesos Disponibles - Etapa de Documentación
                </h4>
            </div>
            <div class="tab-pane" id="tab01" style="text-align: center">

                <h4 class="text-bold center text-teal-800">Listado de Procesos En Curso</h4>
            </div>
            <div class="tab-pane " id="tab02" style="text-align: center">
                <h4 class="text-bold center text-teal-800">Listado de Procesos Finalizadas
                </h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive" id="divTable">
                    <?php echo $__env->make('selection.merit.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

            </div>
        </div>



        <!-- /.tab-content -->
    </div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterJsCustom'); ?>
    <script type="text/javascript">
        $(function () {

            $('[data-popup=popover-custom]').popover({
                template: '<div class="popover border-teal-400"><div class="arrow"></div><h3 class="popover-title bg-teal-400"></h3><div class="popover-content"></div></div>'
            });

            $('a[data-toggle=tab]').on('click', function () {
                $('#txtActionType').val($(this).attr('data-index'));
                loadTable({filterstatus:$('#txtActionType').val()});
            });

            $('#txtActionType').val('D');
        });
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadTable({page: page,filterstatus:$('#txtActionType').val()});
        });

        function loadTable(jsonData){
            var objApiRest = new AJAXRest('/selection/process', jsonData, 'GET');
            objApiRest.extractDataAjax(function (_resultContent, status) {
                if (status == 200) {
                    $("#divTable").html(_resultContent);
                    $('[data-popup=popover-custom]').popover({
                        template: '<div class="popover border-teal-400"><div class="arrow"></div><h3 class="popover-title bg-teal-400"></h3><div class="popover-content"></div></div>'
                    });
                } else {
                    alertToast(_resultContent.message, 3500);
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('/css/datatables.css'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>