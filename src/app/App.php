<?php
declare(strict_types =1);
namespace App;

use Exception;

class App{
    private static DB $db;
    public function __construct(
        protected Router $router,
        protected array $request,
        protected Config $config
    )
    {
       static::$db = new DB($config->db) ?? [];
    }
    
    public static function db():DB{
        // var_dump(static::$db);
        return static::$db;
    }

    public function run(){
        try{
            $this->router -> resolve(strtolower($this->request['method']), $this->request['uri']);
        }
        catch(\App\Exception\ViewNotFoundException $e){
            http_response_code(404);
            View::make('error/404');

        }
    }
}