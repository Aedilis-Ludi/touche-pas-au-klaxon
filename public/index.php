<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\UserController;
use App\Controller\AgenceController;
use App\Controller\TrajetController;

$router = new Router([
    'debug' => true,
]);

// ----------------------
// PAGE D'ACCUEIL
// ----------------------
$router->get('/', function (Request $request, Response $response) {
    (new HomeController())->index();
    return $response;
});

// ----------------------
// CONNEXION
// ----------------------
$router->get('/login', function (Request $request, Response $response) {
    (new AuthController())->login();
    return $response;
});

$router->post('/login', function (Request $request, Response $response) {
    (new AuthController())->login();
    return $response;
});

// ----------------------
// DÉCONNEXION
// ----------------------
$router->get('/logout', function (Request $request, Response $response) {
    (new AuthController())->logout();
    return $response;
});

// ----------------------
// ADMIN - UTILISATEURS
// (listing uniquement)
// ----------------------
$router->get('/admin/users', function (Request $request, Response $response) {
    (new UserController())->index();
    return $response;
});

// ----------------------
// ADMIN - AGENCES
// (CRUD agences )
// ----------------------
$router->get('/admin/agences', function (Request $request, Response $response) {
    (new AgenceController())->index();
    return $response;
});

// ----------------------
// ADMIN - TRAJETS
// ----------------------
$router->get('/admin/trajets', function (Request $request, Response $response) {
    (new TrajetController())->adminIndex();
    return $response;
});

// création trajet admin
$router->get('/admin/trajets/create', function (Request $request, Response $response) {
    (new TrajetController())->create();
    return $response;
});

$router->post('/admin/trajets/create', function (Request $request, Response $response) {
    (new TrajetController())->create();
    return $response;
});

// édition trajet admin
$router->get('/admin/trajets/edit', function (Request $request, Response $response) {
    $id = (int)($_GET['id'] ?? 0);
    (new TrajetController())->edit($id);
    return $response;
});

$router->post('/admin/trajets/edit', function (Request $request, Response $response) {
    $id = (int)($_GET['id'] ?? 0);
    (new TrajetController())->edit($id);
    return $response;
});

// suppression trajet admin
$router->get('/admin/trajets/delete', function (Request $request, Response $response) {
    $id = (int)($_GET['id'] ?? 0);
    (new TrajetController())->delete($id);
    return $response;
});

// ----------------------
// EMPLOYÉS - TRAJETS
// ----------------------

// création trajet (employé connecté)
$router->get('/trajets/create', function (Request $request, Response $response) {
    (new TrajetController())->create();
    return $response;
});

$router->post('/trajets/create', function (Request $request, Response $response) {
    (new TrajetController())->create();
    return $response;
});

// modification trajet par auteur (ou admin)
$router->get('/trajets/edit', function (Request $request, Response $response) {
    $id = (int)($_GET['id'] ?? 0);
    (new TrajetController())->edit($id);
    return $response;
});

$router->post('/trajets/edit', function (Request $request, Response $response) {
    $id = (int)($_GET['id'] ?? 0);
    (new TrajetController())->edit($id);
    return $response;
});

// ----------------------
// Lancer le router
// ----------------------
$router->run();
