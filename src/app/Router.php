<?php

declare(strict_types = 1);


namespace App;

use App\Controllers\HomeController;

class Router{
    private array $routes;
    public function register(string $requestMethod, string $route, callable|array $action):self{

        $this->routes[$requestMethod][$route] = $action;
       
        
        return $this;
    }
    // public function getRoute()
    public function resolve($requestMethod, $requestUri) {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;
        if(!$action){
            throw new \Exception($action."galat hai");
        }
        if (is_callable($action)) {

            return call_user_func($action);
        }
        if(is_array($action)){
            
            [$class , $method] = $action;


            $route_class_instanc = new $class ();
           
            return call_user_func([$route_class_instanc, $method], [0]);

            
        }
    }
}