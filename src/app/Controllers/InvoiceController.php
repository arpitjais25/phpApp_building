<?php
declare(strict_types = 1);
namespace App\Controllers;

use App\App;
use App\View;
use PDO;

class InvoiceController{
    public function index(){

    // var_dump($_ENV['DB_HOST']);
        
        $db = App::db();
        // $db1 = App::db();
        // $db2 = App::db();
        // var_dump($db === $db1, $db1 === $db2, $db2===$db);
        // output - bool(true) bool(true) bool(true)  prove hai ki ek hi instance banega
        exit;
                    // var_dump($db->inTransaction());
        // $email = 'didi@gmail.com'; 
        // $full_name = 'didi';
        // try{
        //     $db->beginTransaction();
        //     $newUserStmt = $db->prepare('INSERT INTO users (email, full_name, created_at, is_active) VALUES (?,?,NOW(),1)');
        //     $newUserInvoiceStmt = $db->prepare('INSERT INTO invoise (amount, user_id) VALUES (?,?)');
        //     $newUserStmt->execute([$email, $full_name]);
        //     $user_id = $db->lastInsertId();
        //     // echo $user_id;
        //     $newUserInvoiceStmt->execute([1256.00, $user_id]);
        //     $db->commit();
        // }
        // catch(\Throwable $e){
        //     // var_dump($db->inTransaction());
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

    $userInvoiceData = $db->prepare('SELECT invoise.id AS invoice_id, user_id,amount, full_name 
                                        FROM invoise 
                                        INNER JOIN users ON user_id = users.id ');

    $userInvoiceData->execute();
    // foreach($userInvoiceData->fetchAll() as $data){
    //         echo "<pre>";
    //         var_dump($data);
    // }
    return View::make('invoice', ['invoice'=>$userInvoiceData->fetchAll()]);
    }
    

}
