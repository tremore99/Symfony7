<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\RegisterForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UserController extends AbstractController
{
    private $emi;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }

    public function login(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(LoginForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('list-posts');
        }

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('user/login.html.twig', $model);
    }

    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Good
        } else {
            // Bad
        }

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('user/register.html.twig', $model);
    }
}
