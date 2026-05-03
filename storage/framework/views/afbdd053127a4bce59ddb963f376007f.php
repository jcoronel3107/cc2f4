<thead class="bg-gray-50">
    <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
    </tr>
</thead>
<tbody class="divide-y divide-gray-200">
    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td class="px-6 py-4">
            <?php if($producto->imagen): ?>
                <img src="<?php echo e($producto->imagen); ?>" class="h-12 w-12 object-cover rounded">
            <?php else: ?>
                <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                    <span class="text-gray-400 text-xs">Sin foto</span>
                </div>
            <?php endif; ?>
        </td>
        <td class="px-6 py-4"><?php echo e($producto->id); ?></td>
        <td class="px-6 py-4 font-medium"><?php echo e($producto->nombre); ?></td>
        <td class="px-6 py-4"><?php echo e(Str::limit($producto->descripcion, 50)); ?></td>
        <td class="px-6 py-4">$<?php echo e(number_format($producto->precio, 2)); ?></td>
        <td class="px-6 py-4"><?php echo e($producto->stock); ?></td>
        <td class="px-6 py-4 space-x-2">
            <!-- ... botones existentes ... -->
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/productos/index.blade.php ENDPATH**/ ?>