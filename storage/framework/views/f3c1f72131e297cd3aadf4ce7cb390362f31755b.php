<?php $__env->startSection('masterTitle'); ?>
    Logs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterTitleModule'); ?>
    Logs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('masterDescription'); ?>
    Pantalla de logs generados en el Sistema.
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <?php echo e(env('APP_NAME')); ?> Log View
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar">

                        <div class="list-group">
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="?l=<?php echo e(base64_encode($file)); ?>" class="list-group-item <?php if($current_file == $file): ?> llv-active <?php endif; ?>">
                                    <?php echo e($file); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-10 table-container">

                        <?php if($logs === null): ?>
                            <div class=" alert important bg-danger text-center text-bold">
                                <span> Archivo de Logs pesa mas de 50M, por favor proceda a descargarlo.</span>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive no-padding">
                                <table id="table-log" class="table table-bordered table-striped table-hover">
                                    <thead>

                                    <th>Nivel</th>
                                    <th>Contexto</th>
                                    <th>Fecha</th>
                                    <th>Contenido</th>

                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-<?php echo e($log['level_class']); ?> text-center"><span class="glyphicon glyphicon-<?php echo e($log['level_img']); ?>-sign" aria-hidden="true"></span> &nbsp;<?php echo e($log['level']); ?></td>
                                            <td><?php echo e($log['context']); ?></td>
                                            <td><?php echo e(Carbon::parse($log['date'])->diffForHumans()); ?></td>
                                            <td>
                                                <?php if($log['stack']): ?> <a class="pull-right expand btn btn-default btn-xs"

                                                                       data-toggle="modal" data-target="#stack<?php echo e($key); ?>"
                                                                      ><span class="glyphicon glyphicon-search"></span></a><?php endif; ?>
                                                <code><?php echo e($log['text']); ?></code>

                                                <?php if(isset($log['in_file'])): ?> <br /><code><?php echo e($log['in_file']); ?></code><?php endif; ?>
                                                <?php if($log['stack']): ?> <div class="modal fade" id="stack<?php echo e($key); ?>">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header headerError">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title"><?php echo e($log['context']); ?> - <?php echo e($log['date']); ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php echo e(trim($log['stack'])); ?>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                       </div><?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <?php if($current_file): ?>
                    <a href="?dl=<?php echo e(base64_encode($current_file)); ?>" class="btn btn-twitter"><span class="glyphicon glyphicon-download-alt"></span> Descargar Archivo</a>
                    -
                    <a id="delete-log" href="?del=<?php echo e(base64_encode($current_file)); ?>" class="btn btn-google"><span class="glyphicon glyphicon-trash"></span> Eliminar Archivo</a>
                    <?php if(count($files) > 1): ?>
                        -
                        <a id="delete-all-log" href="?delall=true" class="btn btn-flickr"><span class="glyphicon glyphicon-trash"></span> Eliminar Todo</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterCssCustom'); ?>
    <link href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/datatables.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('masterJsCustom'); ?>
    <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('#table-log').DataTable({
            "order": [ 1, 'desc' ],
            responsive: true, "oLanguage": {
                "sUrl": "/js/config/datatablespanish.json"
            },
        });

        $('#delete-log, #delete-all-log').click(function(){
            return confirm('Est\u00E1s seguro que deseas eliminar el archivo?');
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.back', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>