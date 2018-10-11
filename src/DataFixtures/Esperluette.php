<?php

namespace App\DataFixtures;

use App\Entity\Forum;
use App\Entity\Sujet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Esperluette extends Fixture
{
    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        forum($manager);

//        $manager->flush();
    }
    
    public function forum($em){
        $fo = new Forum();
        $fo->setNom("General");
        $em->persist($fo);
        $em->flush($fo);
        
        $fof = new Forum();
        $fof->setNom("Bar");
        $em->persist($fof);
        $em->flush($fof);
        
        $fofo = new Forum();
        $fofo->setNom("Epicerie");
        $em->persist($fofo);
        $em->flush($fofo);
        
        $f = new Forum();
        $f->setNom("Restaurant");
        $em->persist($f);
        $em->flush($f);
    }
    
    public function sujet($em){
        for($i = 0; $i<10;$i++){
            $sujet = new Sujet();
        }
    }
}
