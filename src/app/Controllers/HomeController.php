<?php
declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use PDO;

class HomeController{
    public function home(){
        
        // $db = new PDO("mysql:host=localhost;dbname=my_db","root","root"); yaha per host=localhost naho hoga qki db ke 
        // liye ek alag container hai 
        // $db = new PDO("mysql:host=db;dbname=my_db","root","root");
        // -----connection stablesh


        // $db = new PDO("mysql:host=db;dbname=my_db","root","roothhh");
        /*
        Fatal error: Uncaught PDOException: SQLSTATE[HY000] [1045] Access 
        denied for user 'root'@'172.18.0.2' (using password: YES)
         in /var/www/app/Controllers/HomeController.php:13 
         Stack trace: #0 /var/www/app/Controllers/
         HomeController.php(13): PDO->__construct('mysql:host=db;d...', 'root', Object(SensitiveParameterValue)) 
         #1 [internal function]: App\Controllers\HomeController->home(Array) 
         #2 /var/www/app/Router.php(45): call_user_func(Array, Array) 
         #3 /var/www/public/index.php(23): App\Router->resolve('get', '/home') 
         #4 {main} thrown in /var/www/app/Controllers/HomeController.php on line 13
         
         Agar gum galti se koi wrong value dal deta hai to hamari
          gopniy chje bhi dekh jati hai jiske lye hum use karte hai exeption 
          handling
         */

        try{
            $db = new PDO("mysql:host=db;dbname=my_db", "root", "root", [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            
        }
        catch(\PDOException $e){
            throw new \PDOException($e->getMessage());
        }

        $query = "SELECT* FROM users" ;
        $stmt = $db->query($query);
        echo"<pre>";
        // var_dump($stmt->fetchAll(PDO::FETCH_OBJ)); EK TO YE MADHYAM HAI
        // ya fhir connection banate time me PDO constructor
        // me last argunment array pe set kar do
        foreach ($stmt->fetchAll(PDO::FETCH_CLASS) as $user){
            var_dump($user);
        }
        echo"</pre>";

        // return View::make('index');
    }
   
   
}
?>