<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class PostController extends AbstractController
{
    public function createPost(): Response
    {
        $post = new Post();
        $form = $this->createForm(PostForm::class, $post);

        $model = [
            'form' => $form->createView()
        ];

        return $this->render('post/index.html.twig', $model);
    }
}
