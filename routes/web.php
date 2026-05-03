<?php
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware; // ← Añade esta línea al inicio
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// RUTAS DE PRUEBA PARA ROLES
// ==========================================
Route::get('/prueba-admin', function () {
    return '✅ Eres Administrador - El middleware de roles funciona correctamente';
})->middleware(['auth', RoleMiddleware::class . ':Administrador']);

Route::get('/prueba-creador', function () {
    return '✅ Eres Creador';
})->middleware(['auth', RoleMiddleware::class . ':Creador']);

// Panel de Administración (solo para rol Administrador)
Route::middleware(['auth', RoleMiddleware::class . ':Administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});


// Rutas de productos (CRUD completo)
Route::resource('productos', ProductoController::class);

require __DIR__.'/auth.php';

// Rutas del carrito de compras
Route::middleware(['auth'])->prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/add/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::put('/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
    Route::delete('/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::delete('/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
});

Route::view('/conocenos', 'about')->name('about');
Route::view('/servicios', 'services')->name('services');

// Rutas de pedidos
Route::middleware(['auth'])->prefix('pedidos')->group(function () {
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('pedidos.checkout');
    Route::post('/procesar', [PedidoController::class, 'procesar'])->name('pedidos.procesar');
    Route::get('/confirmacion/{pedido}', [PedidoController::class, 'confirmacion'])->name('pedidos.confirmacion');
    Route::get('/historial', [PedidoController::class, 'historial'])->name('pedidos.historial');
    Route::get('/detalle/{pedido}', [PedidoController::class, 'detalle'])->name('pedidos.detalle');
});