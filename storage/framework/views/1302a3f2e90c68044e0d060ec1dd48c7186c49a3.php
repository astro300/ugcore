<table class="table table-bordered table-striped table-hover">
    <thead>
    <th style="width: 40%;text-align: center">T&iacute;tulo</th>
    <th  style="width: 20%;text-align: center">Fecha de Vigencia</th>
    <th  style="width: 15%;text-align: center">Acciones</th>
    </thead>
    <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $concourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php $objInputMaster = $value->meritinputmasters(true, Auth::user()->id);?>
        <tr>

            <td><?php echo e($value->title); ?> <footer><code><?php echo e($value->description); ?></code></footer></td>



            <td><?php echo e($value->date_initial." / ".$value->date_finish); ?></td>


            <?php if($objInputMaster): ?>
                <?php if($objInputMaster->status=='P'): ?>

                    <td style="text-align: center;">
                        <a style="padding: 4px" href="<?php echo e(route('process.user.create',$value->id)); ?>"
                           class='label bg-slate' data-popup="popover-custom" title="Acciones:"
                           data-trigger="hover"
                           data-content="Ingrese a esta opci&oacute;n para subir la informaci&oacute;n requerida"
                           data-placement="bottom"><i class="fa fa-pencil"></i> Editar</a>&nbsp;

                        <a style="padding: 4px"  href="<?php echo e(route('process.user.show',$value->id)); ?>"
                           class='label bg-pink-400' data-popup="popover-custom" title="Acciones:"
                           data-trigger="hover"
                           data-content="Al seleccionar esta opci&oacute;n se podra visualizar la informaci&oacute;n e imprimir el formulario de registro"
                           data-placement="bottom"><i class="icon-eye2"></i>Ver</a>

                    </td>
                <?php else: ?>

                    <td  style="text-align: center;">
                        <a style="padding: 4px"  href="<?php echo e(route('process.user.show',$value->id)); ?>"
                           class='label bg-pink-400' data-popup="popover-custom" title="Acciones:"
                           data-trigger="hover"
                           data-content="Al seleccionar esta opci&oacute;n se podra visualizar la informaci&oacute;n e imprimir el formulario de registro"
                           data-placement="bottom"><i class="icon-eye2"></i> Ver</a>
                    </td>
                <?php endif; ?>
            <?php else: ?>

                <td style="text-align: center;">
                    <a  style="padding: 4px;" href="<?php echo e(route('process.user.create',$value->id)); ?>"
                       class='label btn-primary' data-popup="popover-custom" title="Acciones:"
                       data-trigger="hover"
                       data-content="Ingrese a esta opci&oacute;n para subir la informaci&oacute;n requerida"
                       data-placement="bottom"><i class="icon-drawer-out"></i> Aplicar</a>

                </td>

            <?php endif; ?>

        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td class="text-center" colspan="4"> ** NO HAY REGISTROS **</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>
<?php echo $concourses->render(); ?>