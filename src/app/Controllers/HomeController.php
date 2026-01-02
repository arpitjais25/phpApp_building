<?php
declare(strict_types = 1);
namespace App\Controllers;
class HomeController{
    public function home():void{
        echo "Home page<pre>";
        var_dump($_GET, $_POST);

        echo '<form action = "/home/sucsess" method="POST" ><label>Amount</label><input type = "number" name="Amount"/></form>';
    }
    public function sucsess():void{
        echo "Sucsess page<pre>";
    }
   
}
?>