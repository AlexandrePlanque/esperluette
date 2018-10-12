<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FormResponses;
use App\Entity\QuestionCat;
use App\Entity\Question;
use App\Entity\Reponse;
use Symfony\Component\HttpFoundation\Request;


class AddResponsesController extends AbstractController
{
    /**
     * @Route("/add", name="add", methods="POST")
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        //Recuperation de la liste des reponses
        $post = $request->request->all();

        //Creation de l'objet FormResponses

        $newForm = new FormResponses();

        //Ajout des reponses
        foreach($post as $idReponse){

            $newReponse = $em->getRepository(Reponse::class)->find(intval($idReponse));

            $newForm->addReponse($newReponse);
        }
        
        //Enregistrement en BDD
        $em->persist($newForm);
        $em->flush();

        return $this->json(array("datas" => "success"), 200, array("Content-Type" => "application/json", "charset" => "utf-8"));
    }

        /**
     * @Route("/charts/get", name="count", methods="GET")
     */
    public function countReponse(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $listeDatas = [];

        //Recuperation de la liste des categories
        $listeCat = $em->getRepository(QuestionCat::class)->findAll();

        //Pour chaque categorie, récupération de la liste des questions + reponses associées, puis compte des reponses dans la table de mapping
        foreach($listeCat as $cat){
            $newCat = [];
            $newCat['nomCat'] = $cat->getIntitule();

            $newCat['listeQuestions'] = [];

            foreach($cat->getQuestion() as $question){

                $newQuestion = [];
                $newQuestion['nomQuestion'] = $question->getIntitule();
                $newQuestion['listeReponses'] = [];

                foreach($question->getReponse() as $reponse){

                    $newReponse = [];
                    $newReponse['nomReponse'] = $reponse->getIntitule();

                    $compteur = 0;

                    //Compte de reponse

                    foreach($em->getRepository(FormResponses::class)->findAll() as $form){
                        foreach($form->getReponse() as $reponseBis){
                            if($reponse == $reponseBis){
                                $compteur++;
                            }
                        }
                    }

                    $newReponse['nbSelection'] = $compteur;
                
                    //Ajout
                    array_push($newQuestion['listeReponses'],$newReponse);
                }

                array_push($newCat['listeQuestions'],$newQuestion);
            }
            array_push($listeDatas,$newCat);
        }

        // return $this->render('test/index.html.twig', [
        //     'datas' => $listeDatas
        // ]);
        //$datas = json_encode($listeDatas);

        return $this->json(array("datas" => $listeDatas), 200, array("Content-Type" => "application/json", "charset" => "utf-8"));
    }

    /**
     * @Route("/charts", name="charts")
     */
    public function showCharts(Request $request)
    {
        return $this->render('questionnaire/chart.html.twig', [
            'datas' => "toto"
        ]);
    }
}