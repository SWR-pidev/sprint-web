<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 */
class Posts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idp;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuP", type="string", length=500, nullable=false)
     */
    private $contenup;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbcmt", type="integer", nullable=true)
     */
    private $nbcmt;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer", nullable=true)
     */
    private $views;

    /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer", nullable=true)
     */
    private $likes;

    /**
     * @var integer
     *
     * @ORM\Column(name="report", type="integer", nullable=true)
     */
    private $report;

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateP", type="datetime", nullable=true)
     */
    private $datep;


}

