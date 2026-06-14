<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(12);
        return view('products.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->only(['nombre', 'descripcion', 'precio', 'stock']);
        
        // Manejar la subida de imagen
        if ($request->hasFile('imagen')) {
            $imageName = time() . '_' . $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(public_path('images/productos'), $imageName);
            $data['imagen'] = '/images/productos/' . $imageName;
        }
        
        Producto::create($data);
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('products.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('products.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $producto = Producto::findOrFail($id);
    
    $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'required',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    
    $data = $request->only(['nombre', 'descripcion', 'precio', 'stock']);
    
    // Manejar la subida de imagen
    if ($request->hasFile('imagen')) {
        // Eliminar imagen anterior si existe
        if ($producto->imagen && file_exists(public_path($producto->imagen))) {
            unlink(public_path($producto->imagen));
        }
        
        // Guardar nueva imagen
        $imageName = time() . '_' . $request->file('imagen')->getClientOriginalName();
        $request->file('imagen')->move(public_path('images/productos'), $imageName);
        $data['imagen'] = '/images/productos/' . $imageName;
    }
    
    $producto->update($data);
    
    return redirect()->route('productos.index')
        ->with('success', 'Producto actualizado correctamente');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        
        // Eliminar imagen asociada
        if ($producto->imagen && file_exists(public_path($producto->imagen))) {
            unlink(public_path($producto->imagen));
        }
        
        $producto->delete();
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}