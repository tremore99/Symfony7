<?php

use App\Controller\MainController;
use App\Controller\PostController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('app_main', '/')
        ->controller([MainController::class, 'index'])
        ->methods(['GET']);
    
    $routes->add('create_post', '/create-post')
        ->controller([PostController::class, 'createPost'])
        ->methods(['GET']);
};
?>