<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">Finalizar Compra</h1>
                        <a href="{{ route('carrito.index') }}" class="ml-4 text-gray-500 hover:text-gray-700">← Volver al carrito</a>
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

        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Formulario de checkout -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold mb-4">Información de Envío</h2>
                        
                        <form action="{{ route('pedidos.procesar') }}" method="POST" id="checkoutForm">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Dirección de Envío *</label>
                                <textarea name="direccion" rows="3" class="w-full border rounded px-3 py-2" required placeholder="Calle, número, ciudad, código postal..."></textarea>
                                @error('direccion') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Método de Pago *</label>
                                <select name="metodo_pago" class="w-full border rounded px-3 py-2" required>
                                    <option value="">Selecciona un método</option>
                                    <option value="tarjeta">💳 Tarjeta de crédito/débito</option>
                                    <option value="transferencia">🏦 Transferencia bancaria</option>
                                    <option value="contraentrega">💵 Pago contra entrega</option>
                                </select>
                                @error('metodo_pago') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Notas adicionales</label>
                                <textarea name="notas" rows="3" class="w-full border rounded px-3 py-2" placeholder="Instrucciones de entrega, horario preferido..."></textarea>
                                @error('notas') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Resumen del pedido -->
                <div>
                    <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                        <h2 class="text-xl font-bold mb-4">Resumen del Pedido</h2>
                        
                        <div class="max-h-64 overflow-y-auto mb-4">
                            @foreach($carrito as $item)
                            <div class="flex justify-between text-sm py-2 border-b">
                                <div>
                                    <span class="font-medium">{{ $item['nombre'] }}</span>
                                    <span class="text-gray-500"> x{{ $item['cantidad'] }}</span>
                                </div>
                                <span>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total:</span>
                                <span class="text-green-600">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <button type="submit" form="checkoutForm" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded mt-6">
                            Confirmar Pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>