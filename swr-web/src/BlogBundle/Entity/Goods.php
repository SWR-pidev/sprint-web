<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Goods
 *
 * @ORM\Table(name="goods")
 * @ORM\Entity
 */
class Goods
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idg;

    /**
     * @var integer
     *
     * @ORM\Column(name="idH", type="integer", nullable=false)
     */
    private $idh;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=true)
     */
    private $iduser = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=25, nullable=false)
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="Qcollected", type="integer", nullable=false)
     */
    private $qcollected;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=25, nullable=false)
     */
    private $status;



    /**
     * Get idg
     *
     * @return integer
     */
    public function getIdg()
    {
        return $this->idg;
    }

    /**
     * Set idh
     *
     * @param integer $idh
     *
     * @return Goods
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;

        return $this;
    }

    /**
     * Get idh
     *
     * @return integer
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Goods
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return Goods
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

    /**
     * Set qcollected
     *
     * @param integer $qcollected
     *
     * @return Goods
     */
    public function setQcollected($qcollected)
    {
        $this->qcollected = $qcollected;

        return $this;
    }

    /**
     * Get qcollected
     *
     * @return integer
     */
    public function getQcollected()
    {
        return $this->qcollected;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Goods
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
