<?php
declare(strict_types=1);

spl_autoload_register(function($class_path){
    echo __DIR__."<br>autoloader run<br>";
    echo $class_path."<br>";
    $path=__DIR__. "/..". DIRECTORY_SEPARATOR.str_replace("\\", "/", $class_path).".php";
    var_dump($path);

    if(file_exists($path)){
        require_once $path;
    }
});