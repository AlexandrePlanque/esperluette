<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Entity\Message;
use App\Repository\ForumRepository;
use App\Repository\SujetRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index(ForumRepository $repo, SujetRepository $su, MessageRepository $msgs)
    {   
        return $this->render('forum/index.html.twig', [
            'themes' =>  $repo->findAll(), 'lastmsg' => $msgs->findOneBy(array(), array("dateCreation" => "DESC"))
        ]);
    }
    
    /**
     * @Route("/forum/sujet/{id}", name="forum_sujet", methods="GET")
     */
    public function getSujet(Sujet $sujet, ForumRepository $repo, MessageRepository $msgs){
        return $this->render('forum/sujet.html.twig', [
            'sujet' =>  $sujet,'themes' =>  $repo->findAll(),'lastmsg' => $msgs->findOneBy(array(), array("dateCreation" => "DESC"))
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
    }
    
    /**
     * @Route("/forum/sujet/{id}/create", name="message_create", methods="POST")
     */
    public function createMessage(Sujet $sujet, Request $request, ObjectManager $em, ForumRepository $repo){
        $post = $request->request->all();
        
        $msg = new Message();
        $msg->setCorps($post['corps']);
        $msg->setDateCreation(new \DateTime());
        $msg->setAuteur($this->getUser());
        $msg->setSujet($sujet);
        $em->persist($msg);
        $em->flush();
        
        return $this->json(array("userN" => $this->getUser()->getNom(),"userP" => $this->getUser()->getPrenom(), "date" => $msg->getDateCreation(), "corps" => $msg->getCorps()), 200, array("Content-Type" => "application/json", "charset" => "utf-8"));
    }
}
