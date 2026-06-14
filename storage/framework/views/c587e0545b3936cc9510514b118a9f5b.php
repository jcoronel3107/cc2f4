<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Productos</h3>
                <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'Creador|Administrador')): ?>
                <a href="<?php echo e(route('productos.create')); ?>" class="btn btn-primary pull-right">
                    + Nuevo Producto
                </a>
                <?php endif; ?>
            </div>
            
            <div class="panel-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($producto->imagen): ?>
                                        <img src="<?php echo e(asset($producto->imagen)); ?>" style="height: 50px; width: 50px; object-fit: cover;" class="img-thumbnail">
                                    <?php else: ?>
                                        <span class="label label-default">Sin foto</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($producto->id); ?></td>
                                <td><?php echo e($producto->nombre); ?></td>
                                <td><?php echo e(Str::limit($producto->descripcion, 50)); ?></td>
                                <td>$<?php echo e(number_format($producto->precio, 2)); ?></td>
                                <td><?php echo e($producto->stock); ?></td>
                                <td>
                                    <a href="<?php echo e(route('productos.show', $producto->id)); ?>" class="btn btn-info btn-sm">Ver</a>
                                    
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'Editor|Administrador')): ?>
                                    <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <?php endif; ?>
                                    
                                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?>
                                    <form action="<?php echo e(route('productos.destroy', $producto->id)); ?>" method="POST" style="display:inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                    
                                    <?php if($producto->stock > 0): ?>
                                    <form action="<?php echo e(route('carrito.add', $producto->id)); ?>" method="POST" style="display:inline">
                                        <?php echo csrf_field(); ?>
                                        <input type="number" name="cantidad" value="1" min="1" max="<?php echo e($producto->stock); ?>" style="width: 60px;" class="form-control input-sm" style="display:inline-block; width:60px;">
                                        <button type="submit" class="btn btn-success btn-sm">Comprar</button>
                                    </form>
                                    <?php else: ?>
                                    <span class="label label-danger">Agotado</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center">
                    <?php echo e($productos->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\desarrollo\eshop\cc2f4\resources\views/products/index.blade.php ENDPATH**/ ?>