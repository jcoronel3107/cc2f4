<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navegación -->
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Panel de Administración</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('carrito.index') }}" class="text-gray-600 hover:text-gray-800">🛒 Carrito</a>
                        <a href="{{ route('pedidos.historial') }}" class="text-gray-600 hover:text-gray-800">📋 Mis Pedidos</a>
                        <a href="{{ route('admin.pedidos.index') }}" class="text-gray-600 hover:text-gray-800">📦 Pedidos</a>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800">👥 Usuarios</a>
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Tarjeta 1: Usuarios -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Usuarios</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\User::count() }}</p>
                    <p class="text-gray-600 mt-2">Total de usuarios registrados</p>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Gestionar Usuarios →</a>
                </div>

                <!-- Tarjeta 2: Productos -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Productos</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Producto::count() }}</p>
                    <p class="text-gray-600 mt-2">Productos en catálogo</p>
                    <a href="{{ route('productos.index') }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Gestionar Productos →</a>
                </div>

                <!-- Tarjeta 3: Pedidos -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Pedidos</h3>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\Pedido::count() }}</p>
                    <p class="text-gray-600 mt-2">Total de pedidos realizados</p>
                    <a href="{{ route('admin.pedidos.index') }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Gestionar Pedidos →</a>
                </div>

                <!-- Tarjeta 4: Roles -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Roles</h3>
                    <p class="text-3xl font-bold text-orange-600">{{ \Spatie\Permission\Models\Role::count() }}</p>
                    <p class="text-gray-600 mt-2">Roles disponibles</p>
                    <a href="#" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Gestionar Roles →</a>
                </div>
            </div>

            <!-- Sección de usuarios recientes -->
            <div class="mt-8 bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Usuarios Recientes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(\App\Models\User::latest()->take(5)->get() as $usuario)
                            <tr>
                                <td class="px-6 py-4">{{ $usuario->id }}</td>
                                <td class="px-6 py-4">{{ $usuario->name }}</td>
                                <td class="px-6 py-4">{{ $usuario->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                                        {{ $usuario->roles->first()->name ?? 'Sin rol' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>