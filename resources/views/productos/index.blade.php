<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        <a href="{{ route('carrito.index') }}" class="text-gray-600 hover:text-gray-800">🛒 Carrito</a>
                         <a href="{{ route('pedidos.historial') }}" class="text-gray-600 hover:text-gray-800">📋 Mis Pedidos</a>
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                            {{ auth()->user()->roles->first()->name ?? 'Sin rol' }}
                        </span>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800">Panel</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Botón crear (solo para Creador y Admin) -->
            @hasanyrole('Creador|Administrador')
            <div class="mb-4">
                <a href="{{ route('productos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Nuevo Producto
                </a>
            </div>
            @endhasanyrole

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
                        @foreach($productos as $producto)
                        <tr>
                            <td class="px-6 py-4">
                                @if($producto->imagen)
                                    <img src="{{ $producto->imagen }}" class="h-12 w-12 object-cover rounded">
                                @else
                                    <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">Sin foto</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $producto->id }}</td>
                            <td class="px-6 py-4 font-medium">{{ $producto->nombre }}</td>
                            <td class="px-6 py-4">{{ Str::limit($producto->descripcion, 50) }}</td>
                            <td class="px-6 py-4">${{ number_format($producto->precio, 2) }}</td>
                            <td class="px-6 py-4">{{ $producto->stock }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('productos.show', $producto) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                                
                                @hasanyrole('Editor|Administrador')
                                <a href="{{ route('productos.edit', $producto) }}" class="text-yellow-500 hover:text-yellow-700">Editar</a>
                                @endhasanyrole
                                
                                @role('Administrador')
                                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Eliminar este producto?')">
                                        Eliminar
                                    </button>
                                </form>
                                @endrole
                                
                                <!-- Formulario para agregar al carrito -->
                                @if($producto->stock > 0)
                                <form action="{{ route('carrito.add', $producto) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}" class="w-16 border rounded px-1 py-1 text-center text-sm">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">
                                        🛒 Comprar
                                    </button>
                                </form>
                                @else
                                <span class="text-red-500 text-xs">Agotado</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</body>
</html>