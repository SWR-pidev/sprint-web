<?php


namespace HousingBundle\Controller;


use HousingBundle\Entity\Housing;
use HousingBundle\Form\HousingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HousingbackController extends Controller
{
    public function showAction()
    {   $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
        return $this->render('@Housing/Back/housingback.html.twig',array('housings'=>$housings));
    }

//    public function createAction(Request $request)
//    {
//        $hs=new Housing();
//        $em = $this->getDoctrine()->getManager();
//        $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
//        if($request->isMethod('POST')){
//            $hs->setName($request->get('name'));
//            $hs->setNbresidents($request->get('nbresidents'));
//            $hs->setType($request->get('type'));
//            $hs->setDescription($request->get('description'));
//            $hs->setLocation($request->get('location'));
//            $hs->setCapacity($request->get('capacity'));
//            $hs->setAddress($request->get("address"));
//            $em->persist($hs);
//            $em->flush();
//            return $this->redirectToRoute('housing_back');
//
//        }
//        return $this->render('@Housing/Back/housingbackcreation.html.twig', array('housings' =>$housings));
//
//    }

    public function createAction(Request $request)
    {
        $hs=new Housing();
        $form=$this->createForm(HousingType::class,$hs);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('housing_back');

        }
        return $this->render('@Housing/Back/housingbackcreation.html.twig',array('form'=>$form->createView()));

    }

//    public function updateAction(Request $request , $id){
//        $em = $this->getDoctrine()->getManager();
//        $hs = $em->getRepository(Housing::class)->find($id);
//        if($request->isMethod('POST')){
//            $hs->setName($request->get('name'));
//            $hs->setNbresidents($request->get('nbresidents'));
//            $hs->setType($request->get('type'));
//            $hs->setDescription($request->get('description'));
//            $hs->setLocation($request->get('location'));
//            $hs->setCapacity($request->get('capacity'));
//            $hs->setAddress($request->get("address"));
//            $em->flush();
//            return $this->redirectToRoute('housing_back');
//
//        }
//        return $this->render('@Housing/Back/housingbackupdate.html.twig', array('form'=>$form->createView()));
//    }

    public function updateAction(Request $request , $id){
        $em = $this->getDoctrine()->getManager();
        $hs = $em->getRepository(Housing::class)->find($id);
        $form=$this->createForm(HousingType::class,$hs);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){

            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('housing_back');

        }
        return $this->render('@Housing/Back/housingbackupdate.html.twig', array('form'=>$form->createView()));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $hs = $em->getRepository(Housing::class)
            ->find($id);
        $em->remove($hs);
        $em->flush();
        return $this->redirectToRoute("housing_back");
    }

}