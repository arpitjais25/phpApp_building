<?php

declare(strict_types=1);

namespace App;

use App\Exception\Container\ContainerException;
use App\Exception\NotFoundException;
use Psr\Container\ContainerInterface;
use App;

class Container implements ContainerInterface
{
    protected array $entries = [];
    public function get(string $id)
    {
        // TODO: Implemant get() method
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            return $entry($this);
        }
        return $this->resolve($id);
    }
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }
    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete; // entries[$id] me callbacke function jo return karega vo save kar dega
        // set method ko define karte samay han callable function kya return karega define karenge


    }
    public function resolve(String $id)
    {

        // 1.   Inspect the class that we are trying to get from the container by Using Reflection API
        $reflectionClass = new \ReflectionClass($id);
        // befoure moving next Step we are check the class is insetanciable or not becouse class to be a 
        // Interface or abstract class

        if (! $reflectionClass->isInstantiable()) {
            throw new ContainerException("Class " . $id . ' is not Instantiable.');
        }
        // Now we are rady to move on step number 2

        // 2.   Inspect The Container of the class
        $constructor = $reflectionClass->getConstructor();
        /**@return \ReflectionMethod|null */
        // var_dump($constructor);
        // $constructor has the Object of 
        if (! $constructor) {
            return new $id;
        }

        // 3.   Inspect the Container Parametres (dependencies)
        $parameter = $constructor->getParameters();
        var_dump($parameter);
        // if class not have any dependency (no have any parapeter) eassy to make object

        if (! $parameter) {
            return new $id;
        }

        // 4.   If Container parameter is a class then try to resolve that calss using Container

        $dependencies = array_map(function (\ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();
            // var_dump($name, $type->getName());
            // agar class ka type Object type ka na hua koi Array type ya string type ka hua to vo kaha instanciate
            // hoga to ham pahil type check karenge
            if (! $type) {
                throw new ContainerException(
                    'Failed to resolve the class ' . $id . ' because param ' . $name . ' is missing to type hint'
                );
            } 


            if ($type instanceof \ReflectionUnionType){
                throw new ContainerException(
                    'Failed to resolve the class ' . $id . ' because of union type for param ' . $name . ''
                );
            }

            if($type instanceof \ReflectionNamedType && ! $type->isBuiltin()){
                return $this->get($type->getName());
            }

            throw new ContainerException(
                'Failed to resolve the class ' . $id . ' because invalid param ' . $name . ''
            );
            
        }, $parameter);
        var_dump($dependencies);
        return $reflectionClass ->newInstanceArgs($dependencies);
    }

}
