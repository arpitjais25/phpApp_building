<?php

declare(strict_types = 1);


namespace App;


use App\Exception\RouteNotFoundException;

class Router{
    private array $routes = [];
    public function register( string $routeMethod,string $route, callable|array $action):void{

        $this->routes[$routeMethod][$route] = $action;
       
        
        
    }
    public function get(string $getRoute, callable|array $getAction):Router{
        $this->register('get',$getRoute,$getAction);
        return $this;
    }

    public function post(string $postRoute, callable|array $postAction):Router{
        $this->register('post',$postRoute,$postAction);
        return $this;
    }
    public function routes(){
        return $this->routes;
    }
    public function resolve($requestMethod, $requestUri) {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;
        if(!$action){
            throw new RouteNotFoundException();
        }
        if (is_callable($action)) {

            return call_user_func($action);
        }
        if(is_array($action)){
            
            [$class , $method] = $action;

            if(class_exists($class)){
                $route_class_instanc = new $class ();
           
                if(method_exists($route_class_instanc, $method)){
                    return call_user_func([$route_class_instanc, $method], [0]);

                }
            }
                 
        }
        // throw new Exception\RouteNotFoundException();
        throw new RouteNotFoundException();
    }
    
    
}