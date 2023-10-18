<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route("/author/{name}", name:"show_author")]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'n' => $name,
        ]);
    }

    #[Route("/authors", name:"list_authors")]
    public function list(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );

        $totalBooks = 0;

        foreach ($authors as $author) {
            $totalBooks += $author['nb_books'];
        }
    
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'totalBooks' => $totalBooks,
        ]);

    }

    #[Route("/details/{id}", name:"d")]
    public function details($id) {
        return new Response('authors'.$id);
    }

    #[Route('/detailsAuthor/{id}', name: 'details_author')]
    public function auhtorDetails($id): Response
    {
        $authors=array(array('id'=>1,'picture' =>'images/Victor-Hugo.jpg','username'=>'Victor Hugo','email'=>'victor.hugo@gmail.com','nb_books'=>100),
            array ('id' => 2,'picture' =>'images/william-shakespeare.jpg', 'username' =>'William Shakespeare','email' => 'william.shakespeare@gmail.com','nb_books'=>200),
         array('id'=> 3,'picture' => 'images/Taha_Hussein.jpg', 'username' =>'Taha Hussein' ,'email'=> 'taha.hussein@gmail.com','nb_books' => 300),
        );
        return $this->render('author/showAuthor.html.twig', [
            'controller_name' => 'AuthorController','id' => $id , 'tabAuthors'=>$authors
        ]);
    }
    


}