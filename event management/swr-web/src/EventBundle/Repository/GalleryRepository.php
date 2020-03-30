<?php


namespace EventBundle\Repository;
use Doctrine\ORM\EntityRepository;


class GalleryRepository extends EntityRepository{


    public function GetImg($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select g from EventBundle:Gallery g where g.idEvtg=:dom")
            ->setParameter('dom',$id);
        return $query = $qb->getResult();

    }

    public function GetImages($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select g.img from EventBundle:Gallery g where g.idEvtg=:dom")
            ->setParameter('dom',$id);
        return $query = $qb->getResult();

    }

}