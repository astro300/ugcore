<?php $__env->startSection('masterTitle'); ?>
    Acerca de
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Acerca de
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Informaci&oacute;n t&eacute;nica sobre el sistema.
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="col-md-8 col-md-offset-2">




        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <div class="widget-user-image">
                    <img class="img-circle" src="/images/info.png" alt="User Avatar">
                </div>
                <div>
                    <h3 class="widget-user-username text-bold">Sistema Integrado Universidad de Guayaquil</h3>
                    <h5 class="widget-user-desc">Divisi&oacute;n de Gesti&oacute;n Tecnol&oacute;gica de la Informaci&oacute;n &copy; 2017 DGTI</h5>
                </div>

            </div>

            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">

                            <span>Creado por DGTI, utilizando tecnolog&iacute;as OpenSource</span>
                               <br/><hr/>
                            <span class="description-header">Version 1.0.2</span>
                            <br/>
                            <span class="description-header">PHP + Laravel</span>
                            <br/><hr/>
                            <span class="description-header">
                                <a href="mailto:soporte@ug.edu.ec?Subject=Hola Soporte" target="_top">soporte@ug.edu.ec</a></span>
                        </div>
                    </div>
                    <div class="col-sm-8 ">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.9239132641487!2d-79.89985358560182!3d-2.1825647378752286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x902d727815ad5a9d%3A0x1d61939b42d442f!2sUniversidad+de+Guayaquil+(UG)!5e0!3m2!1ses!2sec!4v1494868206747" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>

                    </div>

                </div>
            </div>
        </div>




        <a class="btn btn-google btn-block" href="<?php echo e(route('home')); ?>"><i class="icon-undo2"></i>REGRESAR</a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>