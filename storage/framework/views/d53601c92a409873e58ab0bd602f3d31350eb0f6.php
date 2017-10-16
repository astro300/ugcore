<?php $__env->startSection('masterTitle'); ?>
    PRE-PROFESIONALES
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    FORMATOS DEL PROCESO ESTUDIANTES
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    panel principal para descargar los formatos del proceso de las PPP
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-lg-8 col-lg-offset-2">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h5 class="panel-title text-bold bg" style=" text-align: center;">
        <center>SUBIDA DE ARCHIVOS FINALES</center>
        </h5>
    </div>
    <div class="panel-body">

        <?php if($name_estudent==""): ?>

            <?php echo Form::open(['route'=> ['preprofessional.practices.shearchstudentdocument',$faculty,$career],'method'=>'POST', 'class'=>'form-horizontal']); ?>

            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <?php echo Form::label('document','INGRESAR CEDULA',["class"=>"text-bold col-lg-4 control-label"]); ?>

                        <div class="col-lg-6">
                            <?php echo Form::text('document', null,  ["required"=>"required","class"=>"form-control","onkeypress"=>" return verifyKeyPressPattern(event, /[0-9]/,'#document')" ]); ?>

                        </div>
                        <div class="col-lg-2" style="padding-left: 0px;">
                            <?php echo Form::button('BUSCAR', array('type' => 'submit', 'class' => "btn btn-primary")); ?>

                        </div>


                    </div>
                    <hr/>
                    <div class="col-md-12">
                        <div class="text-center">
                            <a href="<?php echo e(route('preprofessional.prospects.indexadministratorreturn',[$faculty,$career])); ?>"
                               class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                            class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>

                <?php else: ?>
                    <?php echo Form::open(['enctype'=>"multipart/form-data",'route'=>
                    ['preprofessional.practices.documentupload',$document,$id_student,$faculty,$career],'method'=>'POST']); ?>

                    <div class="form-group">
                        <div class="col-lg-12 text-center">

                                <?php echo Form::label($name_estudent,'ESTUDIANTE '.strtoupper($name_estudent),["class"=>"control-label"]); ?>


                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <input required='required' name="generaldata" type="file" class="file-input"
                                       data-show-caption="true" data-main-class="input-group" data-show-upload="false">
                                <span class="help-block">Ficha de Datos Generales, Subir documento en formato .pdf</span>
                            </div>
                            <div class="form-group">
                                <input required='required' name="dailyactivities" type="file" class="file-inputcomress"
                                       data-main-class="input-group" data-show-upload="false">
                                <span class="help-block">Ficha de Actividades Diarias, Subir documento en formato .rar o .zip</span>
                            </div>

                            <div class="form-group">
                                <input required='required' name="studentassessment" type="file" class="file-input"
                                       data-main-class="input-group" data-show-upload="false">
                                <span class="help-block">Ficha de Evaluacion Estudiantil, Subir documento en formato .pdf</span>
                            </div>

                            <div class="form-group">
                                <input required='required' name="evaluation_performance" type="file" class="file-input"
                                       data-main-class="input-group" data-show-upload="false">
                                <span class="help-block">Ficha de Evaluacion y Rendimiento Institucion, Subir documento en formato .pdf</span>
                            </div>

                            <div class="form-group">
                                <input required='required' name="tutorassessment" type="file" class="file-inputcomress"
                                       data-show-caption="true" data-main-class="input-group" data-show-upload="false">
                                <span class="help-block">Ficha de Supervision Tutor Academico, Subir documento en formato .rar o .zip</span>
                            </div>

                            <div class="form-group">
                                <input required='required' name="certifiedtutor" type="file" class="file-input"
                                       data-main-class="input-group" data-show-upload="false" data-show-upload="false">
                                <span class="help-block">Certificado Tutor Academico PPP, Subir documento en formato .pdf</span>
                            </div>

                            <div class="form-group">
                                <input required='required' name="certifiedinstitution" type="file" class="file-input"
                                       data-main-class="input-group-sm" data-show-upload="false">
                                <span class="help-block">Certificado Institucion PPP, Subir documento en formato .pdf</span>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group" style="text-align: center;">
                        <div class="col-md-6">
                            <div class="text-right">
                                <a href="<?php echo e(route('preprofessional.prospects.indexadministratorreturn',array($faculty,$career))); ?>"
                                   class="btn btn-warning warning-300 btn-labeled legitRipple"><b><i
                                                class=" icon-undo2 position-left"> </i></b>REGRESAR</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-lefth">
                                <?php echo Form::button('<b><i class=" icon-floppy-disk position-right"></i></b> GUARDAR', array('type' => 'submit', 'class' => 'btn btn-primary btn-labeled legitRipple')); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                <?php endif; ?>
            </div>
    </div>

</div>
</div>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('masterJsCustom'); ?>
    <?php echo Html::script('plugins/datepicker/bootstrap-datepicker.js'); ?>

    <?php echo Html::script('plugins/timepicker/bootstrap-timepicker.js'); ?>

    <script type="text/javascript" src="<?php echo e(asset('plugins/fileinput/fileinput.min.js')); ?>"></script>
    <script>
        $('.file-input').fileinput({
            maxFileSize:2000,
            browseLabel: '',
            removeLabel:'',
            language: "es",
            showPreview:false,
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>'
            },
            initialCaption: "",
            allowedFileExtensions: ["pdf"]
        }).on('fileerror',function(event, data){
            alertToast("Solo se admiten extensiones pdf, con peso de 2mb",2000);
        });
        $('.file-inputcomress').fileinput({
            showPreview:false,
            maxFileSize:2000,
            browseLabel: '',
            removeLabel:'',
            language: "es",
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>'
            },
            initialCaption: "",
            allowedFileExtensions: ["rar","zip"]
        }).on('fileerror',function(event, data){
            alertToast("Solo se admiten extensiones rar/zip, con peso de 2mb",2000);
        });

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterCssCustom'); ?>
    <?php echo Html::style('plugins/datepicker/datepicker3.css'); ?>


    <link rel="stylesheet" type="text/css" href="/plugins/fileinput/fileinput.min.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>