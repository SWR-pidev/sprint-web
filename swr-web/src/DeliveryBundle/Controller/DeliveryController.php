<?php

namespace DeliveryBundle\Controller;


use DeliveryBundle\Form\DeliveryType;
use DeliveryBundle\Repository\DeliveryRepository;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DeliveryBundle\Entity\Delivery;
use Symfony\Component\HttpFoundation\Request;
//use Mgilet\NotificationBundle\Manager\NotificationManager;
//use Mgilet\NotificationBundle\NotifiableInterface;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;

class DeliveryController extends Controller
{
    /**
     * @throws OptimisticLockException
     * @var NotificationManager
     * @Method("POST")
     */
    private $manager;

    public function rechercheerAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $motcle = $request->get('motcle');

        $repository = $em->getRepository('DeliveryBundle:Delivery');
        $query = $repository->createQueryBuilder('d')
            ->where('d.item like :item')
            ->setParameter('item', '%' . $motcle . '%')
            ->orderBy('d.item', 'ASC')
            ->getQuery();

        $listDelivery = $query->getResult();
        if (empty($listDelivery)){
            return $this->render('@Delivery/Default/emptyerror.html.twig');
        }
        if(isset($listDelivery)){
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $listDelivery,
                $request->query->getInt('page', 1), /*page number*/
                15 /*limit per page*/
            );

            return $this->render('@Delivery/Default/list.html.twig', array(
                'Delivery' => $pagination,

            ));
        }


    }

    public function AddDeliveryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Delivery = new Delivery();
        $form = $this->createForm(DeliveryType::class, $Delivery);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em->persist($Delivery);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'The delivery was assigned to the delivery man !');
            return $this->redirectToRoute('Delivery_list');
        }
        return $this->render('@Delivery/Delivery/ajout.html.twig', array('form' => $form->createView()));

    }


    public function listeAction(Request $request)
    {
        $Delivery = $this->getDoctrine()->getRepository(Delivery::class)->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Delivery,
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('@Delivery/Default/list.html.twig', array(
            'Delivery' => $pagination,

        ));

    }


    public function deleteAction($IdDe)
    {

        $em = $this->getDoctrine()->getManager();
        $Delivery = $em->getRepository(Delivery::class)->find($IdDe);
        $em->remove($Delivery);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', 'The delivery was successfully deleted !');
        return $this->redirectToRoute("Delivery_list");
    }


    public function updateAction(Request $request, $IdDe)
    {
        $em = $this->getDoctrine()->getManager();
        $Delivery = $em->getRepository(Delivery::class)->find($IdDe);
        $form = $this->createForm(DeliveryType::class, $Delivery);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            $em->persist($Delivery);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'The delivery was successfully updated !');

            return $this->redirectToRoute('Delivery_list');

        }
        return $this->render('@Delivery/Delivery/update.html.twig', array('form' => $form->createView()));
    }

    public function sendNotification(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');

        $manager->addNotification(array($this->getUser()), $notif, true);

        return $this->redirectToRoute('Delivery_list');
    }

    public function statssAction(Request $request)
    {
        $Delivery = $this->getDoctrine()->getRepository(Delivery::class)->findAll();


        $nbredelivery = 0;
        foreach ($Delivery as $i) {
            $nbredelivery = $nbredelivery + 1;
        }
        $repository = $this->getDoctrine()->getManager()->getRepository(Delivery::class);
        $finddeliveryselonitem = $repository->nbrdeliveryitem();
        $added = $repository->addressonfire();


        return $this->render('@Delivery/Default/statistics.html.twig', array(
            'nbretotaldelivery' => $nbredelivery,
            'finddeliveryselonitem' => $finddeliveryselonitem,
            'added' => $added,

        ));
    }

    public function charttodelAction()
    {
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Sfax', 5],
                ['Kairouan', 4],
                ['Tozeur', 4],
                ['Jendouba', 3],
                ['Bizerte', 3]
            ]
        );
        $pieChart->getOptions()->setTitle('Deliveries per region');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $pieChart->getOptions()->setIs3D(true);

        return $this->render('@Delivery/Default/chart.html.twig', array('piechart' => $pieChart ));
    }
}