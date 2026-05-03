<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-auto px-4">
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <div class="text-green-500 text-6xl mb-4">✓</div>
                <h1 class="text-2xl font-bold mb-2">¡Pedido Confirmado!</h1>
                <p class="text-gray-600 mb-4">Tu pedido ha sido registrado exitosamente</p>
                
                <div class="bg-gray-50 rounded p-4 mb-6">
                    <p class="text-sm text-gray-600">Número de pedido:</p>
                    <p class="font-bold text-lg">{{ $pedido->numero_pedido }}</p>
                    <p class="text-sm text-gray-600 mt-2">Total:</p>
                    <p class="font-bold text-xl text-green-600">${{ number_format($pedido->total, 2) }}</p>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('pedidos.historial') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Ver mi historial de pedidos
                    </a>
                    <a href="{{ route('productos.index') }}" class="block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Seguir comprando
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>