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
        .header-cancelado {
            background-color: #f44336;
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
        .pedido-info-cancelado {
            background-color: #ffebee;
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
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header <?php echo e($pedido->estado == 'cancelado' ? 'header-cancelado' : ''); ?>">
        <h1>Actualización de tu Pedido</h1>
    </div>

    <div class="content">
        <p>Hola <strong><?php echo e($pedido->user->name); ?></strong>,</p>

        <p>Tu pedido <strong>#<?php echo e($pedido->numero_pedido); ?></strong> ha cambiado de estado:</p>

        <div class="pedido-info <?php echo e($pedido->estado == 'cancelado' ? 'pedido-info-cancelado' : ''); ?>">
            <p><strong>Estado actual:</strong> 
                <span class="estado estado-<?php echo e($pedido->estado); ?>">
                    <?php switch($pedido->estado):
                        case ('pagado'): ?> 💰 Pagado <?php break; ?>
                        <?php case ('enviado'): ?> 📦 Enviado <?php break; ?>
                        <?php case ('entregado'): ?> ✅ Entregado <?php break; ?>
                        <?php case ('cancelado'): ?> ❌ Cancelado <?php break; ?>
                        <?php default: ?> <?php echo e(ucfirst($pedido->estado)); ?>

                    <?php endswitch; ?>
                </span>
            </p>
            <p><strong>Fecha de actualización:</strong> <?php echo e(now()->format('d/m/Y H:i')); ?></p>
        </div>

        <?php if($pedido->estado == 'cancelado'): ?>
        <div style="background-color: #ffebee; border-left: 4px solid #f44336; padding: 15px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #c62828;">⚠️ Pedido Cancelado</h3>
            <p>Tu pedido ha sido cancelado. Si realizaste un pago, este será reembolsado en un plazo de 3-5 días hábiles.</p>
            <p>Si tienes alguna duda, por favor contáctanos.</p>
        </div>
        <?php endif; ?>

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
                <?php $__currentLoopData = $pedido->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($detalle->producto_nombre); ?></td>
                    <td>$<?php echo e(number_format($detalle->producto_precio, 2)); ?></td>
                    <td><?php echo e($detalle->cantidad); ?></td>
                    <td>$<?php echo e(number_format($detalle->subtotal, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div style="text-align: right; font-size: 18px; font-weight: bold;">
            Total: $<?php echo e(number_format($pedido->total, 2)); ?>

        </div>

        <?php if($pedido->estado == 'enviado'): ?>
            <p>📦 Tu pedido está en camino. Pronto recibirás tu producto.</p>
        <?php elseif($pedido->estado == 'entregado'): ?>
            <p>✅ ¡Tu pedido ha sido entregado! Esperamos que disfrutes tu compra.</p>
        <?php elseif($pedido->estado == 'pagado'): ?>
            <p>💰 El pago de tu pedido ha sido confirmado. Pronto lo enviaremos.</p>
        <?php elseif($pedido->estado == 'cancelado'): ?>
            <p>❌ Tu pedido ha sido cancelado. Para más información, contáctanos.</p>
        <?php endif; ?>

        <div style="text-align: center;">
            <a href="<?php echo e(url('/pedidos/detalle/' . $pedido->id)); ?>" class="button">Ver detalle del pedido</a>
        </div>

        <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
    </div>

    <div class="footer">
        <p>© <?php echo e(date('Y')); ?> C2Studio BIM. Todos los derechos reservados.</p>
    </div>
</body>
</html><?php /**PATH D:\desarrollo\cc2f4\cc2f4\resources\views/emails/pedido_estado.blade.php ENDPATH**/ ?>