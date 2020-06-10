<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idEvt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_participation", type="date", nullable=false)
     */
    private $dateParticipation;



    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Participation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idEvt
     *
     * @param integer $idEvt
     *
     * @return Participation
     */
    public function setIdEvt($idEvt)
    {
        $this->idEvt = $idEvt;

        return $this;
    }

    /**
     * Get idEvt
     *
     * @return integer
     */
    public function getIdEvt()
    {
        return $this->idEvt;
    }

    /**
     * Set dateParticipation
     *
     * @param \DateTime $dateParticipation
     *
     * @return Participation
     */
    public function setDateParticipation($dateParticipation)
    {
        $this->dateParticipation = $dateParticipation;

        return $this;
    }

    /**
     * Get dateParticipation
     *
     * @return \DateTime
     */
    public function getDateParticipation()
    {
        return $this->dateParticipation;
    }
}
