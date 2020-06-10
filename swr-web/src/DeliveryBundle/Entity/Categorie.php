<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie", uniqueConstraints={@ORM\UniqueConstraint(name="nomcat", columns={"nomcat"})})
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcat", type="string", length=30, nullable=false)
     */
    private $nomcat;


}

