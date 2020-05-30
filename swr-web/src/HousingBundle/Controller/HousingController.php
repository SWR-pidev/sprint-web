<?php


namespace HousingBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use HousingBundle\Entity\Housing;
use HousingBundle\Entity\Items;
use HousingBundle\Entity\Ratings;
use HousingBundle\Entity\User;
use HousingBundle\Entity\Goods;
use HousingBundle\Form\GoodsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HousingController extends Controller
{
    public function showAction(Request $request)
    {   $housings = $this->getDoctrine()->getRepository(   Housing::class)->findAll();
        $pieChart = new PieChart();
        $totalHousings=0;
        $ratings = $this->getDoctrine()->getRepository(   Ratings::class)->findAll();
        foreach($housings as $hs ){
            $totalHousings=$totalHousings+$hs->getNbresidents();
        }
        $data=array();
        $stat=['Housing','nbResidents'];
        $nb=0;
        array_push($data,$stat);
        foreach($housings as $housing){
            $stat=array();
            array_push($stat,$housing->getName(),(($housing->getNbresidents())*100)/$totalHousings);
            $nb=($housing->getNbresidents()*100)/$totalHousings;
            $stat=[$housing->getName(),$nb];
            array_push($data,$stat);
        }


        $pieChart->getData()->setArrayToDataTable( $data );
        $pieChart->getOptions()->setTitle('Pourcentage of housing ');
        $pieChart->getOptions()->setHeight(500); $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        $chart = new BarChart();
        $databar=array();
        $statistics= ['Housings', 'Residents', 'Capacity'];
        array_push($databar,$statistics);
        foreach($housings as $housing){
            $statistics=array();
            array_push($statistics,$housing->getName(),$housing->getNbresidents(),$housing->getCapacity());

            $stat=[$housing->getName(),$housing->getNbresidents(),$housing->getCapacity()];
            array_push($databar,$stat);
        }
        $chart->getData()->setArrayToDataTable( $databar );
        $chart->getOptions()->getChart()
            ->setTitle('Housings')
            ->setSubtitle('Nombre of Residents on the left, Capacity on the right');
        $chart->getOptions()
            ->setHeight(500)
            ->setWidth(800)
            ->setSeries([['axis' => 'Residents'], ['axis' => 'Capacity']])
            ->setAxes(['x' => [
                'Residents' => ['label' => ''],
                'Capacity' => ['side' => 'top', 'label' => '']]
            ]);
        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator= $this->get('knp_paginator');
        $result= $paginator->paginate(
            $housings,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)

        );
        return $this->render('@Housing/Front/showAllH.html.twig',array('housings'=>$result,'piechart'=>$pieChart,'chart'=>$chart,'ratings'=>$ratings));

    }

    public function ratingAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();


        $ratings = $this->getDoctrine()->getRepository(   Ratings::class)->findAll();

        if($request->isMethod('POST')){
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
            return $this->redirectToRoute('housing_map',array('id' => $request->get('idhouse')));

        }
        return $this->redirectToRoute('housing_homepage');

    }

    public function mapAction($id)
    {
        $ratings=$this->getDoctrine()->getRepository(Ratings::class)->findRatingbyIdh($id);
        $housings = $this->getDoctrine()->getRepository(   Housing::class)->find($id);
        return $this->render('@Housing/Front/newMap.html.twig',array('housings'=>$housings,'ratings'=>$ratings));
    }



    public function itemsAction(Request $request,$id)
    {
//        Goods creation
        $hs=new Goods();
        $form=$this->createForm(GoodsType::class,$hs);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('housing_homepage');

        }

        $housings = $this->getDoctrine()->getRepository(   Housing::class)->find($id);
        $repository=$this->getDoctrine()->getManager()->getRepository(Items::class);
        $goods=$this->getDoctrine()->getManager()->getRepository(Goods::class)->findAll();
        //$listItems= $repository->myfindbyhousingid($id);
        $listItems= $repository->findAll();
        foreach ($goods as $g)
        {   foreach($listItems as $l) {

            if ($l->getName()===$g->getItem()){
                if($l->getQuantity() < $g->getQcollected())
                {$l->setQuantity(0);
                $l->setStatus("Collected");}
                else{
                    $l->setQuantity($l->getQuantity()- $g->getQcollected());
                }
            $em = $this->getDoctrine()->getManager();
            $em->persist($l);
            $em->flush();
        }



        }}

        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator= $this->get('knp_paginator');
        $result= $paginator->paginate(
            $listItems,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)

        );
        return $this->render('@Housing/Front/Items.html.twig',array('housing'=>$housings,'items'=>$result,'form'=>$form->createView()));
    }

}