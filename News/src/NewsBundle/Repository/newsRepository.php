<?php


namespace NewsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class newsRepository extends EntityRepository
{
    public function lastnews() {
        $qb=$this->getEntityManager()->createQuery("SELECT n FROM NewsBundle:News n WHERE n.datepub between DATE_SUB(CURRENT_DATE(),3,'DAY') AND CURRENT_DATE()")->setMaxResults(3);
        return $query=$qb->getArrayResult();
    }
    public function viewsnews($id) {
        $qb=$this->getEntityManager()->createQuery("UPDATE NewsBundle:News n SET n.view=n.view+1 WHERE n.idn='".$id."'");
        return $query=$qb->getArrayResult();
    }
    public function statnews() {
        $qb=$this->getEntityManager()->createQuery("select n.nomcat,count(n)total from NewsBundle:News n GROUP BY n.nomcat");
        return $query=$qb->getResult();
    }
    public  function affichernews($limit){


        $result = $this->getEntityManager()->createQuery("select n FROM NewsBundle:News n  ")->setMaxResults($limit);

        return $result->getResult();



    }
}