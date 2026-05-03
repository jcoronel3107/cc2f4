<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navegación -->
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-bold text-gray-800">Mi Carrito</h1>
                        <a href="<?php echo e(route('productos.index')); ?>" class="text-blue-500 hover:text-blue-700">
                            ← Seguir comprando
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600"><?php echo e(auth()->user()->name); ?></span>
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
            <!-- Mensajes -->
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(empty($carrito) || count($carrito) == 0): ?>
                <!-- Carrito vacío -->
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h13L17 13M7 13h10M9 21h6" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-700 mt-4">Tu carrito está vacío</h2>
                    <p class="text-gray-500 mt-2">¡Empieza a agregar productos!</p>
                    <a href="<?php echo e(route('productos.index')); ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6">
                        Ver productos
                    </a>
                </div>
            <?php else: ?>
                <!-- Tabla del carrito -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $carrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <?php if($item['imagen']): ?>
                                            <img src="<?php echo e($item['imagen']); ?>" class="h-16 w-16 object-cover rounded">
                                        <?php else: ?>
                                            <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">Sin foto</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="ml-4">
                                            <h3 class="font-semibold"><?php echo e($item['nombre']); ?></h3>
                                            <p class="text-sm text-gray-500">Stock: <?php echo e($item['stock']); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">$<?php echo e(number_format($item['precio'], 2)); ?></td>
                                <td class="px-6 py-4">
                                    <form action="<?php echo e(route('carrito.update', $id)); ?>" method="POST" class="flex items-center space-x-2">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="number" name="cantidad" value="<?php echo e($item['cantidad']); ?>" 
                                               min="1" max="<?php echo e($item['stock']); ?>" 
                                               class="w-20 border rounded px-2 py-1 text-center">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-2 py-1 rounded">
                                            Actualizar
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 font-semibold">$<?php echo e(number_format($item['precio'] * $item['cantidad'], 2)); ?></td>
                                <td class="px-6 py-4">
                                    <form action="<?php echo e(route('carrito.remove', $id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                                <a href="<?php echo e(route('pedidos.checkout')); ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                     Finalizar Compra →
                                </a>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-bold">Total:</td>
                                <td class="px-6 py-4 text-xl font-bold text-green-600">$<?php echo e(number_format($total, 2)); ?></td>
                                <td class="px-6 py-4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-between">
                    <form action="<?php echo e(route('carrito.clear')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
                                onclick="return confirm('¿Vaciar todo el carrito?')">
                            Vaciar carrito
                        </button>
                    </form>
                    
                    <a href="<?php echo e(route('productos.index')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Seguir comprando
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/carrito/index.blade.php ENDPATH**/ ?>