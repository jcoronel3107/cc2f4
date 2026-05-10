<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C2Studio BIM - Tu tienda de confianza</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php use Illuminate\Support\Str; @endphp
</head>
<body class="bg-gray-100">
    <!-- Navegación -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">C2Studio BIM</a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="{{ route('productos.index') }}" class="text-gray-600 hover:text-gray-800">Productos</a>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">Conócenos</a>
                        <a href="{{ route('services') }}" class="text-gray-600 hover:text-gray-800">Servicios</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('carrito.index') }}" class="text-gray-600 hover:text-gray-800">🛒 Carrito</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">Dashboard</a>
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Salir</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Registro</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="absolute inset-0 bg-black opacity-25"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">C2Studio BIM</h1>
            <p class="text-xl md:text-2xl mb-8">Los mejores productos al mejor precio</p>
            <a href="{{ route('productos.index') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition">
                Comprar Ahora
            </a>
        </div>
    </div>

    <!-- Productos Destacados -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Productos Destacados</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $productosDestacados = \App\Models\Producto::latest()->take(3)->get();
            @endphp
            
            @foreach($productosDestacados as $producto)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                @if($producto->imagen)
                    <img src="{{ $producto->imagen }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">Sin imagen</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($producto->descripcion, 80) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-green-600">${{ number_format($producto->precio, 2) }}</span>
                        <a href="{{ route('productos.show', $producto) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Características -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">¿Por qué elegirnos?</h2>
                <p class="text-gray-600 mt-2">Descubre las ventajas de comprar con nosotros</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-5xl mb-4">🚚</div>
                    <h3 class="text-xl font-bold mb-2">Envíos Rápidos</h3>
                    <p class="text-gray-600">Entregas en todo el país con total seguridad</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-4">🔒</div>
                    <h3 class="text-xl font-bold mb-2">Pago Seguro</h3>
                    <p class="text-gray-600">Múltiples métodos de pago con total seguridad</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-4">⭐</div>
                    <h3 class="text-xl font-bold mb-2">Calidad Garantizada</h3>
                    <p class="text-gray-600">Productos seleccionados de la mejor calidad</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-4">¿Listo para comprar?</h2>
            <p class="text-xl mb-8">Regístrate y comienza a disfrutar de nuestros productos</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-green-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition">
                Crear Cuenta
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} C2Studio BIM. Todos los derechos reservados.</p>
            <div class="flex justify-center space-x-4 mt-4">
                <a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Conócenos</a>
                <a href="{{ route('services') }}" class="text-gray-400 hover:text-white">Servicios</a>
                <a href="{{ route('productos.index') }}" class="text-gray-400 hover:text-white">Productos</a>
            </div>
        </div>
    </footer>
</body>
</html>