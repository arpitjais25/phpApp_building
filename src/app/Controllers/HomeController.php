<?php
declare(strict_types = 1);
namespace App\Controllers;
class HomeController{
    public function home():void{
        echo "<h1 style= color:red>Home page</h1><pre>";
        var_dump($_GET, $_POST);

    }
   
   
}
?>