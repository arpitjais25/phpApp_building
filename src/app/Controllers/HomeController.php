<?php
declare(strict_types = 1);
namespace App\Controllers;
class HomeController{
    public function home():void{
        echo "Home page<pre>";

        echo '<form action = "/home" method="POST" ><label>Amount</label><input type = "text" name="Amount"/></form>';
    }
}
?>