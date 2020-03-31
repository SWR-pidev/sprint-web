<?php


namespace HousingBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReviewsRepository extends EntityRepository
{
public function findRatingbyIdh($id){
    $qb= $this->getEntityManager()->createQuery("select r from HousingBundle:Ratings r where r.idh='".$id."'");
    return $query =$qb->getResult();
}

}