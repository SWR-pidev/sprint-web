<?php


namespace HousingBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReviewsRepository extends EntityRepository
{
public function findRatingbyIdh($id){
    $qb= $this->getEntityManager()->createQuery("select r.idr,r.rating,r.feedback,u.username,u.image,u.id from HousingBundle:Ratings r,HousingBundle:User u where r.iduser=u.id and r.idh='".$id."'");
    return $query =$qb->getResult();
}

public function findavgrating($id){
    $qb= $this->getEntityManager()->createQuery("select Avg(r.rating) from HousingBundle:Ratings r where r.idh='".$id."'");
    return $query =$qb->getResult();
}
    public function findavgratingall(){
        $qb= $this->getEntityManager()->createQuery("select r.idr,r.rating,r.feedback,h.idh from HousingBundle:Ratings r ,HousingBundle:Housing h where r.idh=h.idh");
        return $query =$qb->getResult();
    }

public function findanddelete($id){
    $qb= $this->getEntityManager()->createQuery("delete from HousingBundle:Ratings r where r.idh='".$id."'");
    return $query =$qb->getResult();

}

    public function findanddeletegoods($id){
        $qb= $this->getEntityManager()->createQuery("delete from HousingBundle:Goods r where r.idh='".$id."'");
        return $query =$qb->getResult();

    }
}