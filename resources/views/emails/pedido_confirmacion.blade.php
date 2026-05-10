<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
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
        .pedido-info {
            background-color: #e8f4e8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .bank-info {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
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
            background-color: #4CAF50;
            color: white;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .estado {
            display: inline-block;
            background-color: #ffc107;
            color: #333;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Gracias por tu compra!</h1>
    </div>

    <div class="content">
        <p>Hola <strong>{{ $pedido->user->name }}</strong>,</p>
        <p>Hemos recibido tu pedido correctamente. A continuación te mostramos los detalles:</p>

        <div class="pedido-info">
            <p><strong>Número de pedido:</strong> {{ $pedido->numero_pedido }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Estado:</strong> <span class="estado">{{ ucfirst($pedido->estado) }}</span></p>
            <p><strong>Método de pago:</strong> 
                @switch($pedido->metodo_pago)
                    @case('tarjeta') 💳 Tarjeta @break
                    @case('transferencia') 🏦 Transferencia Bancaria @break
                    @case('contraentrega') 💵 Contra entrega @break
                    @default {{ $pedido->metodo_pago }}
                @endswitch
            </p>
        </div>

        <!-- Información bancaria SOLO para transferencias -->
        @if($pedido->metodo_pago == 'transferencia')
        <div class="bank-info">
            <h3 style="margin-top: 0; color: #856404;">🏦 Datos para la transferencia</h3>
            <p><strong>Banco:</strong> {{ $bankInfo['bank_name'] }}</p>
            <p><strong>Tipo de cuenta:</strong> {{ $bankInfo['account_type'] }}</p>
            <p><strong>Número de cuenta:</strong> {{ $bankInfo['account_number'] }}</p>
            <p><strong>Titular:</strong> {{ $bankInfo['owner'] }}</p>
            <p><strong>RUC/CI:</strong> {{ $bankInfo['identification'] }}</p>
            <p style="margin-top: 10px;"><strong>Monto a transferir:</strong> <span style="font-size: 18px; color: #28a745;">${{ number_format($pedido->total, 2) }}</span></p>
            <p style="margin-top: 10px;"><em>⚠️ Por favor, realiza la transferencia y envía el comprobante a nuestro WhatsApp o correo para confirmar tu pedido.</em></p>
        </div>
        @endif

        <h3>📦 Productos comprados</h3>
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

        <div class="total">
            <p>Total del pedido: <strong style="color: #4CAF50; font-size: 22px;">${{ number_format($pedido->total, 2) }}</strong></p>
        </div>

        <h3>🚚 Dirección de envío</h3>
        <p>{{ $pedido->direccion_envio }}</p>

        @if($pedido->notas)
            <h3>📝 Notas adicionales</h3>
            <p>{{ $pedido->notas }}</p>
        @endif

        <p style="margin-top: 30px;">Pronto recibirás una notificación cuando tu pedido sea enviado.</p>
        <p>¡Gracias por confiar en nosotros!</p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no responder.</p>
        <p>© {{ date('Y') }} C2Studio BIM. Todos los derechos reservados.</p>
        <p>
            <a href="{{ url('/') }}">Ir a la tienda</a> | 
            <a href="{{ url('/pedidos/historial') }}">Ver mis pedidos</a>
        </p>
    </div>
</body>
</html>