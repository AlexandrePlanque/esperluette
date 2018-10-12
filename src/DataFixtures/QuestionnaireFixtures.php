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
        $listCat = ["RESTAURANT","EPICERIE","ATELIERS","CAFÉ","MUTUALISATION","ASSOCIATION / ADHÉSION"];
        $listQuestions = [
            "Connaissez-vous la petite cuisine de l’Espiralh",
            "Avez-vous déjà mangé à la petite cuisine de l’Espiralh",
            "Si oui, combien de fois par mois",
            "Aimeriez-vous que la salle s’agrandisse",
            "Dans un resto associatif à prix libre,pour le plat du jour, combien êtes-vous prêt à payer",
            "Qu’est-ce que vous voudriez trouver",
            "Aimeriez-vous qu’il y ait un espace extérieur",
            "Avez vous des difficultés à trouver les produits alimentaires dont vous avez besoin à Celleneuve",
            "Pour quelles raisons",
            "Souhaiteriez-vous trouver à Celleneuve une épicerie approvisionnée en circuit-court",
            "Fréquentez vous déjà une épicerie solidaire ou avez-vous recours à l’aide alimentaire",
            "Souhaiteriez-vous trouver à Celleneuve une épicerie approvisionnée en circuit-court",
            "A quelle fréquence avez-vous besoin de vous approvisionner",
            "Quel type de produit souhaiteriez-vous trouver",
            "Souhaiteriez-vous participer à des ateliers, des temps conviviaux",
            "Si oui,lesquels",
            "Souhaiteriez-vous trouver à Celleneuve un café associatif convivial",
            "Quand aimeriez-vous que le café soit ouvert",
            "Aimeriez-vous des soirées à thèmes",
            "Par rapport à vos activités professionnelles ou bénévoles à Celleneuve, pouvez-vous ponctuellement avoir besoin",
            "Êtes-vous prêt à payer 1 € pour adhérer à l’association",
            "Etes-vous prêt à vous investir bénévolement pour le fonctionnement de l ‘association",
            "Si oui pour quelles activités",
            "Quels savoirs-faire pourriez-vous mettre à contribution",
        ];

        $listReponses = [
            ["Oui","Non"],
            ["Oui","Non"],
            ["plusieurs fois","une fois","moins"],
            ["Oui","Non"],
            ["moins de 5 euros","entre 5 et 10 euros","plus de 10 euros"],
            ["Cuisine du monde","Cuisine traditionnelle","plats avec viande hallal","Plats végétarien","Plats sans gluten","Bière, vin"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["Financières","Offre disponible"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["une fois par mois","une fois par semaine","plusieurs fois par semaine","occasionnellement"],
            ["Epicerie sèche","Fruits et légumes frais","Huiles","viandes et poissons","produits hallal","produits laitiers","Produits transformés","Boissons","Boissons alcoolisées","Hygiène et produits d’entretien"],
            ["Oui","Non"],
            ["Cuisine","Repas","Jeux","Ateliers créatifs enfants/ados","Atelier faire soi-même (Diy)","Sortie glanage/rencontre de producteurs","Cueillette de plantes sauvages"],
            ["Oui","Non"],
            ["matin semaine","matin week-end","Après-midi semaine","Après-midi week-end","Soirée semaine","Soirée week-end","Dimanche midi (brunch)"],
            ["musique","lecture","ciné","débat","danse","théâtre","chanter","contes","Jeux","coiffure"],
            ["d’une cuisine professionnelle","d’une salle de réunion","d’un bureau","d’une salle d’activités"],
            ["Oui","Non"],
            ["Oui","Non"],
            ["resto","café","épicerie","proposition d’ateliers ou sorties"],
            ["cuisine","bricolage","talents artistiques","gestion","comptabilité","maintenance","animation","transport","service resto ou bar","autres"]
        ];

        $assignation = [
            [0,1,2,3,4,5,6],[7,8,9,10,11,12,13],[14,15],[16,17,18],[19],[20,21,22,23]
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
