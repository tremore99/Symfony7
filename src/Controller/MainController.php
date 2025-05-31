<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $model = [
            'controller_name' => 'MainController'
        ];
        
        return $this->render('main/index.html.twig', $model);
    }

    #[Route('/create-post', name: 'create-post')]
    public function createPost(): Response
    {
        $post = new Post();
        $form = $this->createForm(PostForm::class, $post);

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('main/post.html.twig', $model);
    }
}
