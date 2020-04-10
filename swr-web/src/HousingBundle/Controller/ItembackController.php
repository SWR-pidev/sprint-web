<?php


namespace HousingBundle\Controller;


use HousingBundle\Entity\Housing;
use HousingBundle\Entity\Items;
use HousingBundle\Form\ItemsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ItembackController extends Controller
{
    public function showAction(Request $request)
    {   $housings = $this->getDoctrine()->getRepository(   Items::class)->findAll();
        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator= $this->get('knp_paginator');
        $result= $paginator->paginate(
            $housings,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)

        );
        return $this->render('@Housing/Back/itemsback.html.twig',array('housings'=>$result));
    }
//    public function createAction(Request $request)
//    {
//        $hs=new Items();
//        $em = $this->getDoctrine()->getManager();
//        $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
//        if($request->isMethod('POST')){
//            $hs->setName($request->get('name'));
//            $hs->setQuantity($request->get('quantity'));
//            $hs->setStatus($request->get('status'));
//            $hs->setDescription($request->get('description'));
//            $intid= (int)$request->get('idh');
//            $housing=  $this->getDoctrine()->getRepository(   Housing::class)->find($intid);
//            $hs->setIdh($housing);
//
//            $em->persist($hs);
//            $em->flush();
//            return $this->redirectToRoute('items_back');
//
//        }
//        return $this->render('@Housing/Back/itemsbackcreation.html.twig', array('housings' =>$housings));
//
//    }
    public function createAction(Request $request)
    {
        $hs=new Items();
        $form=$this->createForm(ItemsType::class,$hs);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('items_back');

        }
        return $this->render('@Housing/Back/itemsbackcreation.html.twig', array('form'=>$form->createView()));

    }

//    public function updateAction(Request $request , $id){
//        $em = $this->getDoctrine()->getManager();
//        $hs = $em->getRepository(Items::class)->find($id);
//        $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
//        if($request->isMethod('POST')){
//            $hs->setName($request->get('name'));
//            $hs->setQuantity($request->get('quantity'));
//            $hs->setStatus($request->get('status'));
//            $hs->setDescription($request->get('description'));
//            $intid= (int)$request->get('idh');
//            $housing=  $this->getDoctrine()->getRepository(   Housing::class)->find($intid);
//            $hs->setIdh($housing);
//            $em->flush();
//            return $this->redirectToRoute('items_back');
//
//        }
//        return $this->render('@Housing/Back/itemsbackupdate.html.twig', array('item' =>$hs,'housings' =>$housings));
//    }
    public function updateAction(Request $request , $id){
        $em = $this->getDoctrine()->getManager();
        $hs = $em->getRepository(Items::class)->find($id);
        $form=$this->createForm(ItemsType::class,$hs);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){

            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('items_back');

        }
        return $this->render('@Housing/Back/itemsbackupdate.html.twig', array('form'=>$form->createView()));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $hs = $em->getRepository(Items::class)
            ->find($id);
        $em->remove($hs);
        $em->flush();
        return $this->redirectToRoute("items_back");
    }

}