<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pedidos - Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Gestionar Pedidos</h1>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="ml-4 text-gray-500 hover:text-gray-700">← Panel Admin</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600"><?php echo e(auth()->user()->name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 py-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pedido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
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
                            <td class="px-6 py-4"><?php echo e($pedido->user->name); ?></td>
                            <td class="px-6 py-4"><?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></td>
                            <td class="px-6 py-4 font-bold">$<?php echo e(number_format($pedido->total, 2)); ?></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded 
                                    <?php if($pedido->estado == 'pendiente'): ?> bg-yellow-100 text-yellow-800
                                    <?php elseif($pedido->estado == 'pagado'): ?> bg-blue-100 text-blue-800
                                    <?php elseif($pedido->estado == 'enviado'): ?> bg-purple-100 text-purple-800
                                    <?php elseif($pedido->estado == 'entregado'): ?> bg-green-100 text-green-800
                                    <?php else: ?> bg-red-100 text-red-800
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($pedido->estado)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="<?php echo e(route('admin.pedidos.show', $pedido)); ?>" class="text-blue-500 hover:text-blue-700">Gestionar</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <?php echo e($pedidos->links()); ?>

            </div>
        </div>
    </div>
</body>
</html><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/admin/pedidos/index.blade.php ENDPATH**/ ?>