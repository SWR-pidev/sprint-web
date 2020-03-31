<?php


namespace HousingBundle\Repository;


use Doctrine\ORM\EntityRepository;

class HousingRepository extends EntityRepository
{
public function myfindbyid($id){
    $qb= $this->getEntityManager()->createQuery("select h from HousingBundle:Housing h where h.idh='".$id."'");
    return $query =$qb->getResult();
}

}