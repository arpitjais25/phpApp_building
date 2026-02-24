<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Container;
use App\Services\InvoiceService;
use App\View;

class ContainerController
{

    public function __construct(private InvoiceService $invoiceService) {}
    public function index()
    {
        echo "<pre>";

        $this->invoiceService->process([], 23);
        return View::make('index');
    }
}
