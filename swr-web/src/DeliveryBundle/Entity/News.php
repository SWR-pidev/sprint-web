<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news", uniqueConstraints={@ORM\UniqueConstraint(name="titre", columns={"titre"})}, indexes={@ORM\Index(name="nomcat", columns={"nomcat"})})
 * @ORM\Entity
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idn", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idn;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=30, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepub", type="date", nullable=false)
     */
    private $datepub;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcat", type="string", length=30, nullable=false)
     */
    private $nomcat;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;


}

