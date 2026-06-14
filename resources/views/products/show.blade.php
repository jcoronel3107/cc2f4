<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h1 class="text-3xl font-bold">{{ $producto->nombre }}</h1>
                        <a href="{{ route('productos.index') }}" class="text-gray-500 hover:text-gray-700">← Volver</a>
                    </div>
                    
                    @if($producto->imagen)
                        <img src="{{ $producto->imagen }}" class="w-full h-64 object-cover rounded mb-4">
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-gray-600">Precio:</p>
                            <p class="text-2xl font-bold text-green-600">${{ number_format($producto->precio, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Stock:</p>
                            <p class="text-xl">{{ $producto->stock }} unidades</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-gray-600">Descripción:</p>
                        <p class="text-gray-800">{{ $producto->descripcion ?? 'Sin descripción' }}</p>
                    </div>
                    
                    <div class="flex space-x-2">
                        @hasanyrole('Editor|Administrador')
                        <a href="{{ route('productos.edit', $producto) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Editar producto
                        </a>
                        @endhasanyrole
                        @if($producto->stock > 0)
                        <form action="{{ route('carrito.add', $producto) }}" method="POST" class="inline">
                            @csrf
                            <div class="flex items-center space-x-2">
                                <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}" class="w-20 border rounded px-2 py-2 text-center">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    🛒 Agregar al carrito
                                </button>
                            </div>
                        </form>
                        @else
                        <span class="bg-red-500 text-white font-bold py-2 px-4 rounded">Producto Agotado</span>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>