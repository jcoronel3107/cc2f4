<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a nuestra tienda C2StudioBIM</title>
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
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
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
        <h1>¡Bienvenido, {{ $user->name }}!</h1>
    </div>

    <div class="content">
        <p>Gracias por registrarte en <strong>{{ config('app.name') }}</strong>.</p>
        
        <p>Estamos emocionados de tenerte con nosotros. Ahora puedes:</p>
        
        <ul>
            <li>🛍️ Explorar nuestro catálogo de productos</li>
            <li>🛒 Agregar productos a tu carrito</li>
            <li>📦 Realizar tus compras de forma segura</li>
            <li>📋 Seguir el estado de tus pedidos</li>
        </ul>

        <p>Tu rol actual es: <strong>Consultor</strong>, lo que te permite comprar todos nuestros productos.</p>

        <div style="text-align: center;">
            <a href="{{ url('/productos') }}" class="button" style="color: white; background-color: #4CAF50; padding: 12px 24px; text-decoration: none; border-radius: 5px;">
                Comenzar a comprar
            </a>
        </div>

        <p>Si tienes alguna duda, no dudes en contactarnos.</p>
        
        <p>¡Gracias por confiar en nosotros!</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        <p>
            <a href="{{ url('/') }}">Ir a la tienda</a> | 
            <a href="{{ url('/conocenos') }}">Conócenos</a>
        </p>
    </div>
</body>
</html>