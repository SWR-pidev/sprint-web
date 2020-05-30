<?php

namespace HousingBundle\Controller;

use HousingBundle\Entity\Housing;
use HousingBundle\Entity\Items;
use HousingBundle\Entity\Ratings;
use HousingBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HousingapiController extends Controller
{
    // route
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(Housing::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(Housing::class)
            ->myfindbyid($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    //Adding new Review
    public function NewratingAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

            $idr=$request->get('idr');
            if($idr==0){
                $hs=new Ratings();
                $user = $this->getDoctrine()->getRepository(   User::class)->find($request->get('iduser'));
                $h= $this->getDoctrine()->getRepository(   Housing::class)->find($request->get('idhouse'));
                $hs->setIdh($h);

                $hs->setIduser($user);
            }
            else
            {

                $hs = $this->getDoctrine()->getRepository(   Ratings::class)->find($idr);
            }
            $hs->setFeedback($request->get('feedback'));
            $hs->setRating($request->get('rating'));
            $em->persist($hs);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($hs);
            return new JsonResponse($formatted);

    }

    //Getting  the avg Rating of a specific*
//    public function ShowAvgRsAction($id)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//        $ratings = $this->getDoctrine()->getRepository(   Ratings::class)->findavgrating($id);
//        $serializer = new Serializer([new ObjectNormalizer()]);
//
//        $formatted = $serializer->normalize($ratings);
//        return new JsonResponse($formatted);
//    }
    public function ShowAvgRsAction()
    {

        $em = $this->getDoctrine()->getManager();
        $ratings = $this->getDoctrine()->getRepository(   Ratings::class)->findavgratingall();
        $serializer = new Serializer([new ObjectNormalizer()]);

        $formatted = $serializer->normalize($ratings);
        return new JsonResponse($formatted);
    }

    public function ShowRsAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $ratings = $this->getDoctrine()->getRepository(   Ratings::class)->findRatingbyIdh($id);
        $serializer = new Serializer([new ObjectNormalizer()]);

        $formatted = $serializer->normalize($ratings);
        return new JsonResponse($formatted);
    }

    //Getting All the items
    public function ShowItemsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $items = $this->getDoctrine()->getRepository(   Items::class)->myfindbyhousingid($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($items);
        return new JsonResponse($formatted);


    }


}
