<?php

namespace DeliveryBundle\Repository;



use DeliveryBundle\Entity\Items;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\ORM\Query\Expr\Select;


class ItemsRepository extends EntityRepository
{

    public function finditembyname($name)
    {$qb= $this->getEntityManager()->createQuery(" select h from DeliveryBundle:Items h where h.name='".$name."'");
        return $query =$qb->getResult();

    }
}

