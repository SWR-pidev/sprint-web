<?php


namespace HousingBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ItemsRepository extends EntityRepository
{
public function myfindbyhousingid($id){
    $qb= $this->getEntityManager()->createQuery("select i.iditem,i.name,i.description,i.quantity,i.status from HousingBundle:Items i where i.idh='".$id."'");
    return $query =$qb->getResult();
}
    public function findanddelete($id){
        $qb= $this->getEntityManager()->createQuery("delete from HousingBundle:items r where r.idh='".$id."'");
        return $query =$qb->getResult();

    }
}