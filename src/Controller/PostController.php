<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

final class PostController extends AbstractController
{
    private $emi;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }

    public function listAllPosts(): Response
    {
        $posts = $this->emi->getRepository(Post::class)->findAll();

        return $this->render('post/list.html.twig', ['posts' => $posts]);
    }

    public function createPost(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostForm::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->emi->persist($post);
            $this->emi->flush();

            $this->addFlash('message', 'Inserted successfully!');
            return $this->redirectToRoute('list-posts');
        }

        $model = [
            'title' => 'Create Post',
            'buttonText' => 'Create',
            'form' => $form->createView()
        ];

        return $this->render('post/post.html.twig', $model);
    }

    public function editPost(Post $post, Request $request): Response
    {
        $form = $this->createForm(PostForm::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->emi->persist($post);
            $this->emi->flush();

            $this->addFlash('message', 'Edited successfully!');
            return $this->redirectToRoute('list-posts');
        }

        $model = [
            'title' => 'Edit Post',
            'buttonText' => 'Edit',
            'form' => $form->createView()
        ];

        return $this->render('post/post.html.twig', $model);
    }

    public function deletePost(Post $post): Response
    {
        $this->emi->remove($post);
        $this->emi->flush();

        $this->addFlash('message', 'Deleted successfully!');
        return $this->redirectToRoute('list-posts');
    }
}
