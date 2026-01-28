<?php
require_once __DIR__."/../vendor/autoload.php";

// for .env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// ---------------

define('FILE_PATH', __DIR__ . '/../Storage');
define('VIEW_PATH', __DIR__ . '/../view');
// $a = new App\testClass();

// $id = new \Ramsey\Uuid\UuidFactory();

// echo $id->uuid4();


// echo "<pre>";

// print_r($_SERVER);

// echo "<pre>";
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
$router = new App\Router();
$router -> get('/home', [HomeController::class, 'home'] )
        -> get('/', [InvoiceController::class, 'index'] );


$router -> resolve(strtolower($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);