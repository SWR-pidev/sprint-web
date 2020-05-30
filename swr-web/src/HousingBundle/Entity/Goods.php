<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Goods
 *
 * @ORM\Table(name="goods", indexes={@ORM\Index(name="idH", columns={"idH"}), @ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="item", columns={"item"})})
 * @ORM\Entity
 */
class Goods
{
    /**
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param string $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }
    /**
     * @return int
     */
    public function getQcollected()
    {
        return $this->qcollected;
    }

    /**
     * @param int $qcollected
     */
    public function setQcollected($qcollected)
    {
        $this->qcollected = $qcollected;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getIdg()
    {
        return $this->idg;
    }

    /**
     * @param int $idg
     */
    public function setIdg($idg)
    {
        $this->idg = $idg;
    }


    /**
     * @return User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param User $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return Housing
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * @param Housing $idh
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;
    }
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
     * @var integer
     *
     * @ORM\Column(name="idG", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idg;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=25, nullable=false)
     */
    private $item;

    /**
     * @var \HousingBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="HousingBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idu")
     * })
     */
    private $iduser;

    /**
     * @var \HousingBundle\Entity\Housing
     *
     * @ORM\ManyToOne(targetEntity="HousingBundle\Entity\Housing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idH", referencedColumnName="idh")
     * })
     */
    private $idh;


}

