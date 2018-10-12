<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\RoleRepository;
use App\Entity\User;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function logout(){
        return $this->redirectToRoute('home');
    }
    
    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function getInscription(RoleRepository $repo){
                return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController', "roles" => $repo->findAll()
        ]);
    }
    
    /**
     * @Route("/register", name="register", methods="POST")
     */
    public function register(Request $request, ObjectManager $em, UserPasswordEncoderInterface $encoder, RoleRepository $repo){
        
        $post = $request->request->all();
        
        var_dump($post);
        var_dump("ROLE_".strtoupper($post['type']));
        
        $user = new User();
        
        $mdpHash= $encoder->encodePassword($user, $post['password']);
        
        $user->setNom($post['nom']);
        $user->setPrenom($post['prenom']);
        $user->setMotdepasse($mdpHash);
        $user->setEmail($post['email']);
        if($post["type"] == "Celleneuvois"){   
        $user->setRole($repo->findOneBy(array("Intitule" => "ROLE_ADHERENT")));
        }else{
        $user->setRole($repo->findOneBy(array("Intitule" => "ROLE_AGRICULTEUR")));
        }
        
        $em->persist($user);
        $em->flush();
        
        $this->registerAction($user);
        
        return $this->redirectToRoute('home');
    }
    
        public function registerAction(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
        $this->container->get('session')->set('_security_main', serialize($token));

        return $this->redirectToRoute('home');

        // The user is now logged in, you can redirect or do whatever.
    }
}
