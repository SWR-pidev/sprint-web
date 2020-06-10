<?php

namespace DeliveryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('@Delivery/Default/index.html.twig');
    }
}