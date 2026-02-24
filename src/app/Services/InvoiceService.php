<?php
declare(strict_types = 1);
namespace App\Services;
class InvoiceService{
    public function __construct(
        
        protected PaymentGetewayService $getewayService,
        protected SelesTaxService $selesTaxService,
        protected EmailService $emailService
    ){}
    
    public function process( array $customer, float $amount):bool
    {
       
        // 1.   calculate seles tex
        $tax = $this ->selesTaxService->calculate($amount, $customer);


        // 2.   process invoice
        if(! $this ->getewayService->charge($customer, $amount, $tax)){
            return false;
        }


        // 3.   send receipt
        $this ->emailService->send($customer, 'receipt');

        echo '<h1>Invoice is completed!!</h1>';

        return true;
    }
}