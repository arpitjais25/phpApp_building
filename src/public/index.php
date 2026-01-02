<?php
require_once __DIR__."/../vendor/autoload.php";

// $a = new App\testClass();

// $id = new \Ramsey\Uuid\UuidFactory();

// echo $id->uuid4();


// echo "<pre>";

// print_r($_SERVER);

// echo "<pre>";
use App\Controllers\HomeController;
$router = new App\Router();
$router -> get('/home', [HomeController::class, 'home'] )
        -> post('/home/sucsess', [HomeController::class, 'sucsess']);


$router -> resolve(strtolower($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);