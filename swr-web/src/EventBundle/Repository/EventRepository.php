<?php


namespace EventBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;


class EventRepository extends EntityRepository{

    public function PastEvent()
    {
        $qb=$this->getEntityManager()->
            createQuery( "select e from EventBundle:Event e where e.dateEvt< CURRENT_DATE() and e.stateEvt=1  ");
        return $query = $qb->getResult();

    }

    public function GetImg($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select g.img from EventBundle:Gallery g where g.idEvtG=:dom")
            ->setParameter('dom',$id);
        return $query = $qb->getResult();

    }

    public function FrontAllEventP()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Event e where e.stateEvt=1 and e.dateEvt> CURRENT_DATE() ");
        return $query = $qb->getResult();

    }

    public function CheckParticipationEvent($idU,$id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Participation e where e.idEvt=:dom and e.idUser=:tek");
        $qb->setParameter('dom', $id);
        $qb->setParameter('tek', $idU);
        return $query = $qb->getResult();

    }
    public function DeleteParticipationEvent($idU,$id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Participation e where e.idEvt=:dom and e.idUser=:tek");
        $qb->setParameter('dom', $id);
        $qb->setParameter('tek', $idU);
        try {
            return $query = $qb->getSingleResult();
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }

    }

    public function IncNbParticipationEvent($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Event e set e.nbparticipantEvt=e.nbparticipantEvt+1 where e.idEvt=:dom ");
        $qb->setParameter('dom', $id);

        return $query = $qb->getResult();

    }

    public function DecNbParticipationEvent($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Event e set e.nbparticipantEvt=e.nbparticipantEvt-1 where e.idEvt=:dom ");
        $qb->setParameter('dom', $id);

        return $query = $qb->getResult();

    }

    public function IncNbViewsEvent($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Event e set e.nbviewsEvt=e.nbviewsEvt+1 where e.idEvt=:dom ");
        $qb->setParameter('dom', $id);

        return $query = $qb->getResult();

    }

    public function FrontAllEventS()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Event e where e.stateEvt=0 and e.dateEvt> CURRENT_DATE()");
        return $query = $qb->getResult();

    }
    public function FrontAllEventG()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Event e JOIN EventBundle:Gallery g WITH e.idEvt=g.idEvtg  ");
        return $query = $qb->getResult();

    }

    public function GetSponsorLogo($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e.logo from EventBundle:Sponsorship e where e.idEvt=:dom");
        $qb->setParameter('dom', $id);
        return $query = $qb->getResult();

    }

    public function BackAllEvent()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Event e where e.dateEvt> CURRENT_DATE() ");
        return $query = $qb->getResult();

    }

    public function updateStateEvent($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Event e set e.stateEvt=1 where e.idEvt=:dom ");
        $qb->setParameter('dom', $id);

        return $query = $qb->getResult();

    }
    public function updateStillEvent($id,$b)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Event e set e.stillneededEvt=:tek where e.idEvt=:dom ");
        $qb->setParameter('dom', $id);
        $qb->setParameter('tek', $b);
        return $query = $qb->getResult();

    }
    public function CheckSponsorEvent($idU,$id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Sponsorship e where e.idEvt=:dom and e.idSponsor=:tek");
        $qb->setParameter('dom', $id);
        $qb->setParameter('tek', $idU);
        return $query = $qb->getResult();

    }

    public function IncNbSponsorEvent($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Event e set e.nbsponsorEvt=e.nbsponsorEvt+1 where e.idEvt=:dom ");
        $qb->setParameter('dom', $id);

        return $query = $qb->getResult();

    }
    public function updateAmount($idU,$id,$amount,$logo)
    {
        $qb=$this->getEntityManager()->
        createQuery( "update EventBundle:Sponsorship e set e.givenSponsor=e.givenSponsor+:dik , e.logo=:log , e.dateSponsor=CURRENT_DATE() where e.idEvt=:dom and e.idSponsor=:tek ");
        $qb->setParameter('dom', $id);
        $qb->setParameter('tek', $idU);
        $qb->setParameter('dik', $amount);
        $qb->setParameter('log', $logo);
        return $query = $qb->getResult();

    }

    public function BackAllEventS()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Event e JOIN EventBundle:Sponsorship g WITH e.idEvt=g.idEvt  ");
        return $query = $qb->getResult();

    }

    public function GetSponsor($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select g from EventBundle:Sponsorship g where g.idEvt=:dom")
            ->setParameter('dom',$id);
        return $query = $qb->getResult();

    }

    public function BackAllEventP()
    {
        $qb=$this->getEntityManager()->
        createQuery( "select e from EventBundle:Event e JOIN EventBundle:Participation g WITH e.idEvt=g.idEvt  ");
        return $query = $qb->getResult();

    }
    public function GetPartici($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select g from EventBundle:Participation g where g.idEvt=:dom")
            ->setParameter('dom',$id);
        return $query = $qb->getResult();

    }
    public function GetUserName($id)
    {
        $qb=$this->getEntityManager()->
        createQuery( "select g.username,g.image from EventBundle:User g where g.id=:dom")
            ->setParameter('dom',$id);
        return $query = $qb->getResult();

    }

}