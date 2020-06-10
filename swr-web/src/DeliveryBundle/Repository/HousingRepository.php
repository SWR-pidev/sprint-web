<?php

namespace DeliveryBundle\Repository;



use DeliveryBundle\Entity\Housing;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\ORM\Query\Expr\Select;


class HousingRepository extends EntityRepository
{

    public function findhsbyname($name)
    {$qb= $this->getEntityManager()->createQuery(" select h from DeliveryBundle:Housing h where h.name='".$name."'");
        return $query =$qb->getResult();

    }
}

