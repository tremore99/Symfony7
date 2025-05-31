<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class MainController extends AbstractController
{
    public function index(): Response
    {
        $model = [
            'controller_name' => 'MainController'
        ];

        return $this->render('main/index.html.twig', $model);
    }
}
