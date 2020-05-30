<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compaign
 *
 * @ORM\Table(name="compaign")
 * @ORM\Entity
 */
class Compaign
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cmp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCmp;

    /**
     * @var string
     *
     * @ORM\Column(name="name_cmp", type="string", length=50, nullable=false)
     */
    private $nameCmp;

    /**
     * @var float
     *
     * @ORM\Column(name="target", type="float", precision=10, scale=0, nullable=false)
     */
    private $target;

    /**
     * @var float
     *
     * @ORM\Column(name="raised", type="float", precision=10, scale=0, nullable=false)
     */
    private $raised;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip", type="string", length=255, nullable=false)
     */
    private $descrip;

    /**
     * @var string
     *
     * @ORM\Column(name="urlimg", type="string", length=100, nullable=false)
     */
    private $urlimg;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbdon", type="integer", nullable=false)
     */
    private $nbdon = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="stillneeded", type="integer", nullable=false)
     */
    private $stillneeded;


}

