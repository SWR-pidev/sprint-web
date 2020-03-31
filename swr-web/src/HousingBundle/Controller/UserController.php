<?php

namespace HousingBundle\Controller;

use HousingBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

//    public function profileAction(Request $request,$id)
//    {   $user= new User();
//        $user=$this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
//        return $this->render('@Housing/Front/profile.html.twig',array("user"=>$user));
//    }


    public function showUsersAction(){
        $repository=$this->getDoctrine()->getManager()->getRepository(User::class);
        $listUsers = $repository->findAll();
        return ($this->render('@Housing/Back/showusers.html.twig',array("listUsers"=>$listUsers)));
    }


    public function updateAction(Request $request , $id){
        $em = $this->getDoctrine()->getManager();
        $emp = $em->getRepository(User::class)->find($id);
        if($request->isMethod('POST')){
            $emp->setLastname($request->get('nom'));
            $emp->setFirstname($request->get('prenom'));
            $emp->setCountry($request->get('country'));
            $emp->setEmail($request->get('email'));
            $emp->setTel($request->get('tel'));





            $em->flush();
            return $this->redirectToRoute('User_back');

        }
        return $this->render('@Housing/Back/userupdate.html.twig', array('emp' =>$emp));
    }
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(User::class)
            ->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute("User_back");
    }
    public function userAddAction(Request $request){
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        /**
         * @var UploadedFile $file
         */
        if($request->isMethod('POST')){
            $user->setLastname($request->get('nom'));
            $user->setFirstname($request->get('prenom'));
            $user->setCountry($request->get('country'));
            $user->setEmail($request->get('email'));
            $user->setTel($request->get('tel'));
            $user->setUsername($request->get('username'));
            $user->setPassword($request->get('password'));
            $user->setRoles(['ROLE_USER']);
            $user->setDateins(new \DateTime('now'));
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('User_back');

        }


        return $this->render('@Housing/Back/usercreation.html.twig');
    }
}
