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

use App\App;

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Router;
use App\Config;
use App\Container;
use App\Services\InvoiceService;
use App\Controllers\ContainerController;

$router = new Router();
$router -> get('/home', [HomeController::class, 'home'] )
        -> get('/', [ContainerController::class, 'index'] )
        ->get('/invoice',[InvoiceService::class, 'process']);



(new App($router,[
        'uri'           => $_SERVER['REQUEST_URI'],
        'method'        =>$_SERVER['REQUEST_METHOD']

        
],(new Config($_ENV))
))->run();
