<?php
declare(strict_types =1);
namespace App;
/**
 * @mixin PDO
 */


// Iska matlab:
// IDE samjhega ki DB ke paas PDO ke methods hain
// Autocomplete / type checking kaam karega
/*
@mixin PHPDoc tag hai.
Iska kaam IDE / static analysis tools ko batana hota hai ki is class me kisi doosri class ke methods “available samjhe jaayen”.

⚠️ Important: @mixin runtime par kuch nahi karta — ye sirf documentation & tooling ke liye hota hai.
*/


class DB{
    private \PDO $pdo;
    public function __construct(
        array $config
    )
    {
        $defaultOptions = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES =>false
        ];
        
         try{
            $this->pdo = new \PDO($config['driver'].':host='.$config['host'].';dbname='.$config['db_database'], $config['user'],$config['password'],
                $config['options']??$defaultOptions
            );
            // var_dump($db);
        }
        catch(\PDOException $e){
           echo $e->getMessage()." ".$e->getCode().$e->getLine();       
        }
        // return $this->pdo ;
    }
    public function __call(string $name, array $arguments)
    {
        // $name        = jis method se DB class ke Object ko call hoga
        // $arguments   = agar koi argumnet hai to array ke form me aa jayenge
        return call_user_func([$this->pdo, $name], ...$arguments);
        // $this-pdo objext ki madat se calll kare ga method ko aur useke  argument ko use karega


        // es tarah PDO class ke prepare method call ho jayega
    }
    
    // __call() PHP ka magic method hai.
    // Iska kaam hota hai undefined / inaccessible method call ko handle karna.





    /*    ...
    
    ...$arguments PHP ka spread (argument unpacking) operator hai.
                Iska kaam hai array ko individual arguments me tod dena.

                PHP manual meaning

                Argument unpacking allows an array to be expanded into a list of arguments.

                Simple example
                Without ... ❌
                function test($a, $b) {
                    var_dump($a, $b);
                }

                $args = [1, 2];
                test($args);


                ❌ Error: arguments mismatch

                With ... ✅
                function test($a, $b) {
                    var_dump($a, $b);
                }

                $args = [1, 2];
                test(...$args);


                ✔ $a = 1
                ✔ $b = 2

                Tumhare DB wrapper me
                public function __call(string $name, array $arguments)
                {
                    return $this->pdo->$name(...$arguments);
                }

                Kya hota hai

                $arguments = ["SELECT ..."]

                ...$arguments → "SELECT ..."

                Zero-argument case
                App::db()->inTransaction();


                $arguments = []

                ...$arguments → kuch bhi pass nahi hota

                PDO ko exactly 0 arguments milte hain ✅*/
}