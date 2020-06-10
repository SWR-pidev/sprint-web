<?php

namespace DeliveryBundle\Repository;



use DeliveryBundle\Entity\Deliveryman;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\ORM\Query\Expr\Select;


class DeliverymenRepository extends EntityRepository
{


    public function onfire() {
        $qb=$this->getEntityManager()
            ->createQuery("SELECT dm.fname, count (dm) as c from DeliveryBundle:Deliveryman dm inner join DeliveryBundle:Delivery d with dm.iddman = d.iddman group by dm.fname order by c ");
                return $query = $qb->getResult();
    }

    public function deliverymanindelivery($id){
        $qb = $this->getEntityManager()->
        createQuery("select p from DeliveryBundle:Delivery p where p.iddman = $id");
        return $query=$qb->getResult();
    }
}

