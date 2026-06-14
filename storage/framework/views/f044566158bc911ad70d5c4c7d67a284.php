<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Editar Producto</h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo e(route('productos.update', $producto->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="form-group">
                            <label>Nombre del Producto</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo e($producto->nombre); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="5" required><?php echo e($producto->descripcion); ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control" step="0.01" value="<?php echo e($producto->precio); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" value="<?php echo e($producto->stock); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Imagen Actual</label>
                            <?php if($producto->imagen): ?>
                                <div>
                                    <img src="<?php echo e(asset($producto->imagen)); ?>" style="max-width: 200px;" class="img-thumbnail">
                                </div>
                            <?php else: ?>
                                <p>No hay imagen actual</p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Cambiar Imagen</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                            <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Máximo 2MB</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                            <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\desarrollo\eshop\cc2f4\resources\views/products/edit.blade.php ENDPATH**/ ?>