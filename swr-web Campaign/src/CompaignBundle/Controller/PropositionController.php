<?php

namespace CompaignBundle\Controller;

use CompaignBundle\Entity\Compaign;
use CompaignBundle\Entity\Sugg;
use CompaignBundle\Repository\CompaignRepository;
use CompaignBundle\Entity\Donation;
use CompaignBundle\Form\CompaignType;
use CompaignBundle\Form\PropositionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
class PropositionController extends Controller
{





    public function DisplayPropAction()
    {

        $evt = $this->getDoctrine()->getRepository(Sugg::class)->findAll();
        $name = $this->getDoctrine()->getRepository(Compaign::class)->findAll();
        $repository=$this->getDoctrine()->getManager()->getRepository(Compaign::class);
      $names=$repository->CmpProp();
      foreach ($evt as $s){ $s->setName($repository->GetNameById($s->getIdCmp()));}
        $vt= new Sugg();
        $fom = $this->createForm(PropositionType::class, $vt);
        $d="";
        return $this->render('@Compaign/Back/PropositionSpace.html.twig', array('cm'=>$evt,'n' =>$name,'f' => $fom->createView(),'id'=>$d,'prop'=>$vt));

    }

    public function deletePropAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evt = $this->getDoctrine()->getRepository(Sugg::class)->find($id);
        $em->remove($evt);
        $em->flush();
        $d="";
        return $this->redirectToRoute("prop_space",array('id'=>$d));
    }


    public function addPropAction(Request $request)
    {
        $evt = new Sugg();
        $d="";
        $form = $this->createForm(PropositionType::class, $evt);
        $repository=$this->getDoctrine()->getManager()->getRepository(Compaign::class);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $y=$request->request->get('sel');
            $id = $repository->GetDbName($y);
            $em = $this->getDoctrine()->getManager();
            $evt->setIdCmp($id);
            $em->persist($evt);
            $em->flush();
            return $this->redirectToRoute('prop_space',array('id'=>$d));
        }
        return $this->render('@Compaign/Back/PropositionSpace.html.twig', array('f' => $form->createView(),'id'=>$d));
    }

    public function updatePropAction(Request $request, $id)
    {
        $evst = $this->getDoctrine()->getRepository(Sugg::class)->findAll();
        $name = $this->getDoctrine()->getRepository(Compaign::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        $evt = $em->getRepository(Sugg::class)->find($id);
        $form = $this->createForm(PropositionType::class, $evt);
        $repository=$this->getDoctrine()->getManager()->getRepository(Compaign::class);
        $form = $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $y=$request->request->get('sel');
            $id = $repository->GetDbName($y);
            $evt->setIdCmp($id[0]);
            $evt->setDetail($request->request->get('desc'));
            $em->flush();
            return $this->redirectToRoute('prop_space',array('id'=>$id));
        }
        return $this->render('@Compaign/Back/PropositionSpace.html.twig', array('cm'=>$evst,'n' =>$name,'f' => $form->createView(),'id'=>$id,'prop'=> $evt));
    }

}




