@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Editar Producto</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>Nombre del Producto</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="5" required>{{ $producto->descripcion }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control" step="0.01" value="{{ $producto->precio }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Imagen Actual</label>
                            @if($producto->imagen)
                                <div>
                                    <img src="{{ asset($producto->imagen) }}" style="max-width: 200px;" class="img-thumbnail">
                                </div>
                            @else
                                <p>No hay imagen actual</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label>Cambiar Imagen</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                            <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Máximo 2MB</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                            <a href="{{ route('productos.index') }}" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection