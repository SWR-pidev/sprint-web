<?php

namespace DeliveryBundle\Controller;


use DeliveryBundle\Entity\Delivery;
use DeliveryBundle\Form\DeliverymanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DeliveryBundle\Entity\Deliveryman;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class DeliverymanController extends Controller
{

    public function AddDeliverymanAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Deliveryman = new Deliveryman();
        $form=$this->createForm(DeliverymanType::class,$Deliveryman);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){

            $em->persist($Deliveryman);
            $em->flush();
            $this-> get('session')->getFlashBag()->add('notice', 'A new deliveryman was added !');
            return $this->redirectToRoute('Deliveryman_list');
        }
        return $this->render('@Delivery/Deliveryman/ajoutman.html.twig',array('form'=>$form->createView()));

    }
    /**
     * @Route("/liste", name="listestage")
     */
    public function listmanAction(Request $request)
    { $Deliveryman= $this->getDoctrine() ->getRepository( Deliveryman::class)->findAll();

        $paginator = $this ->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Deliveryman,
            $request->query->getInt('page', 1), /*page number*/
            10 );


        return $this->render('@Delivery/Default/listman.html.twig',array(
         'Deliveryman'=>$pagination,

        ));

    }


    public function deletemanAction($iddman){


        $em = $this->getDoctrine()->getManager();

        $repository=$this->getDoctrine()->getManager()->getRepository(Deliveryman::class);

        $list = $repository->deliverymanindelivery($iddman);

        if (empty($list)){
            $Deliveryman = $em->find('DeliveryBundle:Deliveryman', $iddman);

            $em->remove($Deliveryman);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','The delivery man was successfully deleted !');
            return $this->redirectToRoute('Deliveryman_list');
        }


        $this->get('session')->getFlashBag()->add('warning','This delivery man cannot be deleted because he/she is assigned to a delivery ! ');
        return $this->redirectToRoute('Deliveryman_list');

    }

    public function updatemanAction(Request $request , $iddman){
        $em = $this->getDoctrine()->getManager();
        $Deliveryman = $em->getRepository(Deliveryman::class)->find($iddman);
        $form=$this->createForm(DeliverymanType::class,$Deliveryman);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){

            $em->persist($Deliveryman);
            $em->flush();
            $this-> get('session')->getFlashBag()->add('notice', 'The deliveryman was successfully updated !');
            return $this->redirectToRoute('Deliveryman_list');

        }
        return $this->render('@Delivery/Deliveryman/updateman.html.twig', array('form'=>$form->createView()));
    }

    public function statssmenAction (Request $request) {
        $Deliveryman= $this->getDoctrine() ->getRepository( Deliveryman::class)->findAll();
        $nbredeliveryman = 0;
        foreach ($Deliveryman as $j){
            $nbredeliveryman = $nbredeliveryman + 1;
        }
        $repository = $this->getDoctrine()->getManager()->getRepository(Deliveryman::class);
        $bestdman = $repository->onfire();
        return $this->render('@Delivery/Default/statisticsman.html.twig',array(
            'nbretotaldeliveryman'=>$nbredeliveryman,
            'bestdman'=>$bestdman,
        ));

    }
    public function charttodelmenAction()
    {
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Deliveryman', 'Delivery'],
                ['Poppy',     4],
                ['Felix',      3],
                ['Henry',  3],
                ['Daniella', 2],
                ['Cathy',    1]
            ]
        );
        $pieChart->getOptions()->setTitle('Deliveries per Deliveryman');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $pieChart->getOptions()->setIs3D(true);

        return $this->render('@Delivery/Default/chartmen.html.twig', array('piechart' => $pieChart));
    }
}
