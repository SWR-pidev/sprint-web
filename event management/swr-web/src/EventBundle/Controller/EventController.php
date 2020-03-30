<?php

namespace EventBundle\Controller;

use EventBundle\Entity\Event;
use EventBundle\Entity\Gallery;
use EventBundle\Entity\Participation;
use EventBundle\Entity\Sponsorship;
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
        return new Response( "Bonjour mes étudiants de 3A8");
    }
    public function DisplayAction()
    {
        $evt = $this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('@Event/Back/EventSpace.html.twig',array('evt'=>$evt));

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
        $im=$request->request->get('url');


        if ($form->isSubmitted() and $form->isValid() and $im!=null) {
            $em = $this->getDoctrine()->getManager();
            try {
                $evt->setDateEvt(new \DateTime($request->request->get('date')));
            } catch (\Exception $e) {
            }

            $evt->setUrlEvt($im);
            $f= new UploadedFile('C:/Users/Eya/Pictures/'.$im,$im,'png/jpeg/jpg',null,null,true);
            $evt->setFile($f);
            $evt->uploadProfilePicture();
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
        $im=$request->request->get('url');

        if ($form->isSubmitted() and $form->isValid() and $im!=null)
        {
            try {
                $evt->setDateEvt(new \DateTime($request->request->get('date')));
            } catch (\Exception $e) {
            }
            $evt->setUrlEvt($im);
            $f= new UploadedFile('C:/Users/Eya/Pictures/'.$im,$im,'png/jpeg/jpg',null,null,true);
            $evt->setFile($f);
            $evt->uploadProfilePicture();
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
            $im=$request->request->get('url');
            $gal->setImg($im);
            $id=($request->request->get('idEvt'));
            $evt=$em->getRepository(Event::class)->find($id);
            $gal->setIdEvtg($evt);
            $name=$evt->getNameEvt();
            $f= new UploadedFile('C:/Users/Eya/Pictures/'.$im,$im,'png/jpeg/jpg',null,null,true);
            $gal->setFile($f);
            $gal->uploadProfilePicture();
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

            $im=$request->request->get('urlU');
            $gal->setImg($im);

            $f= new UploadedFile('C:/Users/Eya/Pictures/'.$im,$im,'png/jpeg/jpg',null,null,true);
            $gal->setFile($f);
            $gal->uploadProfilePicture();
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




}
