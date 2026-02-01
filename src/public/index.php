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

$router = new Router();
$router -> get('/home', [HomeController::class, 'home'] )
        -> get('/', [InvoiceController::class, 'index'] );



(new App($router,[
        'uri'           => $_SERVER['REQUEST_URI'],
        'method'        =>$_SERVER['REQUEST_METHOD']

        
],[
        'host'          => $_ENV['DB_HOST'],
        'driver'        => $_ENV['DB_DRIVER']??'mysql',
        'user'          => $_ENV['DB_USER'],
        'password'      => $_ENV['DB_PASSWORD'],
        'db_database'   => $_ENV['DB_DATABASE']
]
))->run();