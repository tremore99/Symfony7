<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationForm;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function register(Request $request, UserService $userService): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pass = $form->get('password')->getData();

            $userService->save($user, $pass);

            return $this->redirectToRoute('app-main');
        }

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('registration/register.html.twig', $model);
    }

    public function update(Request $request, UserService $userService): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $userService->update($user);

            return $this->redirectToRoute('profile');
        }

        $model = [
            'form' => $form->createView(),
            'pic' => $userService->getPicturePath()
        ];

        return $this->render('profile/index.html.twig', $model);
    }

    
}
