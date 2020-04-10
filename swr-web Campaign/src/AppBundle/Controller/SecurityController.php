<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('CompaignBundle:Security:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/redirect")
     */
    public function redirectAction()
    {
        $authChecker=$this->get('security.authorization_checker');
        if ($authChecker->isGranted('ROLE_ADMIN')){
        return $this->render('@Compaign/Default/Dashbord.html.twig');
        }
        elseif ($authChecker->isGranted('ROLE_USER')){

            return $this->render('@Compaign/Default/index.html.twig',array('u'=>$this->getUser()));
        }
        else
            return $this->render('@FOSUser/Security/login.html.twig');
    }


}
