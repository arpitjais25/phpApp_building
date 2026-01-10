<?php

namespace App;

use App\Exception\ViewNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $params = []
    ) {}
    public static function make(string $view, array $params = [])
    {
        return (string) new static($view, $params);
    }
    public function __toString()
    {

        return $this->render();
    }
    public function render()
    {
        $path = VIEW_PATH . DIRECTORY_SEPARATOR . $this->view . '.php';

        if (! file_exists($path)) {
            
                throw new ViewNotFoundException();
            
        } 
        foreach($this->params as $kye => $value){
            $$kye = $value;
        }//ye sab hum extract($this->params); ki madat se bhi kar sakte hai
        // extract($this->params);
            ob_start();
            return include $path;
        
    }
    public function __get(string $name)
    // for abstacting params 
    {
        return $this->params[$name] ?? null;
    }
}
