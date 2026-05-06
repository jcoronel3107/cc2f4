<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-2">¡Bienvenido, <?php echo e(auth()->user()->name); ?>!</h3>
                    <p>Tu rol actual es: 
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                            <?php echo e(auth()->user()->roles->first()->name ?? 'Sin rol asignado'); ?>

                        </span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta: Panel de Administración (solo Admin) -->
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="text-4xl mb-2">🔧</div>
                            <h3 class="font-bold text-lg">Panel Admin</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                            Gestiona usuarios, productos y pedidos
                        </p>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="block text-center bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Ir al Panel
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tarjeta: Gestión de Productos (Creador, Editor, Admin) -->
                <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'Creador|Editor|Administrador')): ?>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="text-4xl mb-2">📦</div>
                            <h3 class="font-bold text-lg">Productos</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Creador')): ?> Crear nuevos productos <?php endif; ?>
                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Editor')): ?> Editar productos existentes <?php endif; ?>
                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?> Gestionar todos los productos <?php endif; ?>
                        </p>
                        <a href="<?php echo e(route('productos.index')); ?>" class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Gestionar Productos
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tarjeta: Tienda / Catálogo (todos los usuarios) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="text-4xl mb-2">🛍️</div>
                            <h3 class="font-bold text-lg">Tienda</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                            Explora nuestro catálogo de productos
                        </p>
                        <a href="<?php echo e(route('productos.index')); ?>" class="block text-center bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            Ir a la Tienda
                        </a>
                    </div>
                </div>

                <!-- Tarjeta: Mis Pedidos (todos los usuarios autenticados) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="text-4xl mb-2">📋</div>
                            <h3 class="font-bold text-lg">Mis Pedidos</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                            Revisa el historial de tus compras
                        </p>
                        <a href="<?php echo e(route('pedidos.historial')); ?>" class="block text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Ver Pedidos
                        </a>
                    </div>
                </div>

                <!-- Tarjeta: Mi Carrito (todos los usuarios) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="text-4xl mb-2">🛒</div>
                            <h3 class="font-bold text-lg">Mi Carrito</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                            Revisa los productos en tu carrito
                        </p>
                        <a href="<?php echo e(route('carrito.index')); ?>" class="block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Ver Carrito
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información para usuarios sin permisos especiales (Consultor) -->
            <?php if (\Illuminate\Support\Facades\Blade::check('hasrole', 'Consultor')): ?>
            <div class="mt-8 bg-blue-50 dark:bg-blue-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-2 text-blue-800 dark:text-blue-200">¡Comienza a comprar!</h3>
                    <p class="text-blue-700 dark:text-blue-300 mb-4">
                        Explora nuestros productos, agrega al carrito y realiza tu primera compra.
                    </p>
                    <a href="<?php echo e(route('productos.index')); ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Ver Productos
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>