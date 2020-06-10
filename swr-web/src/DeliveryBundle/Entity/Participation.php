<?php

namespace DeliveryBundle\Entity;

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


}

