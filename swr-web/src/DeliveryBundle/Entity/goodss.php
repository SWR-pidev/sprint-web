<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Goods
 *
 * @ORM\Table(name="goods")
 * @ORM\Entity(repositoryClass="DeliveryBundle\Repository\GoodsRepository")
 */
class goodss
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
     * @var \Housing
     *
     * @ORM\ManyToOne(targetEntity="Housing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idh", referencedColumnName="idh")
     * })
     */

    private $idh;





    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=true)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=25, nullable=false)
     */
    /**
     * @var \Items
     *
     * @ORM\ManyToOne(targetEntity="Items")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="idItem", referencedColumnName="idItem")
     *
     * })
     */
    private $item;

    /**
     * @return \Housing
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * @param \Housing $idh
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;
    }

    /**
     * @return \Items
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param \Items $item
     */
    public function setItem($item)
    {
        $this->item = $item;
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

    public function getidg()
    {
        return $this->idg;
    }
    public function setidg($idg)
    {
        $this->idg = $idg;
    }

    public function getiduser()
    {
        return $this->iduser;
    }
    public function setiduser($iduser)
    {
        $this->iduser = $iduser;
    }


    public function getqcollected()
    {
        return $this->qcollected;
    }
    public function setqcollected($qcollected)
    {
        $this->qcollected = $qcollected;
    }
    public function getstatus()
    {
        return $this->status;
    }
    public function setstatus($status)
    {
        $this->status = $status;
    }



}

