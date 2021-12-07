<?php

$app = new Application();

$app->router->get('/', function(){
    return 'Hello Wetas';
});

$app->run();