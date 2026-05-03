<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <div class="max-w-2xl mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-6">Crear Nuevo Producto</h1>
                
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre *</label>
                        <input type="text" name="nombre" class="w-full border rounded px-3 py-2" required>
                        @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="4" class="w-full border rounded px-3 py-2"></textarea>
                        @error('descripcion') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Precio *</label>
                            <input type="number" step="0.01" name="precio" class="w-full border rounded px-3 py-2" required>
                            @error('precio') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Stock *</label>
                            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
                            @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">URL de Imagen</label>
                        <input type="url" name="imagen" class="w-full border rounded px-3 py-2">
                        @error('imagen') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="flex justify-between">
                        <a href="{{ route('productos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>