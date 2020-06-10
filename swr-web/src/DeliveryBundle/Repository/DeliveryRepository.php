<?php

namespace DeliveryBundle\Repository;



use DeliveryBundle\Entity\Delivery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\ORM\Query\Expr\Select;


class DeliveryRepository extends EntityRepository
{

    public function findmostitems()
    {

        $qb=$this->getEntityManager()->createQuery("select c from DeliveryBundle:Delivery c order by c.item DESC ");
        return $query = $qb->getResult();


    }
    public function statslow()
    {
        $qb=$this->getEntityManager()->createQuery("select c from DeliveryBundle:Delivery c group by  c.item order by asc ");
        return $query = $qb->getResult();


    }

    public function nbrdeliveryitem () {
        $qb=$this->getEntityManager()
            ->createQuery
            ("select count(p) as c, p.item from DeliveryBundle:Delivery p group by p.item order by p.item asc ");
            return $query = $qb->getResult();


    }
    public function addressonfire () {
        $qb=$this->getEntityManager()
            ->createQuery
            ("SELECT h.address, count(h) as c FROM DeliveryBundle:housing h INNER JOIN DeliveryBundle:Delivery d WITH h.idh = d.idh GROUP BY h.address ORDER BY c ");
        return $query = $qb->getResult();


    }
/*select h.address, count(h) as nbred from DeliveryBundle:Housing h inner join (DeliveryBundle:Delivery d*/
}
