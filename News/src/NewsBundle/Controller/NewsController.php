<?php

namespace NewsBundle\Controller;

use NewsBundle\Entity\News;
use NewsBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use NewsBundle\Repository\newsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use NewsBundle\Form\NewsType;

class NewsController extends Controller
{
    public function indexAction()
    {
        return $this->render('@News/Default/index.html.twig');
    }
    public function newsfAction()
    {
        $news = $this->getDoctrine()->getRepository(News::class)->lastnews();
        return $this->render('@News/Default/Front/newsf.html.twig', array('News' => $news));
    }
    public function statnewsAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Category of News');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $ch = $this->getDoctrine()->getRepository(News::class)->statnews();
        $data = array();
        foreach ($ch as $val)
        {
            $a=array($val['nomcat'],intval($val['total']));
            array_push($data,$a);
        }
        $ob->series(array(array('type' => 'pie','name' => 'Total', 'data' => $data)));

        return $this->render('@News/Default/statnews.html.twig', array(
            'chart' => $ob
        ));
    }
    public function affichnewsAction(Request $request)
    {
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $news, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',3)
        );
        return $this->render("@News/Default/affichnews.html.twig", array('News' => $result));
    }
    public function allnewsAction($m)
    {if($m==3)
    {
        $news = $this->getDoctrine()->getRepository(News::class)->affichernews($m);
        return $this->render("@News/Default/Front/newsall.html.twig", array('News' => $news , 'm' =>$m));
    }
        $m+=3;
        $news = $this->getDoctrine()->getRepository(News::class)->affichernews($m);
        return $this->render("@News/Default/Front/newsall.html.twig", array('News' => $news , 'm' =>$m));

    }
    public function affichnewsdAction($id)
    {   $this->getDoctrine()->getRepository(News::class)->viewsnews($id);
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)->find($id);
        return $this->render("@News/Default/Front/newsfd.html.twig", array('News' => $news));
    }
    public function pdfnewsdAction($id)
    {   $snappy = $this->get('knp_snappy.pdf');
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)->find($id);
        $html = $this->render("@News/Default/Front/pdfnewsd.html.twig", array('News' => $news));
        $filename =$news->getTitre();
        return new Response($snappy->getOutputFromHtml($html,array(
            'default-header'=>null,
            'encoding' => 'utf-8',
            'images' => true,
            'enable-javascript' => true,
            'margin-right'  => 7,
            'margin-left'  =>7,
            'javascript-delay' => 5000,
            'orientation' => 'landscape',
            'javascript-delay' => 1000,
            'no-background' => false,
            'lowquality' => false,

            'cookie' => array(),
            'dpi' => 300,
            'enable-external-links' => true,
            'enable-internal-links' => true
        ))
            ,200,
            array(
                'Content-Type'=> 'application/pdf',
                'Content-Disposition'=> 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }
    public function affichcatAction()
    {
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render("@News/Default/affichcat.html.twig", array('News' => $cat));
    }

    public function deletenewsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)->find($id);
        $em->remove($news);
        $em->flush();
        return $this->redirectToRoute("news_affichnews");
    }
    public function deletecatAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(Categorie::class)->find($id);
        $em->remove($news);
        $em->flush();
        return $this->redirectToRoute("news_affichcat");
    }

    public function modifynewsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)->find($id);
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        if ($request->isMethod('POST')) {
            $news->setTitre($request->get('titre'));
            $news->setDescription($request->get('description'));
            $news->setNomcat($request->get('nomcat'));
            $news->setImage($request->get('image'));

            $em->flush();
            return $this->redirectToRoute('news_affichnews');

        }
        return $this->render('@News/Default/modifynews.html.twig', array('news' => $news , 'cat'=>$cat));
    }
    public function modifycatAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Categorie::class)->find($id);
        if ($request->isMethod('POST')) {
            $cat->setNomcat($request->get('nomcat'));
            $em->flush();
            return $this->redirectToRoute('news_affichcat');

        }
        return $this->render('@News/Default/modifycat.html.twig', array('cat' => $cat));
    }

    public  function ajoutnewsAction(Request $rq){
        $news = new News();
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $form = $this->createForm(NewsType::class, $news);
        if($rq->request->get('add')){
            $news->setTitre($rq->get('titre'));
            $news->setDescription($rq->get('description'));
            $news->setDatepub(new \DateTime($rq->get('datepub')));
            $news->setNomcat($rq->get('nomcat'));
            /**
             * @var UploadedFile $file
             */

            /*var_dump($file);
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            var_dump($file);
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );*/

            $news->setImage($rq->get('mofile'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
            return $this->redirectToRoute('news_affichnews');
    }
        return $this->render('@News/Default/ajoutnews.html.twig', array('cat' => $cat,'f' => $form->createView()));
    }

    public  function ajoutcatAction(Request $rq){
        if($rq->request->get('add')){
            $cat = new Categorie();
            $cat->setNomcat($rq->get('nomcat'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute('news_affichcat');
        }
        return $this->render('@News/Default/ajoutcat.html.twig');
    }




}
