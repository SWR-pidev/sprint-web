<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donation
 *
 * @ORM\Table(name="donation")
 * @ORM\Entity
 */
class Donation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_don", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDon;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cmp", type="integer", nullable=true)
     */
    private $idCmp;

    /**
     * @var integer
     *
     * @ORM\Column(name="monthly", type="integer", nullable=true)
     */
    private $monthly;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=55, nullable=true)
     */
    private $message;

    /**
     * @var float
     *
     * @ORM\Column(name="funds", type="float", precision=10, scale=0, nullable=false)
     */
    private $funds;

    /**
     * @var integer
     *
     * @ORM\Column(name="given", type="integer", nullable=false)
     */
    private $given;

    /**
     * @var integer
     *
     * @ORM\Column(name="annonym", type="integer", nullable=false)
     */
    private $annonym;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dated", type="date", nullable=false)
     */
    private $dated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timed", type="time", nullable=false)
     */
    private $timed;


}

