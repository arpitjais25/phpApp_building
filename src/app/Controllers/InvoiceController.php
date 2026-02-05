<?php
declare(strict_types = 1);
namespace App\Controllers;


use App\Models\Invoice;
use App\Models\User;
use App\Models\SignUp;

use App\View;


class InvoiceController{
    public function index(){
       
        $email = 'sunny@gmail.com'; 
        $full_name = 'sunny';
        $amount = 58846;

        $userModel = new User();
        $invoiceModel = new Invoice();
        
        $invoiceId = new SignUp($userModel, $invoiceModel);
        $invoiceId->register(
            [
                'email' => $email,
                'user_name' => $full_name
            ],

            [
                'amount' => $amount
            ]
        );

   
    return View::make('invoice', ['invoice'=>$invoiceModel->find()]);
    }
    

}
