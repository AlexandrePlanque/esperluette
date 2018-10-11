<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\QuestionCat;
use App\Entity\Question;
use App\Entity\Reponse;

class QuestionnaireFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Liste des Questions/réponses
        $listCat = ["TIERS LIEU","RESTAURANT","EPICERIE","ATELIERS","BAR","ASSOCIATION / ADHÉSION"];
        $listQuestions = [
            "Aimeriez-vous un lieu ouvert associatif à Celleneuve",
            "Qu’attendez-vous de ce lieu",
            "Connaissez-vous la petite cuisine de l’Espiralh",
            "Avez-vous déjà mangé à la petite cuisine de l’Espiralh",
            "Combien de fois par mois",
            "Pour le plat du jour, combien êtes-vous prêt à payer",
            "Est-ce que vous voudriez trouver d’autres plats ou boissons",
            "Qu’est-ce que vous voudriez trouver",
            "Aimeriez-vous que la salle s’agrandisse",
            "Aimeriez-vous qu’il y ait un espace extérieur",
            "Souhaiteriez-vous trouver à Celleneuve une épicerie approvisionnée en circuit-court",
            "A quelle fréquence avez-vous besoin de vous approvisionner",
            "Quel type de produit souhaiteriez-vous trouver",
            "Souhaiteriez-vous participer à des ateliers",
            "Si oui,lesquels",
            "Souhaiteriez-vous trouver à celleneuve un bar associatif convivial",
            "Quand aimeriez-vous que le bar soit ouvert",
            "Aimeriez-vous des soirées à thèmes",
            "Êtes-vous prêt à payer 1 € pour adhérer à l’association"
        ];

        $listReponses = [
            ["Oui","Non"],
            ["Rencontrer d’autres personnes","S’informer/apprendre","Se divertir","Manger","Boire un verre","Travailler","Se connecter à internet"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["plusieurs fois","une fois","moins"],
            ["moins de 5 euros","entre 5 et 10 euros","plus de 10 euros"],
            ["Oui","Non"],
            ["plats avec viande hallal","Plats végétarien","Plats sans gluten","Bière, vin"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["une fois par mois","une fois par semaine","plusieurs fois par semaine","occasionnellement"],
            ["Epicerie sèche","Fruits et légumes frais","Huiles","viandes et poissons","produits hallal","produits laitiers","Produits transformés","Boissons","Boissons alcoolisées","Hygiène et produits d’entretien"],
            ["Oui","Non"],
            ["Atelier cuisine","Jeux","Ateliers créatifs enfants/ados","Atelier faire soi-même (Diy)","Sortie glanage/rencontre de producteurs"],
            ["Oui","Non"],
            ["matin semaine","matin week-end","Après-midi semaine","Après-midi week-end","Soirée semaine","Soirée week-end","Dimanche midi (brunch)"],
            ["musique","lecture","ciné","débat","danse","théâtre","chanter","contes","Jeux","coiffure"],
            ["Oui","Non"]
        ];

        $assignation = [
            [0,1],[2,3,4,5,6,7,8,9],[10,11,12],[13,14],[15,16,17],[18]
        ];

        foreach($assignation as $key => $listeQuest){
            //Creation de la catégorie
            $newCat = new QuestionCat();

            $newCat->setIntitule($listCat[$key]);

            $manager->persist($newCat);

            //Assignation liste de questions + liste des réponses
            foreach($listeQuest as $key => $value){

                $newQuest = new Question();

                $newQuest->setIntitule($listQuestions[$value]);

                $manager->persist($newQuest);

                //Creation des réponses et assignation à la question

                foreach($listReponses[$value] as $reponse){

                    $newReponse = new Reponse();

                    $newReponse->setIntitule($reponse);

                    $manager->persist($newReponse);

                    $newQuest->addReponse($newReponse);

                }
                
                $manager->persist($newQuest);

                //Assignation de la question avec ses reponses à la catégorie
                $newCat->addQuestion($newQuest);

            }
            
            $manager->persist($newCat);
            
        }

        //Enregistrement de tous les objets créés
        $manager->flush();
    }
}
