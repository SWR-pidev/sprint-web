<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="items")
 * @ORM\Entity
 */
class Items
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idItem", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditem;

    /**
     * @var integer
     *
     * @ORM\Column(name="idh", type="integer", nullable=false)
     */
    private $idh;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="expdate", type="string", length=15, nullable=true)
     */
    private $expdate = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status;



    /**
     * Get iditem
     *
     * @return integer
     */
    public function getIditem()
    {
        return $this->iditem;
    }

    /**
     * Set idh
     *
     * @param integer $idh
     *
     * @return Items
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
     * Set name
     *
     * @param string $name
     *
     * @return Items
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Items
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Items
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set expdate
     *
     * @param string $expdate
     *
     * @return Items
     */
    public function setExpdate($expdate)
    {
        $this->expdate = $expdate;

        return $this;
    }

    /**
     * Get expdate
     *
     * @return string
     */
    public function getExpdate()
    {
        return $this->expdate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Items
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
