<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity
 */
class Delivery
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdDe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idde;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDman", type="integer", nullable=false)
     */
    private $iddman;

    /**
     * @var string
     *
     * @ORM\Column(name="DateD", type="string", length=20, nullable=false)
     */
    private $dated;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=20, nullable=false)
     */
    private $item;


}

