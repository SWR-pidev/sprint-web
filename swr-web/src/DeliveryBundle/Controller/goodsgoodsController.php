<?php

namespace DeliveryBundle\Controller;


use DeliveryBundle\Entity\goodss;
use DeliveryBundle\Entity\Housing;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class goodsgoodsController extends Controller
{
    public function allAction(Request $request)
    {
        $goodss = $this->getDoctrine()->getManager()->getRepository('DeliveryBundle:goodss')
            ->myfindAllg();

        $serializer =  new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize ($goodss);
        return new JsonResponse($formatted);

    }
    public function allhousingAction(Request $request)
    {
        $hs = $this->getDoctrine()->getManager()->getRepository('DeliveryBundle:Housing')
            ->findAll();

        $serializer =  new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize ($hs);
        return new JsonResponse($formatted);

    }
    public function allitemsAction(Request $request)
    {
        $items = $this->getDoctrine()->getManager()->getRepository('DeliveryBundle:Items')
            ->findAll();

        $serializer =  new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize ($items);
        return new JsonResponse($formatted);

    }
    public function creategoodsAction(Request $request)
    {
        $goods = new goodss();

        $goods->setiduser($request->get("iduser"));
        $goods->setqcollected($request->get("qc"));
        $item=$this->getDoctrine()->getRepository('DeliveryBundle:Items')->finditembyname($request->get("item"));
        $hs=$this->getDoctrine()->getRepository('DeliveryBundle:Housing')->findhsbyname($request->get("idh"));

        $goods->setitem($item[0]);

        $goods->setidh($hs[0]);

        $goods->setstatus("Waiting");

       $em= $this->getDoctrine()->getManager();
       $em->persist($goods);
       $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($goods);
        return new JsonResponse($formatted);




    }
}