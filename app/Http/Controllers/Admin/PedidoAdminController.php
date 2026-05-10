<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Mail\PedidoEstadoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $estadoAnterior = $pedido->estado;
        $pedido->estado = $request->estado;
        $pedido->save();

        // Enviar email al cliente cuando el estado cambia (incluyendo cancelado)
        if ($estadoAnterior != $request->estado) {
            try {
                Mail::to($pedido->user->email)->send(new PedidoEstadoMail($pedido));
                \Log::info('Email de cambio de estado enviado a: ' . $pedido->user->email . ' - Nuevo estado: ' . $request->estado);
            } catch (\Exception $e) {
                \Log::error('Error al enviar email de cambio de estado: ' . $e->getMessage());
            }
        }

        $mensaje = 'Estado del pedido actualizado de ' . ucfirst($estadoAnterior) . ' a ' . ucfirst($pedido->estado);
        
        return redirect()->back()->with('success', $mensaje);
    }
}