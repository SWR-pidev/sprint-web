<?php

namespace CompaignBundle\Controller;

use CompaignBundle\CompaignBundle;
use CompaignBundle\Entity\Compaign;
use CompaignBundle\Entity\Sugg;
use CompaignBundle\Entity\User;
use CompaignBundle\Entity\Donation;
use CompaignBundle\Form\CompaignType;
use CompaignBundle\Form\PropositionType;
use CompaignBundle\Repository\CompaignRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Time;

class CompaignController extends Controller
{
    public function indexAction()
    {
        //return $this->render('@club/Default/index.html.twig');
        return new Response("");
    }

    public function DisplayAction()
    {
        $evt = $this->getDoctrine()->getRepository(Compaign::class)->findAll();
        $vt = new Compaign();

        $form = $this->createForm(CompaignType::class, $vt);
        return $this->render('@Compaign/Back/CompaignSpace.html.twig', array('cm' => $evt, 'f' => $form->createView(),'cmp' => $vt,'hide'=>true));

    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evt = $this->getDoctrine()->getRepository(Compaign::class)->find($id);
        //$this->getDoctrine()->getRepository(Compaign::class)->DeleteDon($id);
       // $this->getDoctrine()->getRepository(Compaign::class)->DeleteSugg($id);
        $em->remove($evt);
        $em->flush();
        return $this->redirectToRoute("compaign_space");
    }

    /**
     * Get root directory for file uploads
     *
     * @return string
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '\\..\\..\\..\\..\\swr\\web\\' . self::getUploadDir();
    }

    /**
     * Get the web path for the user
     *
     * @return string
     */
    public function getWebProfilePicturePath()
    {

        return '/' . $this->getUploadDir() . '/' . $this->getImage();
    }

    /**
     * Specifies where in the /web directory profile pic uploads are stored
     *
     * @return string
     */
    protected function getUploadDir()
    {
        // the type param is to change these methods at a later date for more file uploads
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    /**
     * Get the file used for profile picture uploads
     *
     * @return UploadedFile
     */
    public function getProfilePictureFile()
    {

        return $this->profilePictureFile;
    }

    public function setProfilePictureFile(UploadedFile $file)
    {
        $this->profilePictureFile = $file;
        return $this;
    }

    /**
     * @Assert\File(maxSize="9048k")
     * @Assert\Image(mimeTypesMessage="Please upload a valid image.")
     */
    public $profilePictureFile;

    public function uploadProfilePicture($img)
    {

        // check there is a profile pic to upload
        if ($this->getProfilePictureFile() === null) {
            return;
        }

        $filesystem = new Filesystem();
        $filesystem->copy(self::getProfilePictureFile(), self::getUploadRootDir() . "/" . $img);

    }

    public function addAction(Request $request)
    {
        $evt = new Compaign();
        $form = $this->createForm(CompaignType::class, $evt);
        $form = $form->handleRequest($request);
        $users=$this->getDoctrine()->getRepository(User::class)->findAll();

        if ($form->isSubmitted()) {


            $em = $this->getDoctrine()->getManager();
            $evt->setRaised(0);
            $evt->setNbdon(0);
            $evt->setStillneeded($evt->getTarget());
            $evt->setUrlimg($request->request->get('urlimg'));
            $im = $request->request->get("urlimg");
            $f = new UploadedFile('C:/Users/Monta/Pictures/' . $im, $im, 'png/jpeg/jpg', null, null, true);
            self::setProfilePictureFile($f);
            self::uploadProfilePicture($im);
            foreach ($users as $us){

                $message = \Swift_Message::newInstance()
                    ->setSubject('New Campaign')
                    ->setFrom('montassar43@gmail.com')
                    ->setTo($us->getEmail())
                ->addPart(
                    $this->renderView(
                        '@Compaign/Mailbody/Mailbody.html.twig',
                        array('cm' => $evt)
                    ), 'text/html'
                )

                ;
                $this->get('mailer')->send($message);


            }

            $em->persist($evt);
            $em->flush();
            return $this->redirectToRoute('compaign_space');
        }
        return $this->render('@Compaign/Back/CompaignSpace.html.twig', array('f' => $form->createView()));
    }

    public function updateCmpAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $evt = $em->getRepository(Compaign::class)->find($id);
        $evs = new Compaign();
        $form = $this->createForm(CompaignType::class, $evs);
        $ev = $this->getDoctrine()->getRepository(Compaign::class)->findAll();
        if ($request->isMethod('POST')) {

            $evt->setNameCmp($request->request->get('name'));
            $evt->setDescrip($request->request->get('desc'));
            $evt->setTarget($request->request->get('target'));
            $evt->setStillneeded($evt->getTarget());
            $evt->setUrlimg($request->request->get('urlimg'));
            $im = $request->request->get("urlimg");
            $f = new UploadedFile('C:/Users/Monta/Pictures/' . $im, $im, 'png/jpeg/jpg', null, null, true);
            self::setProfilePictureFile($f);
            self::uploadProfilePicture($im);

            $em->flush();
            return $this->redirectToRoute('compaign_space');
        }
        return $this->render('@Compaign/Back/CompaignSpace.html.twig', array('cmp' => $evt,'cm'=>$ev,'f' => $form->createView(),'hide'=>false));
    }

    public function DisplayPropAction()
    {
        $evt = $this->getDoctrine()->getRepository(Sugg::class)->findAll();
        $name = $this->getDoctrine()->getRepository(Compaign::class)->findAll();


        return $this->render('@Compaign/Back/PropositionSpace.html.twig', array('cm' => $evt,'n'=>$name));

    }

    public function deletePropAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evt = $this->getDoctrine()->getRepository(Sugg::class)->findBy($id);
        $em->remove($evt);
        $em->flush();
        return $this->redirectToRoute("prop_space");
    }
    public function DisplayFrontAction()
    {

        $evt = $this->getDoctrine()->getRepository(Compaign::class)->findAll();

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
             $user->getUsername();

            return $this->render('@Compaign/Front/CompaignSpaceFront.html.twig',array('cm' => $evt,'u'=>$user));
        }

        }
    public function DisplaySignleAction($id)
    {

        $evt = $this->getDoctrine()->getRepository(Compaign::class)->find($id);
        $Prop= $this->getDoctrine()->getManager()->getRepository(Sugg::class)->GetPropByIdCmp($id);
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $user->getUsername();
            $repo=$this->getDoctrine()->getManager()->getRepository(Donation::class);
            $rec=$this->getDoctrine()->getManager()->getRepository(Donation::class)->RecentDonation($id);
            foreach ($rec as $d ){ $d->setName($repo->GetUserNameById($d->getIdUser()));}
            return $this->render('@Compaign/Front/CompaignSignle.html.twig',array('cm' => $evt,'u'=>$user,'p'=>$Prop,'rec'=>$rec));
        }
    }

    public function DonateAction(Request $request ,$idc)
    {

        $repository=$this->getDoctrine()->getManager()->getRepository(Compaign::class);
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idU=$user->getId();
             if ($request->isMethod('POST')) {
               $WeCanDonate=$repository->WeCanDonate($idc,$request->request->get('given'));
               if ( $WeCanDonate!=0)
                  {
                      $ano=0;
                      $mon=0;
                      $fun=0;
                $given=$request->request->get('given');
              if ( $request->request->get('anno')=="on"){$ano=1;}
               if ( $request->request->get('mon')=="on"){$mon=1;}
                if ($request->request->get('funds')=="on"){$fun=1;}
                $repository->IncrementNbDon($idc);
                $repository->UpdateStillNeeded($idc,$given);
                $repository->UpdateRaised($idc,$given);
                $don=new Donation();
                $don->setIdUser($idU);
                $don->setIdCmp($idc);
                $don->setAnnonym($ano);
                $don->setMonthly($mon);
                $don->setFunds($fun);
                $don->setMessage($request->request->get('desc'));
                $don->setGiven($given);
                $don->setDated(new \DateTime());
                $time = new \DateTime();
                $time->format('H:i:s \O\n Y-m-d');
                $don->setTimed($time);
                $em = $this->getDoctrine()->getManager();
                $em->persist($don);
                $em->flush();
            }
        }
            return $this->redirectToRoute('compaign_signle',array('id'=>$idc));
        }
    }


}




