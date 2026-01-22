<?php
declare(strict_types = 1);
namespace App\Controllers;

use App\View;
use PDO;

class HomeController{
    public function home(){

    //sql injuction query-> http://localhost:8000/home?email=arpit@gmail.com%22+OR+1=1+--+
        
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
        $email = $_GET['email']??'';
        var_dump($email);
        // $emailArray=[$email];
        $query = 'SELECT* FROM users WHERE email = ? ';
        // $stmt = $db->query($query);
        // var_dump($stmt);
        echo $query;
        echo"<pre>";
        // var_dump($stmt->fetchAll(PDO::FETCH_OBJ)); EK TO YE MADHYAM HAI
        // ya fhir connection banate time me PDO constructor
        // me last argunment array pe set kar do
        // foreach ($db->query($query) as $user){
        //     var_dump($user);
        // }

        // parantu yaha per ek badi problem hai SQL Injuction---

        /*dekho
            mine url me diya-
                http://localhost:8000/home?email=arpit@gmail.com%22+OR+1=1+--+


                output-
                
                object(stdClass)#8 (4) {
                ["id"]=>
                int(1)
                ["email"]=>
                string(15) "arpit@gmail.com"
                ["full_name"]=>
                string(5) "arpit"
                ["is_active"]=>
                int(1)
                }
                object(stdClass)#9 (4) {
                ["id"]=>
                int(2)
                ["email"]=>
                string(13) "ram@gmail.com"
                ["full_name"]=>
                string(3) "ram"
                ["is_active"]=>
                int(0)
                }
                object(stdClass)#8 (4) {
                ["id"]=>
                int(3)
                ["email"]=>
                string(15) "seeta@gmail.com"
                ["full_name"]=>
                string(5) "seeta"
                ["is_active"]=>
                int(1)
                }
                object(stdClass)#9 (4) {
                ["id"]=>
                int(4)
                ["email"]=>
                string(14) "ramu@gmail.com"
                ["full_name"]=>
                string(4) "ramu"
                ["is_active"]=>
                int(1)
                }
                object(stdClass)#8 (4) {
                ["id"]=>
                int(5)
                ["email"]=>
                string(16) "laxman@gmail.com"
                ["full_name"]=>
                string(6) "laxman"
                ["is_active"]=>
                int(1)
                }

            table ka sara data print ho gay ek injuction per


            esse bachne ke hum use karte hai prepare statement----

            aur placeholder


        */
        echo "<h1>IN PREPARE STATEMENT</h1><br>";
        $stmt = $db->prepare($query);
        var_dump($stmt);
        // $stmt->bindValue($email);
        /*return--object(PDOStatement)*/$stmt->execute([$email]);
        /*
            object(PDOStatement)#6 (1) {
            ["queryString"]=>
                    string(34) "SELECT* FROM users WHERE email = ?"
            }
         */
        // var_dump($stmt);
        var_dump($stmt->rowCount());
        var_dump($stmt->fetchAll());
           

        echo"</pre>";
    // Ab hu shikhenge namedParameter, placehoder indexing aur index paraneter 

    $email2 = 'bob@gmail.com';
    $full_name = 'bob';
    $isActive = 0;
    $created_at = date('Y-m-d H:m:i', strtotime('26-01-22 11:33AM'));
    // $stmt->execute([$email2,$full_name,$created_at,$isActive]);
    // ----- ye hum padh chuke hai
     // -- Plasce hoder
    $query2 = 'INSERT INTO users (email, full_name, created_at, is_active) 
                VALUES (:email,  :full_name, :created_at, :is_active)';
    $stmt = $db->prepare($query2);

    // placehoder indexing 
    // $query2 = 'INSERT INTO users (email, full_name, created_at, is_active) 
    //             VALUES (?,?,?,?)';
    // $stmt->bindValue(1, $email2);
    // $stmt->bindValue(4, $isActive, PDO::PARAM_BOOL);
    // $stmt->bindValue(3, $created_at);
    // $stmt->bindValue(2, $full_name);
    
// index paraneter
    $stmt->bindValue(':email', $email2);
    $stmt->bindValue(':is_active', $isActive, PDO::PARAM_BOOL);
    $stmt->bindValue(':created_at', $created_at);
    $stmt->bindValue(':full_name', $full_name);
   
    

   $stmt->execute();

    $id = $db->lastInsertId();

    foreach ($db->query('SELECT * FROM users WHERE id ='.$id) as $user){
            var_dump($user);
        }
    }
   
   
}
?>