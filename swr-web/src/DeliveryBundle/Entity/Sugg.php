<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sugg
 *
 * @ORM\Table(name="sugg")
 * @ORM\Entity
 */
class Sugg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sugg", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSugg;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cmp", type="integer", nullable=true)
     */
    private $idCmp;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=60, nullable=true)
     */
    private $detail;


}

