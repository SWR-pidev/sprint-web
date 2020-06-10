<?php

namespace DeliveryBundle\Repository;



use DeliveryBundle\Entity\goodss;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\ORM\Query\Expr\Select;


class GoodsRepository extends EntityRepository
{
    public function myfindAllg(){
        $qb= $this->getEntityManager()->createQuery(" select g.status,g.qcollected,h.address,i.name from DeliveryBundle:goodss g, DeliveryBundle:Housing h,DeliveryBundle:Items i where h.idh=g.idh ");
        return $query =$qb->getResult();
    }

}

