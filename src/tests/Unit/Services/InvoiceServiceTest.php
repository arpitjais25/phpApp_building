<?php
declare(strict_types = 1);
namespace Tests\Unit\Services;

use App\Services\InvoiceService;
use PHPUnit\Framework\TestCase;
use App\Services\EmailService;
use App\Services\PaymentGetewayService;
use App\Services\SelesTaxService;
class InvoiceServiceTest extends TestCase{
    /**
     * @test
     */
    public function it_invoice_processed():void {

        $selesTaxServiceMock    = $this->createMock(SelesTaxService::class);
        $getewayServiceMock     = $this->createMock(PaymentGetewayService::class);
        $emailServiceMock       = $this->createMock(EmailService::class);
    
        // var_dump($emailServiceMock->send(['name' => 'Arpit'],'receipt'));
        // NOTE---> BY DEFOULT TEST DUBBELS NULL RETURN KARTE HAI AGAR HUN USKI CASTING NAHI KARTE TAB 
        // return;
        // $getewayServiceMock->method('charge')->willReturn(true);
        $invoiceServices = new InvoiceService( 
            $selesTaxServiceMock, 
            $getewayServiceMock, 
            $emailServiceMock
        );
        // Stubing charge method
        $getewayServiceMock->method('charge')->willReturn(true);
    //  when process is called
        $customer = ['Name' => 'Arpit'];
        $amount = 150;
        $result = $invoiceServices -> process($customer, $amount);

    // then assert invoice processed is successfully
        $this->assertTrue(  $result );
    }
    /**
     * @test
     */
    public function it_sends_email_receipt_when_invoice_is_processed():void {

        $customer = ['Name' => 'Arpit'];

        $selesTaxServiceMock    = $this->createMock(SelesTaxService::class);
        $getewayServiceMock     = $this->createMock(PaymentGetewayService::class);
        $emailServiceMock       = $this->createMock(EmailService::class);
    
        // var_dump($emailServiceMock->send(['name' => 'Arpit'],'receipt'));
        // NOTE---> BY DEFOULT TEST DUBBELS NULL RETURN KARTE HAI AGAR HUN USKI CASTING NAHI KARTE TAB 
        // return;
        $getewayServiceMock->method('charge')->willReturn(true);
        // Stubing Send method
         $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->with($customer, 'receipt')
        ;

        $invoiceServices = new InvoiceService( 
            $selesTaxServiceMock, 
            $getewayServiceMock, 
            $emailServiceMock
        );
       
        

       
    //  when process is called
        
        $amount = 150;
       $result =  $invoiceServices -> process($customer, $amount);

    // then assert invoice processed is successfully
        $this->assertTrue($result);
    }
}