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
                
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label class="block text-gray-700 text-sm font-bold mb-2">Imagen del Producto</label>
                        
                        <!-- Selector de archivos con vista previa -->
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <!-- Vista previa de la imagen -->
                                <div id="vistaPrevia" class="hidden mb-4">
                                    <img id="imagenPrevisualizacion" class="mx-auto h-32 w-32 object-cover rounded-lg shadow">
                                </div>
                                
                                <!-- Icono de subida -->
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                
                                <div class="flex text-sm text-gray-600">
                                    <label for="imagen" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                        <span>Seleccionar archivo</span>
                                        <input id="imagen" name="imagen" type="file" class="sr-only" accept="image/*" onchange="previsualizarImagen(event)">
                                    </label>
                                    <p class="pl-1">o arrastra y suelta</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                            </div>
                        </div>
                        
                        @error('imagen') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- BOTONES - Claramente visibles -->
                    <div class="flex justify-between items-center mt-6 pt-4 border-t">
                        <a href="{{ route('productos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded transition duration-200">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-200">
                            ✓ Guardar Producto
                        </button>
                    </div>
                </form>
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        function previsualizarImagen(event) {
            const input = event.target;
            const vistaPrevia = document.getElementById('vistaPrevia');
            const imagen = document.getElementById('imagenPrevisualizacion');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagen.src = e.target.result;
                    vistaPrevia.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                vistaPrevia.classList.add('hidden');
            }
        }
    </script>
</body>
</html>