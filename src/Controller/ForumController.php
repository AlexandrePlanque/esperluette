<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Entity\Message;
use App\Repository\ForumRepository;
use App\Repository\SujetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

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
    
    /**
     * @Route("/forum/sujet/create", name="sujet_create", methods="POST")
     */
    public function createSujet(Request $request, ObjectManager $em, ForumRepository $repo){
        $post = $request->request->all();
        
        
        $sujet = new Sujet();
        $sujet->setIntitule($post['intitule']);
        $sujet->setAuteur($this->getUser());
        $sujet->setForum($repo->findOneBy(array("theme" => $post['forum'])));
        $sujet->setDateCreation(new \DateTime());
        $sujet->setDescription(substr($post['corps'], 20, strlen($post['corps'])));
        $em->persist($sujet);
        $em->flush();
        
        $msg = new Message();
        $msg->setCorps($post['intitule']);
        $msg->setDateCreation($sujet->getDateCreation());
        $msg->setAuteur($this->getUser());
        $msg->setSujet($sujet);
        $em->persist($msg);
        $em->flush();
        
        return $this->json(array("reponse" => $sujet->getForum()->getTheme()), 200, array("Content-Type" => "application/json", "charset" => "utf-8"));
//        return $this->render('forum/sujet.html.twig', [
//            'sujet' =>  $sujet,'themes' =>  $repo->findAll()
//        ]);
    }
}
