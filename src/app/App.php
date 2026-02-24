<?php

declare(strict_types=1);

namespace App;

// use App\Controllers\InvoiceController;

use App\Controllers\InvoiceController;
use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGetewayService;
use App\Services\SelesTaxService;
use Exception;
use Ramsey\Collection\Set;

class App
{
    private static DB $db;
    public static Container $container;
    public function __construct(
        protected Router $router,
        protected array $request,
        protected Config $config
    ) {
        static::$db = new DB($config->db) ?? [];
        // static::$container = new Container();
        // // var_dump(static::$container);
        // // echo"<hr>";
        // // var_dump(InvoiceService::class);
        // // echo"<hr>";
        // static::$container->set(
        //     InvoiceService::class,
        //     static function (Container $c) {/**closuer ki ek property hoti hai ki vo apni class ke $this se bind ho 
        //     jata hai    lekin ahar tum clouser ko static bana do to vah ye nahi kar paat */
        //         var_dump($c);
        //         echo"<hr>";
        //         return new InvoiceService(
        //             $c->get(SelesTaxService::class),
        //             $c->get(PaymentGetewayService::class),
        //             $c->get(EmailService::class)
                   
        //         );
        //     }
        // );

        // static::$container->set(SelesTaxService::class, fn()=>new SelesTaxService()/**yaha per callback function
        // ki madat se ham dependency ka object set karte hai */);
        // static::$container->set(EmailService::class, fn()=>new EmailService());
        // static::$container->set(PaymentGetewayService::class, fn()=>new PaymentGetewayService());
        // // var_dump(static::$container);
    }

    public static function db(): DB
    {
        // var_dump(static::$db);
        return static::$db;
    }

    public function run()
    {
        try {
            $this->router->resolve(strtolower($this->request['method']), $this->request['uri']);
        } catch (\App\Exception\ViewNotFoundException $e) {
            http_response_code(404);
            View::make('error/404');
        }
    }
}
