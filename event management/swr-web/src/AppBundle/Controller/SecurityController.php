<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
class SecurityController extends Controller
{


    /**
     * @Route("/redirect")
     */
    public function redirectAction()
    {
         $user=$this->getUser();
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->render('@Event/Default/Dashboard.html.twig');
        } else if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            return $this->render('@Event/Default/index.html.twig',array('u'=>$user));
        } else{
            return $this->render('@FOSUser/Security/login.html.twig');
        }

    }

}
