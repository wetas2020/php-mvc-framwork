<?php

namespace app\core;
class Application {
    
    public \app\core\Router $router;

    public function __construct() {
        
        $this->router = new Router();
    }

    public function run() {
        
    }
}