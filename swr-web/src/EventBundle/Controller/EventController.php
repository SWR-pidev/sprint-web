<?php

namespace EventBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use EventBundle\Entity\Event;
use EventBundle\Entity\Gallery;
use EventBundle\Entity\Participation;
use EventBundle\Entity\Sponsorship;
use EventBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EventBundle\Form\EventType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class EventController extends Controller
{
    public function indexAction()
    {
        //return $this->render('@club/Default/Dashboard.html.twig');
        return new Response( "Bonjour");
    }
    public function DisplayAction(Request $request)
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->BackAllEvent();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
       $result= $paginator->paginate(
            $evt,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@Event/Back/EventSpace.html.twig',array('evt'=>$result));

    }
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evt = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $em->remove($evt);
        $em->flush();
        return $this->redirectToRoute("event_space");
    }

    public function createAction(Request $request)
    {
        $evt = new Event();
        $form = $this->createForm(EventType::class, $evt);
        $form = $form->handleRequest($request);
        $im=$request->files->get('url');

        if ($form->isSubmitted() and $form->isValid() and $im!=null) {
            $em = $this->getDoctrine()->getManager();
            try {
                $evt->setDateEvt(new \DateTime($request->request->get('date')));
            } catch (\Exception $e) {
            }

            /**
             * @var UploadedFile $file
             */
            $evt->setUrlEvt($im);
            $file=$evt->getUrlEvt();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$filename
            );
            $evt->setUrlEvt($filename);

            $em->persist($evt);
            $em->flush();
            return $this->redirectToRoute('event_space');
        }
        return $this->render('@Event/Back/AddEvent.html.twig', array('f'=>$form->createView()));
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $evt=$em->getRepository(Event::class)->find($id);

        $form = $this->createForm(EventType::class, $evt);
        $form = $form->handleRequest($request);
        $im=$request->files->get('url');

        if ($form->isSubmitted() and $form->isValid() and $im!=null )
        {
            try {
                $evt->setDateEvt(new \DateTime($request->request->get('date')));
            } catch (\Exception $e) {
            }
            /**
             * @var UploadedFile $file
             */
            $evt->setUrlEvt($im);
            $file=$evt->getUrlEvt();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$filename
            );
            $evt->setUrlEvt($filename);
            $em->flush();
            return $this->redirectToRoute('event_space');
        }
        return $this->render('@Event/Back/UpdateEvent.html.twig', array('f'=>$form->createView(),'evt'=>$evt));
    }


    public function DisplayGAction()
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->PastEvent();
        $g=new Gallery();
        $id="";
        return $this->render('@Event/Back/GallerySpace.html.twig',array('evt'=>$evt,'img'=>$g,'id'=>$id));

    }
    public function createGAction(Request $request)
    {
        $gal = new Gallery();



        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $im=$request->files->get('url');
            $gal->setImg($im);
            $id=($request->request->get('idEvt'));
            $evt=$em->getRepository(Event::class)->find($id);
            $gal->setIdEvtg($evt);
            $name=$evt->getNameEvt();
            /**
             * @var UploadedFile $file
             */
            $gal->setImg($im);
            $file=$gal->getImg();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('gallery_directory'),$filename
            );
            $gal->setImg($filename);
            $em->persist($gal);
            $em->flush();
            return $this->redirectToRoute('img_display',array('id'=>$id,'name'=>$name));
        }
        return $this->render('@Event/Back/GallerySpace.html.twig');
    }

    public function DisplayImgAction($id)
    {
        $repositoryy=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repositoryy->PastEvent();
        $repository=$this->getDoctrine()->getManager()->getRepository(Gallery::class);
        $g = $repository->GetImg($id);
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository(Event::class)->find($id);
        $name=$event->getNameEvt();
        return $this->render('@Event/Back/GallerySpace.html.twig',array('img'=>$g,'evt'=>$evt,'id'=>$id,'name'=>$name));

    }
    public function deleteImgAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evt = $this->getDoctrine()->getRepository(Gallery::class)->find($id);
        $idE=$evt->getIdEvtg()->getIdEvt();
        $em->remove($evt);
        $em->flush();
        return $this->redirectToRoute("img_display",array('id'=>$idE));
    }
    public function updateImgAction(Request $request, $id)
    {
        $repositoryy=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repositoryy->PastEvent();
        $repository=$this->getDoctrine()->getManager()->getRepository(Gallery::class);
        $em = $this->getDoctrine()->getManager();
        $gal=$em->getRepository(Gallery::class)->find($id);
        $idE=$gal->getIdEvtg()->getIdEvt();
        $g = $repository->GetImg($idE);
        if ($request->isMethod('POST')) {

            $im=$request->files->get('urlU');
            /**
             * @var UploadedFile $file
             */
            $gal->setImg($im);
            $file=$gal->getImg();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('gallery_directory'),$filename
            );
            $gal->setImg($filename);
            $em->flush();
            return $this->redirectToRoute('img_display',array('id'=>$idE));
        }
        return $this->render('@Event/Back/GallerySpace.html.twig', array('img'=>$g,'evt'=>$evt,'id'=>$idE));
    }

    public function DisplayFrontAllAction()
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->FrontAllEventP();
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        return $this->render('@Event/Front/AllEventP.html.twig',array('evt'=>$evt,'u'=>$user));

    }
    public function DisplaySinglePAction($id)
    {
        $alreadyis="";
        $em=$this->getDoctrine()->getManager();
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);

        $evt=$em->getRepository(Event::class)->find($id);
        $evt->setLogo($repository->GetSponsorLogo($id));
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $repository=$this->getDoctrine()->getManager()->getRepository(Participation::class);
        $check = $repository->CheckParticipationEvent($user->getId(),$id);
        $repository->IncNbViewsEvent($id);
        if($check==null)
        {
            $alreadyis=0;
        }
        else{$alreadyis=1;}
        return $this->render('@Event/Front/EventSingleP.html.twig',array('evt'=>$evt,'u'=>$user,'alreadyis'=>$alreadyis));

    }

    public function DeleteParticipationAction($id)
    {
        $evt=$this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idU=$user->getId();

                $em = $this->getDoctrine()->getManager();
                $repository=$this->getDoctrine()->getManager()->getRepository(Participation::class);
                $par = $repository->DeleteParticipationEvent($idU,$id);
                $em->remove($par);
                $em->flush();
                $alreadyis=0;
            $repositoryy=$this->getDoctrine()->getManager()->getRepository(Event::class);
            $repositoryy->DecNbParticipationEvent($id);

               return $this->redirectToRoute('event_singleP',array('id'=>$id,'evt'=>$evt,'u'=>$user,'alreadyis'=>$alreadyis));

        }
    }

        public function AddParticipationAction($id)
    {
        $evt=$this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $alreadyis=0;
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idU=$user->getId();
            $repository=$this->getDoctrine()->getManager()->getRepository(Participation::class);
            $check = $repository->CheckParticipationEvent($idU,$id);
            if($check == NULL){

                $em = $this->getDoctrine()->getManager();
                $par =new Participation();
                $par->setIdEvt($id);
                $par->setIdUser($idU);
                $par->setDateParticipation(new \DateTime());
                $em->persist($par);
                $em->flush();

                  $repositoryy=$this->getDoctrine()->getManager()->getRepository(Event::class);
                  $repositoryy->IncNbParticipationEvent($id);

                $alreadyis=1;
                return $this->redirectToRoute('event_singleP',array('id'=>$id,'evt'=>$evt,'u'=>$user,'alreadyis'=>$alreadyis));
            }
            else{

                $alreadyis=1;
                return $this->redirectToRoute('event_singleP',array('id'=>$id,'evt'=>$evt,'u'=>$user,'alreadyis'=>$alreadyis));
            }
        }
    }
        public function DisplayFrontAllSAction()
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->FrontAllEventS();

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        return $this->render('@Event/Front/AllEventS.html.twig',array('evt'=>$evt,'u'=>$user));

    }

    public function DisplayFrontAllGAction()
    {

        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->FrontAllEventG();
        $repositoryy=$this->getDoctrine()->getManager()->getRepository(Gallery::class);
        foreach ($evt as $e)
        {$e->setImages($repositoryy->GetImages($e->getIdEvt()));}

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        return $this->render('@Event/Front/AllEventG.html.twig',array('evt'=>$evt,'u'=>$user));

    }

    public function PrintPdfAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $evt=$em->getRepository(Event::class)->find($id);
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt->setLogo($repository->GetSponsorLogo($id));

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }

        $snappy=$this->get('knp_snappy.pdf');
        $filename="EventInvitation";
        $html=$this->renderView('@Event/Front/PrintPdf.html.twig',array('evt'=>$evt,'u'=>$user));

        return new Response(
            $snappy->getOutputFromHtml($html),200,array(
                'Content-Type'=>'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"')
        );
    }

    public function DisplaySingleSAction($id)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $alreadyis="";
        $em=$this->getDoctrine()->getManager();
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);

        $evt=$em->getRepository(Event::class)->find($id);
        $budget=$evt->getBudgetEvt();
        $nbs=$evt->getNbsponsorEvt();
        if($nbs==0)
        {$evt->setStillneededEvt($budget);}

        $still=$evt->getStillneededEvt();
        if($still==0){ $repository->updateStateEvent($id);
            return $this->redirectToRoute('All_EventS',array('evt'=>$evt,'u'=>$user));
        }

        $evt=$em->getRepository(Event::class)->find($id);



        $repository->IncNbViewsEvent($id);

        return $this->render('@Event/Front/EventSingleS.html.twig',array('evt'=>$evt,'u'=>$user,'alreadyis'=>$alreadyis));

    }


    public function AddSponsorAction(Request $request,$id)
    {
        $evt = $this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);
        $still=$evt->getStillneededEvt();
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $alreadyis = 0;
        $logo=$request->files->get('url');
        $amount=$request->request->get('amount');
        if ($request->isMethod('POST') and $still>=$amount) {

            $repositoryy = $this->getDoctrine()->getManager()->getRepository(Event::class);
            $dif=$still-$amount;

            $repositoryy->updateStillEvent($id,$dif);

                $idU = $user->getId();
                $repository = $this->getDoctrine()->getManager()->getRepository(Sponsorship::class);
                $check = $repository->CheckSponsorEvent($idU, $id);
                if ($check == NULL) {

                    $em = $this->getDoctrine()->getManager();
                    $par = new Sponsorship();
                    $par->setIdEvt($id);
                    $par->setIdSponsor($idU);
                    /**
                     * @var UploadedFile $file
                     */
                    $par->setLogo($logo);
                    $file=$par->getLogo();
                    $filename= md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('image_directory'),$filename
                    );
                    $par->setLogo($filename);
                    $par->setGivenSponsor($amount);
                    $par->setDateSponsor(new \DateTime());
                    $em->persist($par);
                    $em->flush();


                    $repositoryy->IncNbSponsorEvent($id);

                    $alreadyis = 1;
                    return $this->redirectToRoute('event_singleS', array('id' => $id, 'evt' => $evt, 'u' => $user,'alreadyis'=>$alreadyis));
                }
                else{

                    $repository = $this->getDoctrine()->getManager()->getRepository(Sponsorship::class);
                    $filename= md5(uniqid()).'.'.$logo->guessExtension();
                    $logo->move(
                        $this->getParameter('image_directory'),$filename
                    );
                    $repository->updateAmount($idU,$id,$amount,$filename);

                    $alreadyis = 2;
                    return $this->redirectToRoute('event_singleS', array('id' => $id, 'evt' => $evt, 'u' => $user,'alreadyis'=>$alreadyis));
                }



        } return $this->redirectToRoute('event_singleS', array('id' => $id, 'evt' => $evt, 'u' => $user,'alreadyis'=>$alreadyis));
    }

    public function DisplayAllSAction()
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->BackAllEventS();
        $g=new Sponsorship();
        $id="";
        return $this->render('@Event/Back/SponsorSpace.html.twig',array('evt'=>$evt,'sp'=>$g,'id'=>$id));
    }

    public function DisplaySponsorAction($id)
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->BackAllEventS();
        $g = $repository->GetSponsor($id);
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository(Event::class)->find($id);
        $name=$event->getNameEvt();
        return $this->render('@Event/Back/SponsorSpace.html.twig',array('sp'=>$g,'evt'=>$evt,'id'=>$id,'name'=>$name));

    }

    public function DisplayAllPAction()
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->BackAllEventP();
        $g=new Participation();
        $id="";
        return $this->render('@Event/Back/ParticiSpace.html.twig',array('evt'=>$evt,'sp'=>$g,'id'=>$id));
    }

    public function DisplayParticiAction($id)
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Event::class);
        $evt = $repository->BackAllEventP();
        $g = $repository->GetPartici($id);
        foreach ($g as $e)
        {$e->setUser( $repository->GetUserName($e->getIdUser()));}
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository(Event::class)->find($id);
        $name=$event->getNameEvt();
        return $this->render('@Event/Back/ParticiSpace.html.twig',array('evt'=>$evt,'id'=>$id,'name'=>$name,'sp'=>$g));


    }

    public function DisplayStatAction()
    {
        $evt = $this->getDoctrine()->getRepository(Event::class)->findAll();
        $chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();
        $data = array();
        $data[0] = array("Event", "Sponsors","Participations","views");
        foreach ($evt as $i) {
            array_push($data,array($i->getNameEvt(), $i->getNbsponsorEvt(),$i->getNbparticipantEvt(),$i->getNbviewsEvt()));
        }

        $chart->getData()->setArrayToDataTable($data);

        $chart->getOptions()->getChart()
            ->setTitle('Events Charts ');
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#f6c23e','#1cc88a','#4e73df'])
            ->getVAxis()
            ->setFormat('decimal');


        $pieChart = new PieChart();
        $data2 = array();
        $data2[0] = array("Organizator","Participations");
        foreach ($evt as $i) {
            array_push($data2,array($i->getOrganizatorEvt(),$i->getNbparticipantEvt()));
        }
        $pieChart->getData()->setArrayToDataTable($data2);

        $pieChart->getOptions()->setPieStartAngle(135);

        $pieSlice1 = new PieSlice();
        $pieSlice1->setColor('#f6c23e');
        $pieSlice2 = new PieSlice();
        $pieSlice2->setColor('#36b9cc');
        $pieSlice3 = new PieSlice();
        $pieSlice3->setColor('#4e73df');
        $pieSlice4 = new PieSlice();
        $pieSlice4->setColor('#1cc88a');
        $pieSlice5 = new PieSlice();
        $pieSlice5->setColor('#e74a3b');
        $pieChart->getOptions()->setSlices([$pieSlice1, $pieSlice2,$pieSlice3,$pieSlice4,$pieSlice5]);
        $pieChart->getOptions()->setTitle('Best Event Organizator per participants');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->setIs3D(true);
        $pieChart->getOptions()->setBackgroundColor('transparent');
        return $this->render('@Event/Back/StatSpace.html.twig',array('evt'=>$evt,'pie'=>$chart,'orga'=>$pieChart));
    }
}
