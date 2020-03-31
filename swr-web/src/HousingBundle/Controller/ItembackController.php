<?php


namespace HousingBundle\Controller;


use HousingBundle\Entity\Housing;
use HousingBundle\Entity\Items;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ItembackController extends Controller
{
    public function showAction()
    {   $housings = $this->getDoctrine()->getRepository(   Items::class)->findAll();
        return $this->render('@Housing/Back/itemsback.html.twig',array('housings'=>$housings));
    }
    public function createAction(Request $request)
    {
        $hs=new Items();
        $em = $this->getDoctrine()->getManager();
        $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
        if($request->isMethod('POST')){
            $hs->setName($request->get('name'));
            $hs->setQuantity($request->get('quantity'));
            $hs->setStatus($request->get('status'));
            $hs->setDescription($request->get('description'));
            $intid= (int)$request->get('idh');
            $housing=  $this->getDoctrine()->getRepository(   Housing::class)->find($intid);
            $hs->setIdh($housing);

            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('items_back');

        }
        return $this->render('@Housing/Back/itemsbackcreation.html.twig', array('housings' =>$housings));

    }

    public function updateAction(Request $request , $id){
        $em = $this->getDoctrine()->getManager();
        $hs = $em->getRepository(Items::class)->find($id);
        $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
        if($request->isMethod('POST')){
            $hs->setName($request->get('name'));
            $hs->setQuantity($request->get('quantity'));
            $hs->setStatus($request->get('status'));
            $hs->setDescription($request->get('description'));
            $intid= (int)$request->get('idh');
            $housing=  $this->getDoctrine()->getRepository(   Housing::class)->find($intid);
            $hs->setIdh($housing);
            $em->flush();
            return $this->redirectToRoute('items_back');

        }
        return $this->render('@Housing/Back/itemsbackupdate.html.twig', array('item' =>$hs,'housings' =>$housings));
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