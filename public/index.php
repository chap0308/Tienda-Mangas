<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\APIController;
use Controllers\CarritoController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router();

// Iniciar Sesión
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//SECCION INICIO
$router->get('/', [PaginasController::class, 'index']);
$router->get('/categorias', [PaginasController::class, 'categorias']);
$router->get('/detalles', [PaginasController::class, 'detalles']);

//SECCION CARRITO
$router->get('/carrito', [CarritoController::class, 'index']);
$router->post('/carrito',[CarritoController::class,'pagar']);
$router->get('/pagado',[CarritoController::class,'pagado']);
$router->post('/pagado',[CarritoController::class,'pagado']);

//APIS
$router->get('/api/productos',[APIController::class,'index']);
$router->post('/api/compras',[APIController::class,'guardar']);

// CRUD de Productos
$router->get('/productos', [AdminController::class, 'productos']);
$router->get('/AgregarProductos', [AdminController::class, 'crear']);
$router->post('/AgregarProductos', [AdminController::class, 'crear']);
$router->get('/ActualizarProductos', [AdminController::class, 'actualizar']);
$router->post('/ActualizarProductos', [AdminController::class, 'actualizar']);
$router->post('/EliminarProductos', [AdminController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
