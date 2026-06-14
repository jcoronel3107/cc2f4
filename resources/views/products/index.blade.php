@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Productos</h3>
                @hasanyrole('Creador|Administrador')
                <a href="{{ route('productos.create') }}" class="btn btn-primary pull-right">
                    + Nuevo Producto
                </a>
                @endhasanyrole
            </div>
            
            <div class="panel-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>
                                    @if($producto->imagen)
                                        <img src="{{ asset($producto->imagen) }}" style="height: 50px; width: 50px; object-fit: cover;" class="img-thumbnail">
                                    @else
                                        <span class="label label-default">Sin foto</span>
                                    @endif
                                </td>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ Str::limit($producto->descripcion, 50) }}</td>
                                <td>${{ number_format($producto->precio, 2) }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    
                                    @hasanyrole('Editor|Administrador')
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endhasanyrole
                                    
                                    @role('Administrador')
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endrole
                                    
                                    @if($producto->stock > 0)
                                    <form action="{{ route('carrito.add', $producto->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}" style="width: 60px;" class="form-control input-sm" style="display:inline-block; width:60px;">
                                        <button type="submit" class="btn btn-success btn-sm">Comprar</button>
                                    </form>
                                    @else
                                    <span class="label label-danger">Agotado</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection