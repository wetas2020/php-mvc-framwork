<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public ?DbModel $user;
//    public static string $userClass;
    public string $userClass;

    public Database $database;
    public Controller $controller;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = new ($this->userClass);
            $primaryKey = $primaryKey->primaryKey();
            $this->user = new $this->userClass;
            $this->user = $this->user->findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
        
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $privateKey = $user->primaryKey();
        $primaryValue = $user->{$privateKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}