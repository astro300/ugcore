<div id="field_<?php echo e($id); ?>"<?php echo Html::classes(['form-group', 'has-error' => $hasErrors]); ?>>
    <label for="<?php echo e($id); ?>" class="control-label">
        <?php echo e($label); ?>

    </label>

    <?php if($required): ?>
        <span class="label label-info">Required</span>
    <?php endif; ?>

    <div class="controls">
        <?php echo $input; ?>

        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p class="help-block"><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
