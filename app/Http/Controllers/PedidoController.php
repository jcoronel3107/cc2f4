<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Mail\PedidoConfirmacionMail;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    // Mostrar formulario de checkout
    public function checkout()
    {
        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }
        
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        return view('pedidos.checkout', compact('carrito', 'total'));
    }
/*
    // Procesar el pedido
    public function procesar(Request $request)
    {
        $request->validate([
            'direccion' => 'required|string|min:5',
            'metodo_pago' => 'required|in:tarjeta,transferencia,contraentrega',
            'notas' => 'nullable|string'
        ]);

        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Carrito vacío');
        }

        DB::beginTransaction();
        
        try {
            // Calcular total
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
            
            // Generar número de pedido único
            $numeroPedido = 'PED-' . strtoupper(uniqid());
            
            // Crear pedido
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'numero_pedido' => $numeroPedido,
                'total' => $total,
                'estado' => 'pendiente',
                'metodo_pago' => $request->metodo_pago,
                'direccion_envio' => $request->direccion,
                'notas' => $request->notas
            ]);
            // 🔴 IMPORTANTE: Cargar los detalles del pedido ANTES de enviar el email
        $pedido->load('detalles');
            // Enviar email de confirmación
            try {
                Mail::to(auth()->user()->email)->send(new PedidoConfirmacionMail($pedido));
            } catch (\Exception $e) {
                \Log::error('Error al enviar email: ' . $e->getMessage());
            }
            // Crear detalles del pedido
            foreach ($carrito as $id => $item) {
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $id,
                    'producto_nombre' => $item['nombre'],
                    'producto_precio' => $item['precio'],
                    'cantidad' => $item['cantidad'],
                    'subtotal' => $item['precio'] * $item['cantidad']
                ]);
                
                // Actualizar stock del producto
                $producto = Producto::find($id);
                if ($producto) {
                    $producto->stock -= $item['cantidad'];
                    $producto->save();
                }
            }
            $pedido->load('detalles');
            // Vaciar carrito
            session()->forget('carrito');
            
            DB::commit();
            
            return redirect()->route('pedidos.confirmacion', $pedido)
                ->with('success', '¡Pedido realizado con éxito!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
*/
    public function procesar(Request $request)
{
    $request->validate([
        'direccion' => 'required|string|min:5',
        'metodo_pago' => 'required|in:tarjeta,transferencia,contraentrega',
        'notas' => 'nullable|string'
    ]);

    $carrito = session()->get('carrito', []);
    
    if (empty($carrito)) {
        return redirect()->route('carrito.index')->with('error', 'Carrito vacío');
    }

    DB::beginTransaction();
    
    try {
        // Calcular total
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        // Generar número de pedido único
        $numeroPedido = 'PED-' . strtoupper(uniqid());
        
        // Crear pedido
        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'numero_pedido' => $numeroPedido,
            'total' => $total,
            'estado' => 'pendiente',
            'metodo_pago' => $request->metodo_pago,
            'direccion_envio' => $request->direccion,
            'notas' => $request->notas
        ]);
        
        // ==========================================
        // PRIMERO: Crear detalles del pedido
        // ==========================================
        foreach ($carrito as $id => $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $id,
                'producto_nombre' => $item['nombre'],
                'producto_precio' => $item['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['precio'] * $item['cantidad']
            ]);
            
            // Actualizar stock del producto
            $producto = Producto::find($id);
            if ($producto) {
                $producto->stock -= $item['cantidad'];
                $producto->save();
            }
        }
        
        // ==========================================
        // SEGUNDO: Cargar los detalles del pedido (DESPUÉS de crearlos)
        // ==========================================
        $pedido->load('detalles');
        
        // ==========================================
        // TERCERO: Enviar email de confirmación
        // ==========================================
        try {
            Mail::to(auth()->user()->email)->send(new PedidoConfirmacionMail($pedido));
        } catch (\Exception $e) {
            \Log::error('Error al enviar email: ' . $e->getMessage());
        }
        
        // Vaciar carrito
        session()->forget('carrito');
        
        DB::commit();
        
        return redirect()->route('pedidos.confirmacion', $pedido)
            ->with('success', '¡Pedido realizado con éxito!');
            
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
    }
}




    // Mostrar confirmación
    public function confirmacion(Pedido $pedido)
    {
        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('pedidos.confirmacion', compact('pedido'));
    }

    // Historial de pedidos del usuario
    public function historial()
    {
        $pedidos = Pedido::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('pedidos.historial', compact('pedidos'));
    }

    // Ver detalle de un pedido específico
    public function detalle(Pedido $pedido)
    {
        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }
        
        $pedido->load('detalles');
        
        return view('pedidos.detalle', compact('pedido'));
    }
}