<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conócenos - Nuestra Empresa</title>
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
                <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200');">
                    <div class="h-full bg-black bg-opacity-50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-5xl text-white font-bold">Conócenos</h1>
                    </div>
                </div>
                
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-4">¿Quiénes Somos?</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Somos una empresa dedicada a ofrecer los mejores productos con la más alta calidad. 
                        Desde nuestro inicio, nos hemos comprometido a brindar experiencias de compra excepcionales 
                        a todos nuestros clientes.
                    </p>
                    
                    <h2 class="text-2xl font-bold mb-4 mt-8">Nuestra Misión</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Proporcionar productos innovadores y de calidad a precios competitivos, superando las 
                        expectativas de nuestros clientes y contribuyendo a su satisfacción y bienestar.
                    </p>
                    
                    <h2 class="text-2xl font-bold mb-4 mt-8">Nuestra Visión</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Ser la empresa líder en el mercado, reconocida por nuestra excelencia en servicio, 
                        calidad de productos y compromiso con la satisfacción del cliente.
                    </p>
                    
                    <h2 class="text-2xl font-bold mb-4 mt-8">Nuestros Valores</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="flex items-start space-x-3">
                            <span class="text-green-500 text-xl">✓</span>
                            <div>
                                <h3 class="font-semibold">Calidad</h3>
                                <p class="text-gray-600 text-sm">Productos seleccionados con los más altos estándares</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-green-500 text-xl">✓</span>
                            <div>
                                <h3 class="font-semibold">Honestidad</h3>
                                <p class="text-gray-600 text-sm">Transparencia en todas nuestras operaciones</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-green-500 text-xl">✓</span>
                            <div>
                                <h3 class="font-semibold">Compromiso</h3>
                                <p class="text-gray-600 text-sm">Dedicación total con nuestros clientes</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-green-500 text-xl">✓</span>
                            <div>
                                <h3 class="font-semibold">Innovación</h3>
                                <p class="text-gray-600 text-sm">Siempre a la vanguardia en productos y servicios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>