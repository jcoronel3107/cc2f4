<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-2">¡Bienvenido, {{ auth()->user()->name }}!</h3>
                    <p>Tu rol actual es: 
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                            {{ auth()->user()->roles->first()->name ?? 'Sin rol asignado' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta: Ver Productos (todos los usuarios) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-4xl mb-2">🛍️</div>
                        <h3 class="font-bold text-lg mb-2">Productos</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Explora nuestro catálogo de productos
                        </p>
                        <a href="{{ route('productos.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ver Productos
                        </a>
                    </div>
                </div>

                <!-- Tarjeta: Mi Carrito (todos los usuarios) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-4xl mb-2">🛒</div>
                        <h3 class="font-bold text-lg mb-2">Mi Carrito</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Revisa los productos en tu carrito
                        </p>
                        <a href="{{ route('carrito.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Ver Carrito
                        </a>
                    </div>
                </div>

                <!-- Tarjeta: Mis Pedidos (todos los usuarios) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-4xl mb-2">📋</div>
                        <h3 class="font-bold text-lg mb-2">Mis Pedidos</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Revisa el historial de tus compras
                        </p>
                        <a href="{{ route('pedidos.historial') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Ver Pedidos
                        </a>
                    </div>
                </div>

                <!-- Tarjeta: Panel Admin (solo Administrador) -->
                @role('Administrador')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-4xl mb-2">🔧</div>
                        <h3 class="font-bold text-lg mb-2">Panel Admin</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Gestiona usuarios, productos y pedidos
                        </p>
                        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Ir al Panel
                        </a>
                    </div>
                </div>
                @endrole

                <!-- Tarjeta: Gestionar Productos (solo Creador, Editor, Admin) -->
                @hasanyrole('Creador|Editor|Administrador')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-4xl mb-2">📦</div>
                        <h3 class="font-bold text-lg mb-2">Gestionar Productos</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Crear o editar productos del catálogo
                        </p>
                        <a href="{{ route('productos.index') }}" class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            Gestionar
                        </a>
                    </div>
                </div>
                @endhasanyrole
            </div>
        </div>
    </div>
</x-app-layout>