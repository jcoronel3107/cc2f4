<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PedidoAdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('role:Administrador'),
        ];
    }

    // Listar todos los pedidos
    public function index()
    {
        $pedidos = Pedido::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.pedidos.index', compact('pedidos'));
    }

    // Ver detalle del pedido
    public function show(Pedido $pedido)
    {
        $pedido->load('detalles', 'user');
        return view('admin.pedidos.show', compact('pedido'));
    }

    // Cambiar estado del pedido
    public function updateEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,pagado,enviado,entregado,cancelado'
        ]);

        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()->back()->with('success', 'Estado del pedido actualizado a ' . ucfirst($pedido->estado));
    }
}