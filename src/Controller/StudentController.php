<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/fetch', name: 'fetch')]
    public function fetch(StudentRepository $repo):Response
    {
        $result=$repo->findAll();
        return $this->render('student/test.html.twig', [
            'students' =>$result,
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(ManagerRegistry $mr , ClassroomRepository $repo):Response
    {
        $s=new Student();
        $c=$repo->find(1);
        $s->setName('test');
        $s->setEmail('efsf@gmail.com');
        $s->setAge('28');
        $s->setClassroom($c);
        $em=$mr->getManager();
        $em->persist($s); //tinformih eli aandi donnée $s jeya jdida
        $em->flush(); //envoyer tttaamelo exicution
        return $this->redirectToRoute('fetch');

    }

    #[Route('/addF', name: 'addF' ,methods:['GET','POST'])]
    public function addF(EntityManagerInterface $em , Request $req):Response
    {
        $s=new Student(); // 1 - lazm tasnaa3 instance
        $form=$this->createForm(StudentType::class,$s); //creation de form
        $form->handleRequest($req); //recuperation de donnes li ktbthmm
        if($form->isSubmitted())
        {
        $em->persist($s); //thadher el $s
        $em->flush();

         //envoyer tttaamelo exicution
        return $this->redirectToRoute('fetch');
        }
        $formView=$form->createView();

        return $this->render('student/add.html.twig',[
        'f'=>$formView
        ]);

    }

    #[Route('/update/{id}', name: 'update' ,methods:['GET','POST'])]
    public function updatee(EntityManagerInterface $em ,ManagerRegistry $doctrine,$id,Request $req,StudentRepository $repo):Response
    {
        $c=$repo->find($id);
        $form=$this->createForm(StudentType::class,$c); //creation de form
        $form->handleRequest($req); //recuperation de donnes li ktbthmm
        if($form->isSubmitted())
        {
        $em=$doctrine->getManager();
        $em->flush();

         //envoyer tttaamelo exicution
        return $this->redirectToRoute('fetch');
        }
        $formView=$form->createView(); 

        return $this->render('student/add.html.twig',[
        'f'=>$formView
        ]);

    }

    #[Route('/remouve/{id}', name: 'remove')]
    public function delete(StudentRepository $repo , $id ,ManagerRegistry $mr ):Response
    {
       $student= $repo->find($id);
       $em= $mr -> getManager();
       $em ->remove($student);
       $em->flush(); //envoyer tttaamelo exicution
       return new Response('removed');
    }


}
