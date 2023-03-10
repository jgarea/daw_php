<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
    <table>
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Posición</th>
                <th>Dorsal</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e($item->apellidos.", ".$item->nombre); ?></th>
                <td><?php echo e($item->posicion); ?></td>
                <?php if(isset($item->dorsal)): ?>
                    <td><?php echo e($item->dorsal); ?></td>
                <?php else: ?>
                    <td>Sin Asignar</td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>