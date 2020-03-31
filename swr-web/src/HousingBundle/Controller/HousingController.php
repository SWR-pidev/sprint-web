<?php


namespace HousingBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use HousingBundle\Entity\Housing;
use HousingBundle\Entity\Items;
use HousingBundle\Entity\Ratings;
use HousingBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HousingController extends Controller
{
    public function showAction()
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
        $pieChart->getOptions()->setTitle('Pourcentage of population per Housing');
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
            ->setHeight(400)
            ->setWidth(900)
            ->setSeries([['axis' => 'Residents'], ['axis' => 'Capacity']])
            ->setAxes(['x' => [
                'Residents' => ['label' => 'parsecs'],
                'Capacity' => ['side' => 'top', 'label' => 'apparent magnitude']]
            ]);

        return $this->render('@Housing/Front/showAllH.html.twig',array('housings'=>$housings,'piechart'=>$pieChart,'chart'=>$chart,'ratings'=>$ratings));

    }

    public function ratingAction(Request $request)
    {
        $hs=new Ratings();
        $em = $this->getDoctrine()->getManager();

        if($request->isMethod('POST')){

            $user = $this->getDoctrine()->getRepository(   User::class)->find($request->get('iduser'));
            $h= $this->getDoctrine()->getRepository(   Housing::class)->find($request->get('idhouse'));
            $hs->setIdh($h);
            $hs->setIduser($user);
            $hs->setFeedback($request->get('feedback'));
            $hs->setRating($request->get('rating'));

            $em->persist($hs);
            $em->flush();
            return $this->redirectToRoute('housing_homepage');

        }
        return $this->redirectToRoute('housing_homepage');

    }

    public function mapAction($id)
    {
        $ratings=$this->getDoctrine()->getRepository(Ratings::class)->findRatingbyIdh($id);
        $housings = $this->getDoctrine()->getRepository(   Housing::class)->find($id);
        return $this->render('@Housing/Front/newMap.html.twig',array('housings'=>$housings,'ratings'=>$ratings));
    }



    public function itemsAction($id)
    {

        $housings = $this->getDoctrine()->getRepository(   Housing::class)->find($id);
        $repository=$this->getDoctrine()->getManager()->getRepository(Items::class);
        $listItems= $repository->myfindbyhousingid($id);
        return $this->render('@Housing/Front/Items.html.twig',array('housing'=>$housings,'items'=>$listItems));
    }

}