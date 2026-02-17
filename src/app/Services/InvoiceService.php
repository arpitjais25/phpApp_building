<?php
declare(strict_types = 1);
namespace App\Services;
class InvoiceService{
    public function __construct(
        protected $selesTaxService    = new SelesTaxService(),
        protected $getewayService     = new PaymentGetewayService(),
        protected $emailService       = new EmailService()
    ){}
    
    public function process( array $customer, float $amount):bool
    {
        

        // 1.   calculate seles tex
        $tax = $this ->selesTaxService->calculate($amount, $customer);


        // 2.   process invoice
        if(! $this ->getewayService -> charge($customer, $amount, $tax)){
            return false;
        }


        // 3.   send receipt
        $this ->emailService->send($customer, 'receipt');

        return true;
    }
}