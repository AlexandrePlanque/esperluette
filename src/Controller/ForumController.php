<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Repository\ForumRepository;
use App\Repository\SujetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index(ForumRepository $repo, SujetRepository $su)
    {   
        return $this->render('forum/index.html.twig', [
            'themes' =>  $repo->findAll(),
        ]);
    }
    
    /**
     * @Route("/forum/sujet/{id}", name="forum_sujet", methods="GET")
     */
    public function getSujet(Sujet $sujet, ForumRepository $repo){
        return $this->render('forum/sujet.html.twig', [
            'sujet' =>  $sujet,'themes' =>  $repo->findAll()
        ]);
    }
}
