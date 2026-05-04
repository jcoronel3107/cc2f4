<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Pedido</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4CAF50; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px; }
        .pedido-info { background-color: #e8f4e8; padding: 15px; border-radius: 5px; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .total { text-align: right; font-size: 18px; font-weight: bold; margin-top: 20px; }
        .footer { text-align: center; padding-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Gracias por tu compra!</h1>
    </div>

    <div class="content">
        <p>Hola <strong>{{ $pedido->user->name }}</strong>,</p>
        <p>Hemos recibido tu pedido correctamente.</p>

        <div class="pedido-info">
            <p><strong>Número de pedido:</strong> {{ $pedido->numero_pedido }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
        </div>

        <h3>Detalles del pedido</h3>
        <table>
            <thead>
                <tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>
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
            <p>Total: <strong style="color:#4CAF50;">${{ number_format($pedido->total, 2) }}</strong></p>
        </div>

        <p>¡Gracias por confiar en nosotros!</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Mi Tienda. Todos los derechos reservados.</p>
    </div>
</body>
</html>