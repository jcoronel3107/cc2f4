<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('role:Administrador', only: ['destroy']),
            new Middleware('role:Creador|Administrador', only: ['create', 'store']),
            new Middleware('role:Editor|Administrador', only: ['edit', 'update']),
        ];
    }

    public function index()
    {
        $productos = Producto::latest()->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
{
    try {
        //$request->validate([
        //    'nombre' => 'required|string|max:255',
        //    'descripcion' => 'nullable|string',
        //    'precio' => 'required|numeric|min:0',
        //    'stock' => 'required|integer|min:0',
        //    'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        //]);

        $datos = $request->all();

        // Subir imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('productos', $nombreImagen, 'public');
            $datos['imagen'] = '/storage/' . $ruta;
        }

        $producto = Producto::create($datos);
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
            
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|url'
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}