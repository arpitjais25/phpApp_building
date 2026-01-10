<?php
require_once __DIR__."/../vendor/autoload.php";
define('FILE_PATH', __DIR__ . '/../Storage');
define('VIEW_PATH', __DIR__ . '/../view');
// $a = new App\testClass();

// $id = new \Ramsey\Uuid\UuidFactory();

// echo $id->uuid4();


// echo "<pre>";

// print_r($_SERVER);

// echo "<pre>";
use App\Controllers\HomeController;
use App\Controllers\FileController;
$router = new App\Router();
$router -> get('/home', [HomeController::class, 'home'] )
        -> post('/home/sucsess', [HomeController::class, 'sucsess'])
        -> get('/home/upload', [FileController::class, 'upload_file'])
        -> post('/home/upload', [FileController::class, 'upload_sucsessfull'])
        -> post('/home/upload/display', [FileController::class, 'display_file']);


$router -> resolve(strtolower($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);