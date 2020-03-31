<?php

namespace NewsBundle\Entity;

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
     * @return int
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * @param int $idc
     */
    public function setIdc($idc)
    {
        $this->idc = $idc;
    }

    /**
     * @return string
     */
    public function getNomcat()
    {
        return $this->nomcat;
    }

    /**
     * @param string $nomcat
     */
    public function setNomcat($nomcat)
    {
        $this->nomcat = $nomcat;
    }
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

