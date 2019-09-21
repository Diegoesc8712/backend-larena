<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
// Ruta clientes
require '../src/rutas/informacionpagovirtual.php';
require '../src/rutas/historialPacientes.php';
$app->run();



