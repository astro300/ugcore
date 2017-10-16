<?php $__env->startSection('masterTitle'); ?>
    MODULO PRE-PROFESIONALES
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    ACTIVIDADES DIARIAS
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Panel Principal de actividades diarias del estudiante
<?php $__env->stopSection(); ?>
<?php echo $__env->make('preprofessional.modals.activitystudent', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('preprofessional.modals.activityanexos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-12">
        <?php if(!$id_student==""): ?>

            <div class="row text-center">
                <div class="col-lg-2 col-lg-offset-5">
                    <button class="btn btn-block btn-social bg-teal-400"  type="button" onclick="addActivity(this)" data-ref="<?php echo e(route('preprofessional.student.CreateActivity',array($id_student))); ?>" >
                        <i class="icon-add"></i>AGREGAR ACT..
                    </button>
                </div>

            </div>
            </br>
            <div class="table-responsive">
                <table class="table table-bordered bg-white table-hover" id="tableActivity">
                    <thead>
                    <tr>
                        <th class="text-center">DIA Y FECHA</th>
                        <th class="text-center">N° DE HORAS</th>
                        <th  class="text-center">DESCRIPCION DE TAREAS DIARIAS DESARROLLADAS</th>
                        <th class="text-center">ANEXOS</th>
                        <th class="text-center">APROBACI&Oacute;N</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $total=0;
                     ?>
                    <?php $__empty_1 = true; $__currentLoopData = $objgetactivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objActivity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php 
                            if($objActivity->approved=='1'){
                              $getquantitycount = $getquantitycount + $objActivity->number_hours;
                              $getcathedracount = $objActivity->cathedra_count;
                            }
                            $total+= $objActivity->number_hours
                         ?>
                        <tr>
                            <td class="text-center"><?php echo e($objActivity->date_t); ?></td>
                            <td class="text-center"><?php echo e($objActivity->number_hours); ?></td>
                            <td><?php echo e($objActivity->description); ?></td>

                            <td class="text-center">
                                <?php if($objActivity->anexos>0): ?>
                                   <span class="btn bg-light-blue btn-xs" style="cursor: pointer" data-placement="bottom" data-popup="tooltip" data-original-title="VER ANEXOS"
                                      onclick="viewAnexosActivity(<?php echo e($objActivity->id); ?>)" > anexos: <?php echo e($objActivity->anexos); ?></span>
                                <?php endif; ?>
                            </td>



                            <td class="text-center">
                                <?php if($objActivity->approved==null): ?>
                                    <small>SIN REVISI&Oacute;N</small>
                                <?php endif; ?>
                                    <?php if($objActivity->approved=='1'): ?>

                                        <span class="bg-olive btn-xs">APROBADA</span>
                                    <?php endif; ?>
                                    <?php if($objActivity->approved=='0'): ?>
                                        <span class="bg-danger btn-xs">RECHAZADA</span>
                                    <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($objActivity->id_student == $id_student): ?>
                                    <?php if($objActivity->approved!='1'): ?>
                                    <button data-placement="bottom" data-popup="tooltip" data-original-title="EDITAR" onClick='getActivity(<?php echo e($objActivity->id); ?>);' class='btn btn-default btn-xs'><i class="fa fa-pencil"></i></button>
                                    <a data-placement="bottom" data-popup="tooltip" data-original-title="ELIMINAR" id='aDelete' class="btn btn-danger btn-xs"
                                       onclick="return alertConfirmDelete('la actividad','<?php echo e(route('preprofessional.student.deleteActivity',$objActivity->id)); ?>')"><i class="fa fa-trash"></i></a>
                                        <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <td colspan="4" class="text-center">NO HAY REGISTROS</td>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            </br>
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="row">
                        <?php echo Form::label('total_h','TOTAL DE HORAS APROBADAS',["class"=>"text-bold col-lg-6 control-label"]); ?>

                        <?php echo Form::text('total_h',$getquantitycount,  ["required"=>"required","class"=>"text-bold col-lg-2 control-label","style"=>"text-align: center","readonly"=>"readonly"]); ?>

                    </div>
                    <div class="row">
                        <?php echo Form::label('total','TOTAL DE HORAS INGRESADAS',["class"=>"text-bold col-lg-6 control-label"]); ?>

                        <?php echo Form::text('total',$total,  ["required"=>"required","class"=>"text-bold col-lg-2 control-label","style"=>"text-align: center","readonly"=>"readonly"]); ?>

                    </div>
                </div>
                <?php if($getquantitycount>=240 || ($getquantitycount>=20 && $getcathedracount==6)): ?>
                    <div class="col-lg-6">
                        <div style="text-align: center;">
                            <a href="<?php echo e(route('preprofessional.student.pdfactivity',$id_student)); ?>"
                               class="btn btn-primary dropdown-toggle" data-placement="bottom" data-popup="tooltip"
                               data-original-title="DESCARGAR ACTIVIDADES REALIZADAS EN FORMATO PDF">GENERAR ACTIVIDADES</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datepicker/bootstrap-datepicker.js'); ?>

    <?php echo Html::script('plugins/timepicker/bootstrap-timepicker.js'); ?>

    <script type="text/javascript" src="<?php echo e(asset('plugins/fileinput/fileinput.min.js')); ?>"></script>
    <?php echo Html::script('js/modules/preprofesionales/preprofessional.js'); ?>

    <?php echo Html::script('plugins/datatables/jquery.dataTables.min.js'); ?>

    <script>
        try{
            $.fn.dataTable.ext.errMode = 'throw';
        }catch (e){}
        $('#tableActivity').dataTable({ responsive: true,"oLanguage": {
            "sUrl": "/js/config/datatablespanish.json"
        }});
        $('.file-input-new').fileinput({
            showUpload: false,
            showPreview: false,
            browseLabel: "Buscar",
            removeLabel: "Quitar",
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            maxFileCount: 4,
            maxFileSize: 4000
        }).on('fileerror', function (event, data) {
            alertToast("Solo se admiten máximo 4 archivos y las extensiones deben ser jpg,jpeg,png, con un peso pro cada uno de 4mb", 2000);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterCssCustom'); ?>

    <link href="<?php echo e(asset('css/datatables.css')); ?>" rel="stylesheet">
    <?php echo Html::style('plugins/datepicker/datepicker3.css'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>