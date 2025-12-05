<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use Core\Request;
use Core\Router;
use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $router = new Router();
    $request = new Request();

    $router->get('/', [HomeController::class, 'index']);

    $router->dispatch($request);
} catch (\Throwable $th) {
    echo 'Error: ' . $th->getMessage();
}
