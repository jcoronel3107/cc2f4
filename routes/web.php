<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PedidoAdminController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

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

// Rutas de prueba
Route::get('/prueba-admin', function () {
    return '✅ Eres Administrador';
})->middleware(['auth', RoleMiddleware::class . ':Administrador']);

Route::get('/prueba-creador', function () {
    return '✅ Eres Creador';
})->middleware(['auth', RoleMiddleware::class . ':Creador']);

// Panel de Administración
Route::middleware(['auth', RoleMiddleware::class . ':Administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/pedidos', [PedidoAdminController::class, 'index'])->name('admin.pedidos.index');
    Route::get('/pedidos/{pedido}', [PedidoAdminController::class, 'show'])->name('admin.pedidos.show');
    Route::put('/pedidos/{pedido}/estado', [PedidoAdminController::class, 'updateEstado'])->name('admin.pedidos.estado');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Productos
Route::resource('productos', ProductoController::class);

// Carrito
Route::middleware(['auth'])->prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/add/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::put('/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
    Route::delete('/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::delete('/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
});

// Páginas informativas
Route::view('/conocenos', 'about')->name('about');
Route::view('/servicios', 'services')->name('services');

// Pedidos
Route::middleware(['auth'])->prefix('pedidos')->group(function () {
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('pedidos.checkout');
    Route::post('/procesar', [PedidoController::class, 'procesar'])->name('pedidos.procesar');
    Route::get('/confirmacion/{pedido}', [PedidoController::class, 'confirmacion'])->name('pedidos.confirmacion');
    Route::get('/historial', [PedidoController::class, 'historial'])->name('pedidos.historial');
    Route::get('/detalle/{pedido}', [PedidoController::class, 'detalle'])->name('pedidos.detalle');
});

require __DIR__.'/auth.php';