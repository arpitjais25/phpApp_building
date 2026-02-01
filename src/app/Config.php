<?php
declare(strict_types =1);
namespace App;
/**
 * @property-read ?array $db
 */

/*
    @property-read  Batata hai ki property readable hai

            Lekin write (set) nahi ki ja sakti

            Usually magic __get() ke through access hoti hai

            ?array

            Property ka type:
            array | null

            $db

            Property ka naam

            Iska matlab plain language me

            👉 Is class ke paas $db naam ki ek virtual property hai
            👉 Jo read-only hai
            👉 Aur uski value array ya null ho sakti hai
*/


class Config{
    protected array $config = [];
    public function __construct($env)
    {
        $this->config = [
            'db' =>[
                'host'          => $env['DB_HOST'],
                'driver'        => $env['DB_DRIVER']??'mysql',
                'user'          => $env['DB_USER'],
                'password'      => $env['DB_PASSWORD'],
                'db_database'   => $env['DB_DATABASE']
            ],
              
        ];
    }
    public function __get($name)
    {
        return $this->config[$name]??null;
        // __get method kya karta hai ki agar aap us method ko call kar rahe hai jo exist nahi karta to use call kar dega
    }
}