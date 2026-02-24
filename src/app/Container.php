<?php
declare(strict_types = 1);
namespace App;

use App\Exception\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface {
    protected array $entries = [];
    public function get(string $id)
    {
        // TODO: Implemant get() method
        if(! $this->has($id)){
            throw new NotFoundException('Class' .$id. 'has no building/binding');
        }


        $entry/**ye vahi function hai jo set method ke dvara aayega aur ha get
        ke jariye function ke argument me container ka object bhej denge */ = $this->entries[$id];
        // var_dump($entry);
        return $entry($this);
    }
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }
    public function set(string $id, callable $concrete):void{
        $this->entries[$id] = $concrete;// entries[id] me callbacke function jo return karega vo save kar dega
        // set method ko define karte samay han callable function kya return karega define karenge
        echo "<pre>";
        // var_dump($concrete);
        
        // var_dump($this->entries);

    }
}


?>
