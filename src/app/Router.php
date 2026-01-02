<?php

declare(strict_types = 1);


namespace App;

use App\Controllers\HomeController;

class Router{
    private array $routes;
    public function register( string $routeMethod,string $route, callable|array $action):void{

        $this->routes[$routeMethod][$route] = $action;
       
        
        
    }
    public function get(string $getRoute, callable|array $getAction){
        $this->register('get',$getRoute,$getAction);
        return $this;
    }

    public function post(string $postRoute, callable|array $postAction){
        $this->register('post',$postRoute,$postAction);
        return $this;
    }
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