<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Mi Carrito</h1>
                        <a href="{{ route('productos.index') }}" class="ml-4 text-blue-500 hover:text-blue-700">← Seguir comprando</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('pedidos.historial') }}" class="text-gray-600 hover:text-gray-800">📋 Mis Pedidos</a>
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(empty($carrito) || count($carrito) == 0)
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-700">Tu carrito está vacío</h2>
                    <p class="text-gray-500 mt-2">¡Empieza a agregar productos!</p>
                    <a href="{{ route('productos.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Ver productos</a>
                </div>
            @else
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
                            @foreach($carrito as $id => $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($item['imagen'])
                                            <img src="{{ $item['imagen'] }}" class="h-16 w-16 object-cover rounded">
                                        @else
                                            <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">Sin foto</span>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <h3 class="font-semibold">{{ $item['nombre'] }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">${{ number_format($item['precio'], 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('carrito.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" max="{{ $item['stock'] }}" class="w-20 border rounded px-2 py-1 text-center">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-2 py-1 rounded">Actualizar</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 font-semibold">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('carrito.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-bold">Total:</td>
                                <td class="px-6 py-4 text-xl font-bold text-green-600">${{ number_format($total, 2) }}</td>
                                <td class="px-6 py-4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- SOLO UN BOTÓN FINALIZAR COMPRA - ESTE ES EL CORRECTO -->
                <div class="mt-6 flex justify-between">
                    <form action="{{ route('carrito.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Vaciar todo el carrito?')">
                            Vaciar carrito
                        </button>
                    </form>
                    <a href="{{ route('pedidos.checkout') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Finalizar Compra →
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>