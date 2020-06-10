<?php

namespace DeliveryBundle\Controller;

use DeliveryBundle\Entity\goodss;

use DeliveryBundle\Form\goodssType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class goodsController extends Controller
{
    public function listergoodsAction(Request $request)
    {
        $goods = $this->getDoctrine()->getRepository(goodss::class)->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $goods,
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('@Delivery/Goods/listerall.html.twig', array('Goods' => $goods, 'goods' => $pagination));

    }
    public function contributeAction (Request $request) {
        $em = $this->getDoctrine()->getManager();
        $goods = new goodss();
        $form=$this->createForm(goodssType::class,$goods);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($goods);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Thank you for your donation :) !');
            return $this->redirectToRoute('Goods_lister');
        }
        return $this->render('@Delivery/Deliveryman/lister.html.twig',array('form'=>$form->createView()));
    }

}
