<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

    /**
     * @var integer
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     */
    private $idp;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuC", type="string", length=400, nullable=false)
     */
    private $contenuc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateC", type="datetime", nullable=false)
     */
    private $datec;

    /**
     * @var integer
     *
     * @ORM\Column(name="reportC", type="integer", nullable=false)
     */
    private $reportc;

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;


}

