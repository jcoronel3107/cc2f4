<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class CarritoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    // Ver el carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        return view('carrito.index', compact('carrito', 'total'));
    }

    // Agregar producto al carrito
    public function add(Request $request, Producto $producto)
    {
        $cantidad = $request->input('cantidad', 1);
        
        $carrito = session()->get('carrito', []);
        
        // Si el producto ya existe en el carrito, aumentar cantidad
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            // Agregar nuevo producto al carrito
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
                'imagen' => $producto->imagen,
                'stock' => $producto->stock
            ];
        }
        
        session()->put('carrito', $carrito);
        
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // Actualizar cantidad de un producto
    public function update(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->input('cantidad');
            session()->put('carrito', $carrito);
        }
        
        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado');
    }

    // Eliminar producto del carrito
    public function remove($id)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }

    // Vaciar todo el carrito
    public function clear()
    {
        session()->forget('carrito');
        
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado');
    }
}