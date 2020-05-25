<?php


namespace HousingBundle\Repository;


use Doctrine\ORM\EntityRepository;

class HousingRepository extends EntityRepository
{
public function myfindbyid($id){
    $qb= $this->getEntityManager()->createQuery("select h from HousingBundle:Housing h where h.idh='".$id."'");
    return $query =$qb->getResult();
}
    public function myfindAll(){
        $qb= $this->getEntityManager()->createQuery("select h,avg(r.rating) from HousingBundle:Housing h, HousingBundle:Ratings r  where h.idh=r.idh");
        return $query =$qb->getResult();
    }

}