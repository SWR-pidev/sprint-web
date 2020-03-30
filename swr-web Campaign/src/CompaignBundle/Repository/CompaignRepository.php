<?php


namespace CompaignBundle\Repository;
use Doctrine\ORM\EntityRepository;
use MongoDB\Driver\Query;


class CompaignRepository extends EntityRepository{

    public function GetDbName($nom)
    {

        $qb=$this->getEntityManager()->
        createQuery( "select c from CompaignBundle:Compaign c where c.nameCmp=:nom ");
      $qb->setParameter('nom', $nom);
      return $c=  $qb->getSingleResult();
    }
    public function GetNameById($id)
    {

        $qb=$this->getEntityManager()->
        createQuery( "select c.nameCmp from CompaignBundle:Compaign c where c.idCmp=:nom ");
        $qb->setParameter('nom', $id);
        return $c=  $qb->getSingleResult();
    }
    public function CmpProp()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from CompaignBundle:Compaign e JOIN CompaignBundle:Sugg g WITH e.idCmp=g.idCmp  ");
        return $query = $qb->getResult();

    }
    public function GetDbNameFor($nom)
    {

        $qb=$this->getEntityManager()->
        createQuery( "select c from CompaignBundle:Compaign c where c.nameCmp=:nom ");
        $qb->setParameter('nom', $nom);
        return $c=  $qb->getResult();
    }

    public function GetPropByIdCmp($nom)
    {

        $qb=$this->getEntityManager()->
        createQuery( "select c from CompaignBundle:Sugg c where c.idCmp=:nom ");
        $qb->setParameter('nom', $nom);
        return $c=  $qb->getResult();
    }
    public function RecentDonation($idc)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select d from CompaignBundle:Donation d where d.idCmp=:nom ");
        $qb->setParameter('nom', $idc);
        return $c=  $qb->getResult();
    }
    public function WeCanDonate($idc,$given)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select d from CompaignBundle:Compaign d where d.idCmp=:nom and (d.stillneeded >= :giv )");
        $qb->setParameter('nom', $idc);
        $qb->setParameter('giv', $idc);
         $c=  $qb->getResult();
         return $result=count($c);
    }
    public function IncrementNbDon($idc)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update CompaignBundle:Compaign c set c.nbdon=c.nbdon+1  where c.idCmp=:nom ");
        $qb->setParameter('nom', $idc);
        return $qb->execute();
    }
    public function UpdateStillNeeded($idc,$given)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update CompaignBundle:Compaign c set c.stillneeded=c.stillneeded-:giv  where c.idCmp=:nom ");
        $qb->setParameter('nom', $idc);
        $qb->setParameter('giv', $given);
        return $qb->execute();
    }
    public function UpdateRaised($idc,$given)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update CompaignBundle:Compaign c set c.raised=c.raised+:giv  where c.idCmp=:nom ");
        $qb->setParameter('nom', $idc);
        $qb->setParameter('giv', $given);
        return $qb->execute();
    }
    public function DeleteDon($nom)
    {
        $qb=$this->getEntityManager()->
        createQuery( "delete d from CompaignBundle:Donation d where d.idCmp=:nom ");
        $qb->setParameter('nom', $nom);
        return $c=  $qb->execute();
    }
    public function DeleteSugg($nom)
    {
        $qb=$this->getEntityManager()->
        createQuery( "delete d from CompaignBundle:Sugg d where d.idCmp=:nom ");
        $qb->setParameter('nom', $nom);
        return $c=  $qb->execute();
    }
    public function GetUserNameById($id)
    {

        $qb=$this->getEntityManager()->
        createQuery( "select c.username from CompaignBundle:User c where c.id=:nom ");
        $qb->setParameter('nom', $id);
        return $c=  $qb->getSingleResult();
    }
}