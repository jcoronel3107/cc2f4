<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Pedido {{ $pedido->numero_pedido }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Detalle del Pedido</h1>
                        <a href="{{ route('admin.pedidos.index') }}" class="ml-4 text-gray-500 hover:text-gray-700">← Volver</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-gray-600 text-sm">Número de pedido</p>
                            <p class="font-bold text-lg">{{ $pedido->numero_pedido }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Cliente</p>
                            <p class="font-bold">{{ $pedido->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $pedido->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Fecha</p>
                            <p class="font-bold">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Método de pago</p>
                            <p class="font-bold">{{ ucfirst($pedido->metodo_pago) }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-3">Cambiar Estado</h3>
                        <form action="{{ route('admin.pedidos.estado', $pedido) }}" method="POST" class="flex items-center space-x-4">
                            @csrf
                            @method('PUT')
                            <select name="estado" class="border rounded px-3 py-2">
                                <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                                <option value="pagado" {{ $pedido->estado == 'pagado' ? 'selected' : '' }}>💰 Pagado</option>
                                <option value="enviado" {{ $pedido->estado == 'enviado' ? 'selected' : '' }}>📦 Enviado</option>
                                <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>✅ Entregado</option>
                                <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>❌ Cancelado</option>
                            </select>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Estado
                            </button>
                        </form>
                    </div>

                    <h3 class="font-bold text-lg mb-3">Productos</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="text-left py-2">Producto</th>
                                <th class="text-left py-2">Precio</th>
                                <th class="text-left py-2">Cantidad</th>
                                <th class="text-left py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->detalles as $detalle)
                            <tr>
                                <td class="py-2">{{ $detalle->producto_nombre }}</td>
                                <td class="py-2">${{ number_format($detalle->producto_precio, 2) }}</td>
                                <td class="py-2">{{ $detalle->cantidad }}</td>
                                <td class="py-2">${{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="pt-4 text-right font-bold">Total:</td>
                                <td class="pt-4 font-bold text-green-600">${{ number_format($pedido->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="border-t pt-4 mt-4">
                        <h3 class="font-bold text-lg mb-2">Dirección de envío</h3>
                        <p class="text-gray-700">{{ $pedido->direccion_envio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>