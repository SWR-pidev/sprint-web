<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
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
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdEvt()
    {
        return $this->idEvt;
    }

    /**
     * @param int $idEvt
     */
    public function setIdEvt($idEvt)
    {
        $this->idEvt = $idEvt;
    }

    /**
     * @return \DateTime
     */
    public function getDateParticipation()
    {
        return $this->dateParticipation;
    }

    /**
     * @param \DateTime $dateParticipation
     */
    public function setDateParticipation($dateParticipation)
    {
        $this->dateParticipation = $dateParticipation;
    }

    public function __construct()
    {
        $this->setDateParticipation(new \DateTime());
    }
}

