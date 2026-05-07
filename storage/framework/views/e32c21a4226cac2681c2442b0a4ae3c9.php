<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Historial de Pedidos</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Mi Historial de Pedidos</h1>
                        <a href="<?php echo e(route('productos.index')); ?>" class="ml-4 text-gray-500 hover:text-gray-700">← Seguir comprando</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="<?php echo e(route('carrito.index')); ?>" class="text-gray-600 hover:text-gray-800">🛒 Carrito</a>
                        <span class="text-gray-600"><?php echo e(auth()->user()->name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-6xl mx-auto px-4 py-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($pedidos->isEmpty()): ?>
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <p class="text-gray-500 text-lg">No tienes pedidos realizados</p>
                    <a href="<?php echo e(route('productos.index')); ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Comenzar a comprar
                    </a>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pedido</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 font-medium"><?php echo e($pedido->numero_pedido); ?></td>
                                <td class="px-6 py-4"><?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></td>
                                <td class="px-6 py-4 font-bold text-green-600">$<?php echo e(number_format($pedido->total, 2)); ?></td>
                                <td class="px-6 py-4">
                                    <?php switch($pedido->estado):
                                        case ('pendiente'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">⏳ Pendiente</span>
                                            <?php break; ?>
                                        <?php case ('pagado'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">💰 Pagado</span>
                                            <?php break; ?>
                                        <?php case ('enviado'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">📦 Enviado</span>
                                            <?php break; ?>
                                        <?php case ('entregado'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">✅ Entregado</span>
                                            <?php break; ?>
                                        <?php case ('cancelado'): ?>
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">❌ Cancelado</span>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <span class="px-2 py-1 text-xs rounded bg-gray-100"><?php echo e($pedido->estado); ?></span>
                                    <?php endswitch; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('pedidos.detalle', $pedido)); ?>" class="text-blue-500 hover:text-blue-700">Ver detalles</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <?php echo e($pedidos->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/pedidos/historial.blade.php ENDPATH**/ ?>