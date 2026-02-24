<?php
declare(strict_types = 1);
namespace App\Services;
class SelesTaxService{
    public function calculate(float $amount, array $customer):float{
        // sleep(1);
        return $amount *6.5/100;
    }
}