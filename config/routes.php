<?php

use App\Controller\MainController;
use App\Controller\PostController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('app-main', '/')
        ->controller([MainController::class, 'index'])
        ->methods(['GET']);
    
    $routes->add('create-post', '/create-post')
        ->controller([PostController::class, 'createPost'])
        ->methods(['GET', 'POST']);

    $routes->add('list-posts', '/list-posts')
        ->controller([PostController::class, 'listAllPosts']);

    $routes->add('edit-post', '/edit-post/{id}')
        ->controller([PostController::class, 'editPost']);

    $routes->add('delete-post', '/delete-post/{id}')
        ->controller([PostController::class, 'deletePost']);
};
?>
