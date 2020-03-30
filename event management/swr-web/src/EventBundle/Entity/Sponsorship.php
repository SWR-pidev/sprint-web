<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sponsorship
 *
 * @ORM\Table(name="sponsorship")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
 */
class Sponsorship
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idEvt;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id_sponsor", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=85, nullable=false)
     */
    private $logo;

    /**
     * @var float
     *
     * @ORM\Column(name="given_sponsor", type="float", precision=10, scale=0, nullable=false)
     */
    private $givenSponsor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sponsor", type="date", nullable=false)
     */
    private $dateSponsor;


}

