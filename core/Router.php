<?php

namespace app\core;
class Router {

    public Request $request;

    // array to stock routes
    protected array $routes = [];

    // get_type method implementation
    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function __construct(\app\core\Request $request) {
        $this->request = $request;
    }

    //resolve: determine path and current methods => execute and output the result
    public function resolve() {
     $path = $this->request->getPath();
     $method = $this->request->getMethod();
     $callback = $this->routes[$method][$path] ?? false;
     if ($callback === false) {
         echo "Not found";
         exit;
     }
     echo call_user_func($callback);
    }

}