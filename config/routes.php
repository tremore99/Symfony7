<?php

use App\Controller\MainController;
use App\Controller\PostController;
use App\Controller\LoginController;
use App\Controller\UserController;
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

    $routes->add('login', '/login')
        ->controller([LoginController::class, 'login']);

    $routes->add('logout', '/logout')
        ->controller([LoginController::class, 'logout']);

    $routes->add('register', '/register')
        ->controller([UserController::class, 'register']);

    $routes->add('profile', '/profile')
        ->controller([UserController::class, 'update']);
};
?>
