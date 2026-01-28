<?php
declare(strict_types = 1);
namespace App\Controllers;

use PDO;

class InvoiceController{
    public function index(){

    var_dump($_ENV['DB_HOST']);
        
        try{
            $db = new \PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'], $_ENV['DB_USER'],$_ENV['DB_PASSWORD'],[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            // var_dump($db);
        }
        catch(\PDOException $e){
           echo $e->getMessage()." ".$e->getCode().$e->getLine();       
        }
        // $email = 'chalmpa@bmw.com'; 
        // $full_name = 'champa';
        // try{
        //     $db->beginTransaction();
        //     $newUserStmt = $db->prepare('INSERT INTO users (email, full_name, created_at, is_active) VALUES (?,?,NOW(),1)');
        //     $newUserInvoiceStmt = $db->prepare('INSERT INTO invoise (amount, user_id) VALUES (?,?)');
        //     $newUserStmt->execute([$email, $full_name]);
        //     $user_id = $db->lastInsertId();
        //     // echo $user_id;
        //     $newUserInvoiceStmt->execute([100, $user_id]);
        //     $db->commit();
        // }
        // catch(\Throwable $e){
        //     if($db->inTransaction()){
        //         $db->rollBack();
        //     }
        //     throw $e;

        // }
        // REAL PROBLEM (IMPORTANT)
// ❌ Data inconsistency ka risk

// Agar:

// user insert ho gaya ✅

// lekin invoice insert fail ho gaya ❌

// ➡️ Database half-broken state me chala jayega
// (user bina invoice)
// ------------- isi se bachne ke liye hum use karte hai ye⬆️⬆️⬆️



    // NOW PRINTING DATA----

    $userInvoiceData = $db->prepare('SELECT invoise.id AS invoice_id, user_id,amount, full_name FROM invoise INNER JOIN 
                                        users ON user_id = users.id ');

    $userInvoiceData->execute();
    foreach($userInvoiceData->fetchAll() as $data){
            echo "<pre>";
            var_dump($data);
    }
    }

}
