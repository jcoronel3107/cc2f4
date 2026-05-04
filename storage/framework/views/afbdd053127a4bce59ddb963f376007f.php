<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Productos</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="<?php echo e(route('carrito.index')); ?>" class="text-gray-600 hover:text-gray-800">🛒 Carrito</a>
                         <a href="<?php echo e(route('pedidos.historial')); ?>" class="text-gray-600 hover:text-gray-800">📋 Mis Pedidos</a>
                        <span class="text-gray-600"><?php echo e(auth()->user()->name); ?></span>
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                            <?php echo e(auth()->user()->roles->first()->name ?? 'Sin rol'); ?>

                        </span>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-600 hover:text-gray-800">Panel</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mensajes de éxito -->
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Botón crear (solo para Creador y Admin) -->
            <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'Creador|Administrador')): ?>
            <div class="mb-4">
                <a href="<?php echo e(route('productos.create')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Nuevo Producto
                </a>
            </div>
            <?php endif; ?>

            <!-- Tabla de productos -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
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
                                <a href="<?php echo e(route('productos.show', $producto)); ?>" class="text-blue-500 hover:text-blue-700">Ver</a>
                                
                                <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'Editor|Administrador')): ?>
                                <a href="<?php echo e(route('productos.edit', $producto)); ?>" class="text-yellow-500 hover:text-yellow-700">Editar</a>
                                <?php endif; ?>
                                
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?>
                                <form action="<?php echo e(route('productos.destroy', $producto)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Eliminar este producto?')">
                                        Eliminar
                                    </button>
                                </form>
                                <?php endif; ?>
                                
                                <!-- Formulario para agregar al carrito -->
                                <?php if($producto->stock > 0): ?>
                                <form action="<?php echo e(route('carrito.add', $producto)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <input type="number" name="cantidad" value="1" min="1" max="<?php echo e($producto->stock); ?>" class="w-16 border rounded px-1 py-1 text-center text-sm">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">
                                        🛒 Comprar
                                    </button>
                                </form>
                                <?php else: ?>
                                <span class="text-red-500 text-xs">Agotado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <?php echo e($productos->links()); ?>

            </div>
        </div>
    </div>
</body>
</html><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/productos/index.blade.php ENDPATH**/ ?>