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
            <!-- ... botones existentes ... -->
        </td>
    </tr>
    @endforeach
</tbody>