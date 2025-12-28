<?php
require_once __DIR__."/../vendor/autoload.php";
// require_once "./testClass.php";
// echo "<h1 style='color:yellow'>Jay shri ganeshay namah:::</h1>";
// echo __DIR__;
$a = new App\testClass();
// die;
$id = new \Ramsey\Uuid\UuidFactory();
echo $id->uuid4();


