<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actualización de tu Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2196F3;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .estado {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
        }
        .estado-pagado { background-color: #2196F3; color: white; }
        .estado-enviado { background-color: #FF9800; color: white; }
        .estado-entregado { background-color: #4CAF50; color: white; }
        .estado-cancelado { background-color: #f44336; color: white; }
        .pedido-info {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #2196F3;
            color: white;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Actualización de tu Pedido</h1>
    </div>

    <div class="content">
        <p>Hola <strong>{{ $pedido->user->name }}</strong>,</p>

        <p>Tu pedido <strong>#{{ $pedido->numero_pedido }}</strong> ha cambiado de estado:</p>

        <div class="pedido-info">
            <p><strong>Estado actual:</strong> 
                <span class="estado estado-{{ $pedido->estado }}">
                    {{ ucfirst($pedido->estado) }}
                </span>
            </p>
            <p><strong>Fecha de actualización:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        <h3>📦 Resumen de tu pedido</h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto_nombre }}</td>
                    <td>${{ number_format($detalle->producto_precio, 2) }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: right; font-size: 18px; font-weight: bold;">
            Total: ${{ number_format($pedido->total, 2) }}
        </div>

        @if($pedido->estado == 'enviado')
            <p style="margin-top: 30px;">📦 Tu pedido está en camino. Pronto recibirás tu producto.</p>
        @elseif($pedido->estado == 'entregado')
            <p style="margin-top: 30px;">✅ ¡Tu pedido ha sido entregado! Esperamos que disfrutes tu compra.</p>
        @elseif($pedido->estado == 'cancelado')
            <p style="margin-top: 30px;">❌ Tu pedido ha sido cancelado. Si tienes dudas, contáctanos.</p>
        @elseif($pedido->estado == 'pagado')
            <p style="margin-top: 30px;">💰 El pago de tu pedido ha sido confirmado. Pronto lo enviaremos.</p>
        @endif

        <p>Puedes ver el detalle de tu pedido en:</p>
        <p><a href="{{ url('/pedidos/detalle/' . $pedido->id) }}">Ver detalle del pedido</a></p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Mi Tienda. Todos los derechos reservados.</p>
    </div>
</body>
</html>