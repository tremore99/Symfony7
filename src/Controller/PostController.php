<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\String\Slugger\SluggerInterface;

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

    public function createPost(Request $request, SluggerInterface $slugger): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        $post = new Post();
        $form = $this->createForm(PostForm::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());

            $imageFile = $form->get('image')->getData();

            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

            try {
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash('message', 'Couldnt save the post');
                return $this->redirectToRoute('list-post');
            }

            $post->setImage($newFilename);

            $this->emi->persist($post);
            $this->emi->flush();

            $this->addFlash('message', 'Inserted successfully!');
            return $this->redirectToRoute('list-post');
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
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        if ($post->getUser() !== $this->getUser()) {
            throw new AccessDeniedException("You can't go here.");
        }

        $form = $this->createForm(PostForm::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->emi->persist($post);
            $this->emi->flush();

            $this->addFlash('message', 'Edited successfully!');
            return $this->redirectToRoute('list-post');
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
