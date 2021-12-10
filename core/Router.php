<?php

namespace app\core;
class Router
{

    public Request $request;
    public Response $response;

    // array to stock routes
    protected array $routes = [];

    // get_type method implementation
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    // post_type method implementation
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    //resolve: determine path and current methods => execute and output the result
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }
        return call_user_func($callback, $this->request) ;
    }

    //replace the layout placeholder with the content of the view
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    // render content for status code and server messages
//    public function renderContent($viewContent)
//    {
//        $layoutContent = $this->layoutContent();
//        return str_replace('{{ content }}', $viewContent, $layoutContent);
//    }

    // get the value of layout
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    // get the value of view
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }


        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}