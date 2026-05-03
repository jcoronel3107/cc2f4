<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido {{ $pedido->numero_pedido }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Detalle del Pedido</h1>
                        <a href="{{ route('pedidos.historial') }}" class="ml-4 text-gray-500 hover:text-gray-700">← Volver al historial</a>
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
                            <p class="text-gray-600 text-sm">Fecha</p>
                            <p class="font-bold">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Estado</p>
                            @switch($pedido->estado)
                                @case('pendiente')
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">⏳ Pendiente</span>
                                    @break
                                @case('pagado')
                                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">💰 Pagado</span>
                                    @break
                                @case('enviado')
                                    <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">📦 Enviado</span>
                                    @break
                                @case('entregado')
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">✅ Entregado</span>
                                    @break
                                @case('cancelado')
                                    <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">❌ Cancelado</span>
                                    @break
                            @endswitch
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Método de pago</p>
                            <p class="font-bold">
                                @switch($pedido->metodo_pago)
                                    @case('tarjeta') 💳 Tarjeta @break
                                    @case('transferencia') 🏦 Transferencia @break
                                    @case('contraentrega') 💵 Contra entrega @break
                                    @default {{ $pedido->metodo_pago }}
                                @endswitch
                            </p>
                        </div>
                    </div>
                    
                    <h3 class="font-bold text-lg mb-3">Productos</h3>
                    <div class="overflow-x-auto mb-6">
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
                    </div>
                    
                    <div class="border-t pt-4">
                        <h3 class="font-bold text-lg mb-2">Dirección de envío</h3>
                        <p class="text-gray-700">{{ $pedido->direccion_envio }}</p>
                        
                        @if($pedido->notas)
                            <h3 class="font-bold text-lg mb-2 mt-4">Notas</h3>
                            <p class="text-gray-700">{{ $pedido->notas }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>