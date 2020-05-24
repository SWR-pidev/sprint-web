<?php

namespace BlogBundle\Entity;

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



    /**
     * Get idCmp
     *
     * @return integer
     */
    public function getIdCmp()
    {
        return $this->idCmp;
    }

    /**
     * Set nameCmp
     *
     * @param string $nameCmp
     *
     * @return Compaign
     */
    public function setNameCmp($nameCmp)
    {
        $this->nameCmp = $nameCmp;

        return $this;
    }

    /**
     * Get nameCmp
     *
     * @return string
     */
    public function getNameCmp()
    {
        return $this->nameCmp;
    }

    /**
     * Set target
     *
     * @param float $target
     *
     * @return Compaign
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return float
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set raised
     *
     * @param float $raised
     *
     * @return Compaign
     */
    public function setRaised($raised)
    {
        $this->raised = $raised;

        return $this;
    }

    /**
     * Get raised
     *
     * @return float
     */
    public function getRaised()
    {
        return $this->raised;
    }

    /**
     * Set descrip
     *
     * @param string $descrip
     *
     * @return Compaign
     */
    public function setDescrip($descrip)
    {
        $this->descrip = $descrip;

        return $this;
    }

    /**
     * Get descrip
     *
     * @return string
     */
    public function getDescrip()
    {
        return $this->descrip;
    }

    /**
     * Set urlimg
     *
     * @param string $urlimg
     *
     * @return Compaign
     */
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;

        return $this;
    }

    /**
     * Get urlimg
     *
     * @return string
     */
    public function getUrlimg()
    {
        return $this->urlimg;
    }

    /**
     * Set nbdon
     *
     * @param integer $nbdon
     *
     * @return Compaign
     */
    public function setNbdon($nbdon)
    {
        $this->nbdon = $nbdon;

        return $this;
    }

    /**
     * Get nbdon
     *
     * @return integer
     */
    public function getNbdon()
    {
        return $this->nbdon;
    }

    /**
     * Set stillneeded
     *
     * @param integer $stillneeded
     *
     * @return Compaign
     */
    public function setStillneeded($stillneeded)
    {
        $this->stillneeded = $stillneeded;

        return $this;
    }

    /**
     * Get stillneeded
     *
     * @return integer
     */
    public function getStillneeded()
    {
        return $this->stillneeded;
    }
}
