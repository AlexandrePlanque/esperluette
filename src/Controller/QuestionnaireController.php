<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\QuestionCat;

class QuestionnaireController extends AbstractController
{
    /**
     * @Route("/questionnaire", name="questionnaire")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();

        $listeCat = $em->getRepository(QuestionCat::class)->findAll();

        return $this->render('questionnaire/index.html.twig', [
            'listeCat' => $listeCat
        ]);
    }
}
