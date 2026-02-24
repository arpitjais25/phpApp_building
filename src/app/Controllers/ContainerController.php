<?php
declare(strict_types = 1);
namespace App\Controllers;

use App\App;
use App\Services\InvoiceService;
use App\View;

class ContainerController{
    public function index(){
        echo "<pre>";
        
        App::$container -> get(InvoiceService::class)->process([],67);
        return View::make('index');
    }
}
?>