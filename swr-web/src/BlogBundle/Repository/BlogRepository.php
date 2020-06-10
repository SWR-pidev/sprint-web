<?php


namespace BlogBundle\Repository;
use Doctrine\ORM\EntityRepository;


class BlogRepository extends EntityRepository{

    public function findComments($id)
    {
        $qb=$this->getEntityManager()
            ->createQuery( "select c from BlogBundle:Comments c where c.idp=:id ")
            ->setParameter('id',$id);
        return $query = $qb->getResult();

    }
    public function createFindAllQuery()
    {
        return $this->_em->getRepository('BlogBundle:Posts')->createQueryBuilder('p');
    }

    public function hot() {
        $qb=$this->getEntityManager()->createQuery("SELECT p FROM BlogBundle:Posts p WHERE p.datep > DATE_SUB(CURRENT_DATE(),1,'DAY')  ORDER BY p.views  DESC")->setMaxResults(3);
        return $query=$qb->getArrayResult();
    }
    public function who($id)
{
       $qb=$this->getEntityManager()
            ->createQuery( "select count(p) as c from BlogBundle:Posts p where p.iduser=:id and p.report=1 ")
            ->setParameter('id',$id);
        return $query = $qb->getResult();
}

    public function check($id,$iduser)
    {
        $qb=$this->getEntityManager()
            ->createQuery( "select l  from BlogBundle:Likes l where l.iduser=:iduser and l.idp=:id ")
            ->setParameter('iduser',$iduser)
            ->setParameter('id',$id);
        return $query = $qb->getResult();
    }

}