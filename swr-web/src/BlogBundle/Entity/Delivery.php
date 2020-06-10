<?php

namespace BlogBundle\Entity;

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



    /**
     * Get idde
     *
     * @return integer
     */
    public function getIdde()
    {
        return $this->idde;
    }

    /**
     * Set iddman
     *
     * @param integer $iddman
     *
     * @return Delivery
     */
    public function setIddman($iddman)
    {
        $this->iddman = $iddman;

        return $this;
    }

    /**
     * Get iddman
     *
     * @return integer
     */
    public function getIddman()
    {
        return $this->iddman;
    }

    /**
     * Set dated
     *
     * @param string $dated
     *
     * @return Delivery
     */
    public function setDated($dated)
    {
        $this->dated = $dated;

        return $this;
    }

    /**
     * Get dated
     *
     * @return string
     */
    public function getDated()
    {
        return $this->dated;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return Delivery
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }
}
