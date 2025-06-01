<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UserController extends AbstractController
{
    public function login(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(LoginForm::class, $user);

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('user/login.html.twig', $model);
    }

    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterForm::class, $user);

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('user/register.html.twig', $model);
    }
}
