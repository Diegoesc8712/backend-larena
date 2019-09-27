<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
// Ruta clientes
require '../src/rutas/autenticacion.php';
require '../src/rutas/citas.php';
require '../src/rutas/citaVirtual.php';
require '../src/rutas/disponibilidadAgenda.php';
require '../src/rutas/historialPacientes.php';
require '../src/rutas/informacionCompartidaHistorial.php';
require '../src/rutas/informacionCompartir.php';
require '../src/rutas/informacionPagoVirtual.php';
require '../src/rutas/tipoCitas.php';
require '../src/rutas/doctores.php';
require '../src/rutas/pacientes.php';
$app->run();



