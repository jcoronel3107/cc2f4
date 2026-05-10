<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Lo que ofrecemos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto px-4 py-8">
            <!-- Botón para regresar al Dashboard -->
            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al Dashboard
                </a>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200');">
                    <div class="h-full bg-black bg-opacity-50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-5xl text-white font-bold">Nuestros Servicios</h1>
                    </div>
                </div>
                
                <div class="p-8">
                    <p class="text-gray-700 mb-8 text-center text-lg">
                        Ofrecemos una amplia gama de servicios para satisfacer todas tus necesidades
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">🛍️</div>
                            <h3 class="text-xl font-bold mb-2">Venta de Productos</h3>
                            <p class="text-gray-600">Amplio catálogo de productos de alta calidad con los mejores precios del mercado.</p>
                        </div>
                        
                        <div class="border rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">🚚</div>
                            <h3 class="text-xl font-bold mb-2">Envíos a Domicilio</h3>
                            <p class="text-gray-600">Entregas rápidas y seguras a cualquier parte del país, con seguimiento en tiempo real.</p>
                        </div>
                        
                        <div class="border rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">💳</div>
                            <h3 class="text-xl font-bold mb-2">Múltiples Métodos de Pago</h3>
                            <p class="text-gray-600">Aceptamos tarjetas de crédito, débito, transferencias y pagos en efectivo.</p>
                        </div>
                        
                        <div class="border rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">🔄</div>
                            <h3 class="text-xl font-bold mb-2">Garantía y Devoluciones</h3>
                            <p class="text-gray-600">30 días de garantía en todos nuestros productos y devoluciones sin complicaciones.</p>
                        </div>
                        
                        <div class="border rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">🎁</div>
                            <h3 class="text-xl font-bold mb-2">Promociones y Descuentos</h3>
                            <p class="text-gray-600">Ofertas exclusivas para clientes frecuentes y promociones por temporada.</p>
                        </div>
                        
                        <div class="border rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">💬</div>
                            <h3 class="text-xl font-bold mb-2">Atención al Cliente 24/7</h3>
                            <p class="text-gray-600">Soporte permanente para resolver todas tus dudas e inquietudes.</p>
                        </div>
                    </div>

                    <!-- Botón adicional para regresar -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('dashboard') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Ir al Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>