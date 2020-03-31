<?php


namespace HousingBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ItemsRepository extends EntityRepository
{
public function myfindbyhousingid($id){
    $qb= $this->getEntityManager()->createQuery("select i from HousingBundle:Items i where i.idh='".$id."'");
    return $query =$qb->getResult();
}

}