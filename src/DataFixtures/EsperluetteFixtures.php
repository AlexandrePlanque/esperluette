<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Forum;
use App\Entity\Sujet;
use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EsperluetteFixtures extends Fixture
{
    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {

//        $this->generateRole($manager);
//        $this->user($manager);
//        $this->forum($manager);
//        $this->sujet($manager);
        $this->message($manager);

//        $manager->flush();
    }
    
    public function generateRole($em){
        $r = new Role();
        $r->setIntitule('ROLE_ADMIN');
        $em->persist($r);
        
        $ro = new Role();
        $ro->setIntitule('ROLE_ADHERENT');
        $em->persist($ro);
        
        $ros = new Role();
        $ros->setIntitule('ROLE_AGRICULTEUR');
        $em->persist($ros);
        
        $rol = new Role();
        $rol->setIntitule('ROLE_PARTENAIRE');
        $em->persist($rol);
        
        $em->flush();        
    }
    
    public function user($em){
        $a = new User();
        $a->setNom('Cantinelli');
        $a->setPrenom('Thomas');
        $a->setEmail('tcantinelli@gmail.com');
        $a->setMotdepasse($this->encoder->encodePassword($a, 'motdepasse'));
        $a->setRole($em->find(Role::class, 1));
        
        $em->persist($a);
        
        $em->flush();
    }
    
    public function forum($em){
        $fo = new Forum();
        $fo->setTheme("General");
        $em->persist($fo);
        $em->flush($fo);
        
        $fof = new Forum();
        $fof->setTheme("Bar");
        $em->persist($fof);
        $em->flush($fof);
        
        $fofo = new Forum();
        $fofo->setTheme("Epicerie");
        $em->persist($fofo);
        $em->flush($fofo);
        
        $f = new Forum();
        $f->setTheme("Restaurant");
        $em->persist($f);
        $em->flush($f);
    }
    
    public function sujet($em){
        for($i = 0; $i<10;$i++){
            $sujet = new Sujet();
            $sujet->setIntitule('Intitule'.$i);
            $sujet->setAuteur($em->find(User::class, 1));
            $sujet->setDateCreation(new \DateTime());
            $sujet->setForum($em->find(Forum::class, random_int(1, 4)));
            $sujet->setDescription($i.'Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor');
            $em->persist($sujet);
        }
        $em->flush();
    }
    
    public function message($em){
        
        for($i = 0; $i < 100;$i++){
            $msg = new Message();
            $msg->setCorps('Lorem ipsum dolor blabla lorem ipsum dolor blabla lorem ipsum dolor blabla lorem ipsum dolor blabla lorem ipsum dolor blabla lorem ipsum dolor blabla lorem ipsum dolor blabla');
            $msg->setDateCreation(new \DateTime());
            $msg->setAuteur($em->find(User::class, 1));
            $msg->setSujet($em->find(Sujet::class, random_int(1,10)));
            $em->persist($msg);
        }
        $em->flush();
        
    }
}
