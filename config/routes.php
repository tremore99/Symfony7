<?php

use App\Controller\MainController;
use App\Controller\PostController;
use App\Controller\LoginController;
use App\Controller\UserController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('app-main', '/')
        ->controller([MainController::class, 'index']);
    
    $routes->add('create-post', '/post/create')
        ->controller([PostController::class, 'createPost']);

    $routes->add('list-post', '/post/list')
        ->controller([PostController::class, 'listAllPosts']);

    $routes->add('edit-post', '/post/edit-{id}')
        ->controller([PostController::class, 'editPost']);

    $routes->add('delete-post', '/post/delete-{id}')
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
