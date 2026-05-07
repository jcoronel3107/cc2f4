<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

+++++++++++++++++++++++++++++++++++++++++
Resumen de cada rol:
Rol	¿Qué puede hacer?	¿Para quién?
Consultor	Solo ver productos y comprar	👥 Clientes normales
Creador	Ver, comprar Y crear productos	📝 Encargado de agregar productos
Editor	Ver, comprar Y editar productos	✏️ Encargado de modificar productos
Administrador	Todo (crear, editar, eliminar, gestionar usuarios, pedidos)	🔧 Dueño del negocio / Admin
+++++++++++++++++++++++


RResumen final - Todo lo que tiene tu sistema:
Módulo	Estado
Autenticación (registro/login)	✅
Roles (Admin, Creador, Editor, Consultor)	✅
Registro automático con rol Consultor	✅
Dashboard con botones según el rol	✅
CRUD de productos	✅
Subida de imágenes	✅
Carrito de compras	✅
Finalizar compra (checkout)	✅
Historial de pedidos	✅
Panel de Administración	✅
Gestión de usuarios (Admin)	✅
Gestión de pedidos (Admin)	✅
Páginas Conócenos y Servicios	✅
Envío de emails de bienvenida	✅
Estructura completa del sitio
text
http://cc2f4.test
├── /login                 # Iniciar sesión
├── /register              # Registrarse
├── /productos             # Lista de productos
├── /productos/create      # Crear producto (Creador/Admin)
├── /productos/{id}/edit   # Editar producto (Editor/Admin)
├── /carrito               # Carrito de compras
├── /pedidos/checkout      # Finalizar compra
├── /pedidos/historial     # Mis pedidos (usuario)
├── /admin/dashboard       # Panel de Admin
├── /admin/pedidos         # Gestionar pedidos (Admin)
├── /conocenos             # Página informativa
└── /servicios             # Página informativa
Flujo completo de compra
Usuario se registra → http://cc2f4.test/register

Agrega productos al carrito → http://cc2f4.test/productos

Revisa el carrito → http://cc2f4.test/carrito

Finaliza la compra → Completa dirección y método de pago

Recibe confirmación → Ve el número de pedido

Administrador cambia el estado → De "pendiente" a "entregado"

Próximos pasos opcionales
Pendiente___Envío de emails - Confirmación de pedido al cliente

Pendiente___Facturación - Generar PDF de la factura

Pendiente___Buscador de productos - Filtrar productos por nombre

Pendiente___Categorías - Clasificar productos

Pendiente___Calificaciones - Puntuar productos comprados

Pendiente___Pasarela de pago - Integrar PayPal o Stripe

